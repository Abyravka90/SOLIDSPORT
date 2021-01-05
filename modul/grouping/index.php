<?php
include "../../config/templates/header.php";
include "../../config/templates/sidebar.php";
include "../../config/templates/mainContent.php";
include "../../config/database/koneksi.php";

?>
<style>
    .blinking {
        animation: blinkingText 1.2s infinite;
        font-size: 40px;
    }

    @keyframes blinkingText {
        0% {
            color: #000;
        }

        49% {
            color: #000;
        }

        60% {
            color: transparent;
        }

        99% {
            color: transparent;
        }

        100% {
            color: #000;
        }
    }
</style>
<!-- proses update ke table point -->
<?php
if (isset($_GET['idAtlet'])) {
    $idAtlet = $_GET['idAtlet'];
    $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `point` LIMIT 1");
    while ($cekData = mysqli_fetch_array($sqlStatusPenilaian)) {
        $statusPenilaian = $cekData['statusPenilaian'];
    }
    if ($statusPenilaian != 'staging') {
        $sql = "SELECT * FROM atlet WHERE idAtlet = '$idAtlet'";
        $hasil = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($hasil)) {
            $idAtlet = $data['idAtlet'];
            $namaAtlet = $data['namaAtlet'];
            $kelas = $data['kelas'];
            $kontingen = $data['kontingen'];
            $namaKata = $data['namaKata'];
            $grup = $data['grup'];
            $atribut = $data['atribut'];
            //proses update ke table point
            $sqlPoint = "UPDATE `point` SET idAtlet = '$idAtlet', namaAtlet = '$namaAtlet', kelas = '$kelas', kontingen = '$kontingen', namaKata = '$namaKata', 
                        grup = '$grup', atribut = '$atribut', statusPenilaian = 'staging';";
            mysqli_query($conn, $sqlPoint);
            $sqlAtlet = "UPDATE `atlet` SET bermain = bermain+1, statusPenilaian = 'staging' WHERE idAtlet = '$idAtlet';";
            mysqli_query($conn, $sqlAtlet);
        }
    } else {
        echo '<script>alert("silahkan klik tombol stop terlebih dahulu")</script>';
    }
}
?>
<!-- proses simpan ke table klasemen -->
<?php
if (isset($_GET['idSimpan'])) {
    $idAtlet = $_GET['idSimpan'];
    $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `atlet` WHERE idAtlet = '$idAtlet' LIMIT 1");
    while ($cekData = mysqli_fetch_array($sqlStatusPenilaian)) {
        $statusPenilaian = $cekData['statusPenilaian'];
    }
    if ($statusPenilaian == 'staging') {
        $sql = "SELECT * FROM `point` WHERE idAtlet = '$idAtlet' LIMIT 1";
        $hasil = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($hasil)) {
            $idAtlet = $data['idAtlet'];
            $namaAtlet = $data['namaAtlet'];
            $kontingen = $data['kontingen'];
            $grup = $data['grup'];
            $totalPoint = 0;
            $sqlKlasemen = "INSERT INTO klasemen (idKlasemen, idAtlet, namaAtlet, kontingen, grup, totalPoint) 
                            VALUES ('','$idAtlet','$namaAtlet','$kontingen','$grup','$totalPoint')";
            mysqli_query($conn, $sqlKlasemen);
            $sqlPoint = "UPDATE `point` SET statusPenilaian = 'saved'";
            mysqli_query($conn, $sqlPoint);
            $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'standby'";
            mysqli_query($conn, $sqlAtlet);
        }
    } else {
        echo '<script>alert("pilih atlet yang sedang bermain")</script>';
    }
}
?>
<!-- proses reset nilai -->
<?php
if (isset($_GET['reset'])) {
    $reset = $_GET['reset'];
    if ($reset > 0) {
        mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                        grup = '-', atribut = '-', statusPenilaian = 'standby'");
        mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby', bermain = bermain-1 WHERE idAtlet = '$reset'");
        echo "<script>alert('penilaian berhasil di reset');</script>";
    }
}
?>
<!--proses update data atlet-->
<?php
if (isset($_POST['idAtlet'])) {
    $idAtlet = $_POST['idAtlet'];
    $namaKata = $_POST['namaKata'];
    $atribut = $_POST['atribut'];
    $grup = $_POST['grup'];
    foreach ($idAtlet as $key => $val) {
        $sqlPoint = "UPDATE `point` SET `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
        $sqlAtlet = "UPDATE `atlet` SET `grup` = '$grup[$key]', `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
        mysqli_query($conn, $sqlPoint);
        mysqli_query($conn, $sqlAtlet);
    }
}
?>
<!-- Se table -->
<div class="container-fluid mt-4">
    <!-- Card header -->

    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-12 mb-2">
                <p class="mb-0">Pilih Grup :
                </p>

            </div>
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <select class="form-control" name="grup">
                                <?php
                                //menghindari duplikasi pada record
                                $sql = "SELECT DISTINCT grup from atlet";
                                $hasil = mysqli_query($conn, $sql);
                                while ($data = mysqli_fetch_array($hasil)) {
                                    if ($data[0] != "final") {
                                        echo "<option value='$data[0]'>$data[0]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">

                            <input class="btn btn-success" type="submit" value="proses">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <form action="#" method="POST">
        <table id="example" class="table table-striped table-bordered nowrap" style="width:110%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Nama Atlet</th>
                    <th>Proses</th>
                    <th>Nama Kata</th>
                    <th style="width:100px">Grup</th>
                    <th style="width:100px">Atribut</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_GET['grup'])) {
                    //jika grup dipilih
                    $grup = $_GET['grup'];
                    $i = 1;
                    $sql = "SELECT * FROM atlet WHERE grup = '$grup'";
                    $hasil = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($hasil)) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?php if ($data['statusPenilaian'] == "staging") {
                                    echo '<span class="blinking badge badge-success">bermain</span>';
                                } ?></td>
                            <td><?= $data['namaAtlet']; ?></td>
                            <td>
                                <!-- dari sini proses dilempar ke line 23 -->
                                <a href="?grup=<?= $data['grup'] ?>&&idAtlet=<?= $data['idAtlet'] ?>" class="btn btn-warning"><i class="ni ni-button-play"></i>&nbsp;play</a>
                                <br><br>
                                <!-- dari sini proses dilempar ke line 51-->
                                <a href="?grup=<?= $data['grup'] ?>&&idSimpan=<?= $data['idAtlet'] ?>" class="btn btn-primary"><i class="ni ni-button-power"></i>&nbsp;stop</a>
                                <!--dilanjutkan ke line 79-->
                                <a href="?grup=<?= $data['grup'] ?>&&reset=<?= $data['idAtlet'] ?>" class="btn btn-secondary"><i class="ni ni-atom"></i>&nbsp;reset</a>
                            </td>
                            <input type="hidden" name="idAtlet[]" value="<?= $data['idAtlet'] ?>">
                            <td><textarea name="namaKata[]" cols="10" rows="3"><?= $data['namaKata'] ?></textarea></td>
                            <td>
                                <select name="grup[]" class="form-control">
                                    <option value="<?= $data['grup'] ?>"><?= $data['grup'] ?></option>
                                    <option value="final">Lanjut Final</option>
                                </select>
                            </td>
                            <td>
                                <select name="atribut[]" class="form-control">
                                    <option value="Aka" <?php if ($data['atribut'] == 'Aka') {
                                                            echo 'selected';
                                                        } ?>>Aka</option>
                                    <option value="Ao" <?php if ($data['atribut'] == 'Ao') {
                                                            echo 'selected';
                                                        } ?>>Ao</option>
                                </select>
                            </td>
                        </tr>
                <?php $i++;
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="pl-3">
            <!-- lanjut ke line 90-->
            <input class="btn btn-warning" name="update" type="submit" value="Ubah data">
    </form>
</div>
</div>
<!-- Footer -->
<?php
include "../../config/templates/footer.php";
?>
</body>

</html>