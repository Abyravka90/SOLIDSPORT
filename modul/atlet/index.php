<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else {
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";

    //JIKA TOMBOL UPDATE DITEKAN
    if (isset($_POST['idAtlet'])) {
        $idAtlet = $_POST['idAtlet'];
        $namaAtlet = $_POST['namaAtlet'];
        $namaKata = $_POST['namaKata'];
        $kontingen = $_POST['kontingen'];
        $grup = $_POST['grup'];
        $atribut = $_POST['atribut'];
        $kelas = $_POST['kelas'];
        foreach ($idAtlet as $key => $val) {
            $sql = "UPDATE atlet SET namaAtlet = '$namaAtlet[$key]', namaKata = '$namaKata[$key]', kontingen = '$kontingen[$key]',
            grup = '$grup[$key]', atribut = '$atribut[$key]', kelas = '$kelas[$key]' WHERE idAtlet = $idAtlet[$key];";
            $sukses = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        }
    }

    //JIKA TOMBOL TAMBAH DATA DITEKAN
    if(isset($_POST['tambahAtlet'])){
        $namaAtlet = $_POST['namaAtlet'];
        $namaKata = $_POST['namaKata'];
        $kontingen = $_POST['kontingen'];
        $grup = $_POST['grup'];
        $atribut = $_POST['atribut'];
        $kelas = $_POST['kelas'];
        $result = mysqli_query($conn, "INSERT INTO `atlet` (idAtlet, namaAtlet, kelas, kontingen, namaKata, grup, atribut, bermain, statusPenilaian) 
        VALUES ('', '$namaAtlet', '$kelas', '$kontingen',  '$namaKata', '$grup', '$atribut', 0, 'standby')") or die(mysqli_error($conn));
        if($result){
            echo '<script>setTimeout(function(){
                swal({
                    title : "berhasil",
                    text : "menambahkan data atlet",
                    type : "success"
                })
            },1000)</script>';
        }
    }

    //JIKA TOMBOL HAPUS DITEKAN
    if (isset($_GET['idAtlet'])) {
        $idAtlet = $_GET['idAtlet'];
        mysqli_query($conn, "DELETE FROM atlet WHERE idAtlet = '$idAtlet'") or die(mysqli_error($conn));
    }

    //JIKA TOMBOL RESET DITEKAN
    if (isset($_POST['resetAllData'])) {    
            mysqli_query($conn, "DELETE FROM `atlet`") or die(mysqli_error($conn));
            mysqli_query($conn, "ALTER TABLE `atlet` auto_increment=0") or die(mysqli_error($conn));

            //RESET KE TABLE KLASEMEN
            mysqli_query($conn, "TRUNCATE TABLE `klasemen`") or die(mysqli_error($conn));
            mysqli_query($conn, "ALTER TABLE `klasemen` auto_increment=0") or die(mysqli_error($conn));
            
            //RESET KE TABLE REKAP
            mysqli_query($conn, "TRUNCATE TABLE `rekap`") or die(mysqli_error($conn));
            mysqli_query($conn, "ALTER TABLE `rekap` auto_increment=0") or die(mysqli_error($conn));

            mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'aktif' where jenisScoreboard = 'scoreboard'");
            mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'idle' where jenisScoreboard = 'klasemen'");
            mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                            grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
                            mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby'") or die(mysqli_error($conn)) ;
        
    }

?>

    <!--disini blok jika session berjalan nya-->
    <div class="card-header border-0">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
            <span class="alert-text"><strong>Welcome <?= $_SESSION['username']; ?> </strong>&nbsp;periksa kembali data anda</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </div>
    <!-- Modal Add -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Atlet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label><br>
                                            <input type="text" name="namaAtlet" class="form-control">
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Kelas</label><br>
                                            <input type="text" class="form-control" name="kelas" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Kata</label><br>
                                                    <input type="text" class="form-control awesomplete" name="namaKata" id="kata">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                               <div class="form-group">
                                                    <label>Attribut</label><br>
                                                    <select class="form-control" name="atribut">
                                                        <option value="Ao" selected><span class="badge badge-danger">Ao</span></option>
                                                        <option value="Aka"><span class="badge badge-default"> Aka</span></option>
                                                    </select>
                                               </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Grup</label><br>
                                                    <input class="form-control" type="text text-uppercase" maxlength="2" style="text-transform:uppercase;" name="grup">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kontingen</label><br>
                                            <textarea name="kontingen"class="form-control"></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button name="tambahAtlet" type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Se table -->
    <div class="card-body">
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#staticBackdrop">
            Tambah Atlet
            </button>
            <form action="" method="POST" enctype="multipart/form-data">
                <table table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="120%">
                    <thead class="thead-light">
                        <tr>
                            <th>Delete</th>
                            <th>No</th>
                            <th>Nama Atlet</th>
                            <th>Nama Kata</th>
                            <th>Kontingen</th>
                            <th style="width:100px;">Grup</th>
                            <th>Atribut</th>
                            <th>Bermain</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM atlet") or die(mysqli_error($conn));
                        while ($data = mysqli_fetch_object($sql)) {
                        ?>
                            <tr>
                                <td><a class="btn btn-danger" href="?idAtlet=<?= $data -> idAtlet ?>"><i class="fas fa-trash"></i></a></td>
                                <td><?= $i ?></td>
                                <td><textarea class="form-control" name="namaAtlet[]" id="" cols="10" rows="3"><?= $data -> namaAtlet ?></textarea></td>
                                <td><input type="text" class="form-control awesomplete" name="namaKata[]" id="kata" cols="10" rows="3" value="<?= $data -> namaKata ?>"></td>
                                <td><textarea class="form-control" name="kontingen[]" id="" cols="10" rows="3"><?= $data -> kontingen ?></textarea></td>
                                <td>
                                    <input class="form-control" type="text" name="grup[]" value="<?= $data -> grup ?>">
                                </td>
                                <td>
                                    <select class="form-control" name="atribut[]">
                                        <option value="Aka" <?php if ($data -> atribut == "Aka") {
                                                                echo "selected";
                                                            } ?> ><span class="badge badge-default"> Aka</span></option>
                                        <option value="Ao" <?php if ($data -> atribut == "Ao") {
                                                                echo "selected";
                                                            } ?> ><span class="badge badge-danger">Ao</span></option>
                                    </select>
                                </td>
                                <td><?= $data -> bermain ?></td>
                                <td><textarea class="form-control" name="kelas[]" id="" cols="10" rows="3"><?= $data -> kelas ?></textarea></td>
                                <input type="hidden" name="idAtlet[]" value=<?= $data -> idAtlet ?> >
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pl-3">
                    <input type="submit" class="btn btn-warning" name="update" value="Ubah data"></input>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmResetModal">
                        Reset atlet
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmResetModal" tabindex="-1" role="dialog" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reset Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin menghapus semua data atlet
                                </div>
                                <div class="modal-footer">
                                <form action="" method="post">
                                    <button name="resetAllData" type="submit" class="btn btn-danger">ya</button>
                                </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
}
include "../../config/templates/footer.php";
?>
</body>
<script src="../../config/templates/autoFillKata.js"></script>
</html>
