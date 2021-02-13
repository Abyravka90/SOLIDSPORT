<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    ?>
    <div class="container-fluid mt-5 mb-5">
        <!-- Se table -->
        <?php
        //JIKA TOMBOL RESET DI KLLIK!
        if (isset($_POST['reset'])) {
            mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'aktif' where jenisScoreboard = 'scoreboard'");
            mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'idle' where jenisScoreboard = 'klasemen'");
            mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                            grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
                            mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby'");
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
                    $i = 1;
                    while ($data = mysqli_fetch_array($hasil)) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $data['jenisScoreboard'] ?></td>
                            <td>
                                <label class="custom-toggle">
                                    <input type="hidden" name="jenisScoreboard" value=<?= $data['jenisScoreboard'] ?>>
                                    <input name="status" disabled type="checkbox" value="aktif" <?php if ($data['status'] == "aktif") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
            <!-- dilempar ke line 15-->
            <div class="card-header border-0">
                <input name="reset" type="submit" value="Reset Layar" class="btn btn-warning">
                <a href="scoreboard.php" target="blank_" class="btn btn-info">tampilkan di layar</a>
        </form>
    </div>
    </div>
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
    
    </html>
<?php } ?>
