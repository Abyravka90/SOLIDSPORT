<?php
include "../../config/templates/header.php";
include "../../config/templates/sidebar.php";
include "../../config/templates/mainContent.php";
include "../../config/database/koneksi.php";
if (isset($_GET['idKlasemen'])) {
    $idKlasemen = $_GET['idKlasemen'];
    mysqli_query($conn, "DELETE from `klasemen` WHERE idKlasemen = $idKlasemen");
}
if (isset($_GET['reset'])) {
    mysqli_query($conn, "DELETE FROM klasemen");
    mysqli_query($conn, "ALTER TABLE klasemen auto_increment=0");
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
                                    <td>$data[totalPoint]</td>
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
                ?>
            </tr>
        </tbody>
    </table>
    <div class="pl-3">
        <form action="#" method="post">
            <input type="submit" name="updatePapanskor" value="tampilkan" class="btn btn-info"></input>
        </form>
        <a href="?reset=1" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;Reset</a>
    </div>
</div>
<br />
<!-- Footer -->
<?php
include "../../config/templates/footer.php";
?>
</body>

</html>