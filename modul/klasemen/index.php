<?php 
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    if(isset($_GET['idKlasemen'])){
        $idKlasemen = $_GET['idKlasemen'];
        mysqli_query($conn,"DELETE from `klasemen` WHERE idKlasemen = $idKlasemen");
    }
    if(isset($_GET['reset'])){
        mysqli_query($conn, "DELETE FROM klasemen");
        mysqli_query($conn, "ALTER TABLE klasemen auto_increment=0");
    }
?>

            <!-- Card header -->
                <div class="card-header border-0">
                  <h3 class="mb-0">Kelasemen Pertandingan</h3>
                    <div class="card-body">
                    <p class="lead">pilih grup</p>
                    <form action="#" method="get">
                        <select name="grup" class="form-control">
                            <?php 
                                $sqlGrupAtlet = mysqli_query($conn, 'SELECT DISTINCT grup from atlet');
                                while($data = mysqli_fetch_array($sqlGrupAtlet)){
                                    echo "<option value='$data[0]'>$data[0]</option>";
                                }
                            ?>
                        </select>
                        <div class="pl-3">
                                <br>
                            <input class="btn btn-primary" type="submit" value="proses">
                        </div>
                    </form>
                    </div>
                </div>
            <!-- Se table -->
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
                         if(isset($_GET['grup'])){
                            $grup = $_GET['grup'];
                            $sqlKlasemen = "SELECT * from `klasemen` WHERE grup = '$grup' ";
                            $hasilKlasemen = mysqli_query($conn, $sqlKlasemen);
                            while($data = mysqli_fetch_array($hasilKlasemen)){
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
                        ?>
                    </tr>
                </tbody>
                </table>
                <div class="pl-3">
                    <a href="../scoreboard/scoreboard.php" target='_blank' class="btn btn-warning"> <i class="ni ni-tv-2"></i>&nbsp;tampilkan di layar </a>
                    <a href="?reset=1"  class="btn btn-danger"><span style="font-size:17px;">&#128472;</span>&nbsp;reset</a>
                </div>
                <br/>
                <!-- Footer -->
<?php 
    include "../../config/templates/footer.php";
?>
</body>
</html>