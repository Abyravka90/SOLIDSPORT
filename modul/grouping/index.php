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
<!--TOMBOL PLAY DI KLIK! proses update ke table point -->
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
                        grup = '$grup', atribut = '$atribut', statusPenilaian = 'staging', nilaiTeknik = 0, nilaiAtletik=0, juriMenilai = 0;";
            mysqli_query($conn, $sqlPoint);
            $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'staging' WHERE idAtlet = '$idAtlet';";
            mysqli_query($conn, $sqlAtlet);
        }
    } else {
        echo 
            '<div class="card card-body"><div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Gagal Play!</strong> belum di stop!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>';
    }
}
?>
<!-- TOMBOL STOP DI KLIK! proses simpan ke table klasemen -->
<?php
if (isset($_GET['idSimpan'])) {
    $idAtlet = $_GET['idSimpan'];
    $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `atlet` WHERE idAtlet = '$idAtlet' LIMIT 1");
    while ($cekData = mysqli_fetch_array($sqlStatusPenilaian)) {
        $statusPenilaian = $cekData['statusPenilaian'];
    }
    if ($statusPenilaian == 'staging') {
        //jika jumlah juri menilai kurang dari yang ditentukan
        $sqlJuriMenilai = mysqli_query($conn, "SELECT SUM(juriMenilai) as `juriMenilai` from `point`");
        $rowJuriMenilai = mysqli_fetch_array($sqlJuriMenilai);
        $jumlahJuriMenilai = $rowJuriMenilai['juriMenilai'];
        if($jumlahJuriMenilai == 5){
            $sql = "SELECT * FROM `point` WHERE idAtlet = '$idAtlet' LIMIT 1";
            $hasil = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_array($hasil)) {
                $idAtlet = $data['idAtlet'];
                $namaAtlet = $data['namaAtlet'];
                $kontingen = $data['kontingen'];
                $grup = $data['grup'];
                include '../../config/prosesPerhitungan.php';
                $totalPoint = $totalNilai;
                $sqlKlasemen = "INSERT INTO klasemen (idKlasemen, idAtlet, namaAtlet, kontingen, grup, totalPoint) 
                                VALUES ('','$idAtlet','$namaAtlet','$kontingen','$grup','$totalPoint')";
                mysqli_query($conn, $sqlKlasemen);
                $sqlPoint = "UPDATE `point` SET statusPenilaian = 'saved'";
                mysqli_query($conn, $sqlPoint);
                $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'standby'";
                mysqli_query($conn, $sqlAtlet);
                $sqlHitungBermain = "UPDATE `atlet` SET bermain = bermain+1 WHERE idAtlet = '$idAtlet'";
                mysqli_query($conn, $sqlHitungBermain);
                echo '<div class="card card-body"><div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Berhasil</strong> data disimpan di tabel klasemen</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div></div>';
                }
            }else{
                echo '<div class="card card-body"><div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Gagal Proses!</strong> ada Juri Belum Menilai</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div></div>';
            }
    } else {
        echo '<div class="card card-body"><div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Gagal Proses!</strong>Perhatikan Kembali Data Anda</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div></div>';
    }
}
?>
<!-- TOMBOL RESET DI KLIK! proses reset nilai -->
<?php
if (isset($_GET['reset'])) {
    $reset = $_GET['reset'];
    if ($reset > 0) {
        mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                        grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
        mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby' WHERE idAtlet = '$reset'");
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
                                <!-- dari sini proses dilempar ke TOMBOL PLAY DIATAS  -->
                                <a href="?grup=<?= $data['grup'] ?>&&idAtlet=<?= $data['idAtlet'] ?>" class="btn btn-warning"><i class="ni ni-button-play"></i>&nbsp;play</a>
                                
                                <!-- dari sini proses dilempar ke TOMBOL STOP DIATAS  -->
                                <a href="?grup=<?= $data['grup'] ?>&&idSimpan=<?= $data['idAtlet'] ?>" class="btn btn-primary"><i class="ni ni-button-power"></i>&nbsp;stop / save</a>
                                <!--dilanjutkan ke line TOMBOL RESET DIATAS-->
                                <a href="?grup=<?= $data['grup'] ?>&&reset=<?= $data['idAtlet'] ?>" class="btn btn-danger">↻&nbsp;reset</a>
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