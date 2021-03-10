<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //DELETE SATU DATA
    if (isset($_GET['idKlasemen'])) {
        $idKlasemen = $_GET['idKlasemen'];
        mysqli_query($conn, "DELETE from `klasemen` WHERE idKlasemen = $idKlasemen");
    } 
    
    ?>
    <!-- Card header -->
    <div class="card-header border-0">
    
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
    
                    <p>Pilih Grup</p>
                </div>
                <div class="col-md-6">
    
                    <form action="#" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="grup" class="form-control">
                                    <?php
                                    $sqlGrupAtlet = mysqli_query($conn, 'SELECT DISTINCT grup from atlet');
                                    while ($data = mysqli_fetch_array($sqlGrupAtlet)) {
                                        echo "<option value='$data[0]'>$data[0]</option>";
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
    </div>
    <!-- Se table -->
    <div class="container-fluid">
    
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Atlet</th>
                    <th>Kontingen</th>
                    <th>Grup</th>
                    <th>Total Point</th>
                    <th>Hapus Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $grup='';
                    if (isset($_GET['grup'])) {
                        $grup = $_GET['grup'];
                        $sqlKlasemen = "SELECT * from `klasemen` WHERE grup = '$grup' ";
                        $hasilKlasemen = mysqli_query($conn, $sqlKlasemen);
                        while ($data = mysqli_fetch_array($hasilKlasemen)) {
                            echo "
                                        <tr>
                                        <td></td>
                                        <td>$data[namaAtlet]</td>
                                        <td>$data[kontingen]</td>
                                        <td>$data[grup]</td>
                                        <td>".number_format($data['totalPoint'],2)."</td>
                                        <td><a href='?grup=$data[grup]&&idKlasemen=$data[idKlasemen]' class='btn btn-danger'><span style='font-size:10px;'>&#10005;</span></a></td>
                                        </tr>";
                        }
                    }
                    //proses merubah nilai papan skor
                    if(isset($_POST['updatePapanskor'])){
                        $sqlTampilPapanskor = "UPDATE `papanskor` SET `status` = 'idle' WHERE `jenisScoreboard` = 'scoreboard'";
                        $sqlTampilKlasemen = "UPDATE `papanskor` SET `status` = 'aktif', `grup` = '$grup' WHERE `jenisScoreboard` = 'klasemen'";
                        mysqli_query($conn, $sqlTampilPapanskor);
                        mysqli_query($conn, $sqlTampilKlasemen);
                    }

                    //JIKA TOMBOL RESET SCOREBOARD DI KLIK
                    if(isset($_POST['resetPapanskor'])){
                        mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'aktif' where jenisScoreboard = 'scoreboard'");
                        mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'idle' where jenisScoreboard = 'klasemen'");
                        mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                                        grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
                                        mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby'");
                                        echo '<script>
                                        setTimeout(function() {
                                            swal({
                                                title: "Berhasil!",
                                                text: "Papan Skor berhasil di reset!",
                                                type: "success"
                                            });
                                        }, 1000);
                                    </script>';
                                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <div class="pl-3">
        <div class="row">
        <div class="col-md-2">
            <form action="" method="post">
                <input type="submit" name="updatePapanskor" value="Tampilkan" class="btn btn-info"></input>
            </form>
        </div>
        <div class="col-md-2">
            <form action="" method="post">
                <input type="submit" name="resetPapanskor" value="Reset Scoreboard" class="btn btn-warning"></input>
            </form>
        
        </div>
        <div class="col"></div>
        <div class="col-md-2">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmResetModal">
                        Reset Data
            </button>

        </div>
        </div>
         
            
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
                                    Apakah anda yakin menghapus semua data klasemen
                                </div>
                                <div class="modal-footer">
                                <form action="resetKlasemen.php" method="post">
                                <input type="hidden" name="resetKlasemen" value="1">
                                    <input type="submit" name="btnReset" value="yes" class="btn btn-danger"></input>
                                </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <br />
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
 </html>
<?php } ?>
