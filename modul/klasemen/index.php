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
    
                    <form action="" method="get">
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
                    if(isset($_POST['updatePapanskor4'])){
                        $sqlTampilPapanskor = "UPDATE `papanskor` SET `status` = 'idle' WHERE `jenisScoreboard` = 'scoreboard'";
                        $sqlTampilKlasemen = "UPDATE `papanskor` SET `status` = 'aktif', `grup` = '$grup', `tampilkan` = 4 WHERE `jenisScoreboard` = 'klasemen'";
                        mysqli_query($conn, $sqlTampilPapanskor);
                        mysqli_query($conn, $sqlTampilKlasemen);
                    }
                    if(isset($_POST['updatePapanskor3'])){
                        $sqlTampilPapanskor = "UPDATE `papanskor` SET `status` = 'idle' WHERE `jenisScoreboard` = 'scoreboard'";
                        $sqlTampilKlasemen = "UPDATE `papanskor` SET `status` = 'aktif', `grup` = '$grup', `tampilkan` = 3 WHERE `jenisScoreboard` = 'klasemen'";
                        mysqli_query($conn, $sqlTampilPapanskor);
                        mysqli_query($conn, $sqlTampilKlasemen);
                    }
                    if(isset($_POST['updatePapanskor2'])){
                        $sqlTampilPapanskor = "UPDATE `papanskor` SET `status` = 'idle' WHERE `jenisScoreboard` = 'scoreboard'";
                        $sqlTampilKlasemen = "UPDATE `papanskor` SET `status` = 'aktif', `grup` = '$grup', `tampilkan` = 2 WHERE `jenisScoreboard` = 'klasemen'";
                        mysqli_query($conn, $sqlTampilPapanskor);
                        mysqli_query($conn, $sqlTampilKlasemen);
                    }

                    ?>
                </tr>
            </tbody>
        </table>
        <div class="pl-3">
        <div class="row">
        <div class="col-md-2 ml-4 mt-3">
            <form action="" method="post">
                <input type="submit" name="updatePapanskor4" value="Tampilkan 4 data" class="btn btn-info"></input>
            </form>
        </div>
        <div class="col-md-2 ml-4 mt-3">
            <form action="" method="post">
                <input type="submit" name="updatePapanskor3" value="Tampilkan 3 data" class="btn btn-warning"></input>
            </form>
        </div>
        <div class="col-md-2 ml-4 mt-3">
            <form action="" method="post">
                <input type="submit" name="updatePapanskor2" value="Tampilkan 2 data" class="btn btn-success"></input>
            </form>
        </div>
        <div class="col-md-2 ml-4 mt-3">
            <input type="hidden" value=1 id='resetPapanSkor'>
            <button class="btn btn-warning" id='resetPapanSkorButton' >reset Scoreboard</button>
        </div>
        <div class="col"></div>
        <div class="col-md-2">
        <input type="hidden" value=1 id="resetKlasemen">
        <button class="btn btn-danger" id="resetKlasemenButton">           Reset Data
        </button>
        </div>
        </div>
    </div>
    <br />
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    <script>
    $(document).ready(function(){
        //reset Klasemen
        $('#resetKlasemenButton').click(function(){
            var resetKlasemen = $('#resetKlasemen').val();
            $.ajax({
                url:'resetKlasemen.php',
                type:'POST',
                data:{
                    "resetKlasemen": resetKlasemen,
                },
                //JIKA DATANYA COCOK
                success:function(response){
                    if (response=='success'){
                        Swal.fire({
                            type:'success',
                            title:'berhasil',
                            text:'data klasemen berhasil dihapus',
                        }).then(function(){
                            window.location.href='';
                        });
                    } else {
                        Swal.fire({
                            type:'error',
                            title:'gagal',
                            text:'data gagal disimpan',
                        }).then(function(){
                            window.location.href='';
                        });
                    }
                }
            });
        });
        //resetPapanSkor
        $('#resetPapanSkorButton').click(function(){
            var resetPapanSkor = $('#resetPapanSkor').val();
            $.ajax({
                url:'resetScoreboard.php',
                type:'POST',
                data:{
                    "resetPapanSkor": resetPapanSkor,
                },
                //JIKA DATANYA COCOK
                success:function(response){
                    if(response=='success'){
                        Swal.fire({
                            type:'success',
                            title:'berhasil',
                            text:'papan Skor berhasil di reset',
                        }).then(function(){
                            window.location.href='';
                        });
                    } else {
                        Swal.fire({
                            type:'error',
                            title:'gagal',
                            text:'papan Skor gagal di reset',
                        }).then(function(){
                            window.location.href='';
                        });
                    }
                }
            })
        });
    });
    </script>
    </body>
 </html>
<?php } ?>
