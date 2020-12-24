<?php 
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
?>
            <!-- Card header -->
                <div class="card-header border-0">
                  <h1 class="mb-0">Papan Score</h1>
                </div>
                <!-- Se table -->
                <?php 
                if(isset($_POST['reset'])){  
                        mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'aktif' where jenisScoreboard = 'scoreboard'");
                        mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'idle' where jenisScoreboard = 'klasemen'");
                }
                ?>
                <form action="" method="post">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Aktif</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $sql = "SELECT * FROM `papanskor`";
                $hasil = mysqli_query($conn, $sql);
                $i=1;
                while($data=mysqli_fetch_array($hasil)){ ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $data['jenisScoreboard'] ?></td>
                        <td>
                            <label class="custom-toggle">
                            <input type="hidden" name="jenisScoreboard" value=<?= $data['jenisScoreboard'] ?>>
                            <input name="status" disabled type="checkbox" value="aktif" <?php if ( $data['status'] == "aktif" ){ echo "checked";}?>>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
            <!-- dilempar ke line 15-->
                <div class="card-header border-0">
                    <input name="reset" type="submit" value="reset" class="btn btn-warning">
                </form>
                </div>
                <!-- Footer -->
<?php 
    include "../../config/templates/footer.php";
?>
</body>
</html>