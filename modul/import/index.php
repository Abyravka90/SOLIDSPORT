<?php
@session_start();
if (!isset($_SESSION['username'])) {
    header("location:../login");
} else {
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    include "excel_reader2.php";
?>
    <!-- Card header -->
    <div class="container-fluid mt-5 mb-5 border-0">

        <!-- Se table -->
        <?php
        if (isset($_POST['upload'])) {

            // upload file xls
            $target = basename($_FILES['fileAtlet']['name']);
            move_uploaded_file($_FILES['fileAtlet']['tmp_name'], $target);

            // beri permisi agar file xls dapat di baca
            chmod($_FILES['fileAtlet']['name'], 0777);

            // mengambil isi file xls
            $data = new Spreadsheet_Excel_Reader($_FILES['fileAtlet']['name'], false);

            // menghitung jumlah baris data yang ada
            $jumlah_baris = $data->rowcount($sheet_index = 0);

            // jumlah default data yang berhasil di import

            $counter = 0;
            for ($i = 2; $i <= $jumlah_baris; $i++) {

                // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
                $namaAtlet     = $data->val($i, 1);
                $kelas   = $data->val($i, 2);
                $kontingen  = $data->val($i, 3);
                $namaKata  = $data->val($i, 4);
                $grup  = $data->val($i, 5);
                $atribut  = $data->val($i, 6);
                $bermain  = $data->val($i, 7);
                $statusPenilaian = 'standby';
                // input data ke database (table data_atlet)
                $sql = "INSERT INTO `atlet` values('','$namaAtlet','$kelas','$kontingen','$namaKata','$grup','$atribut','$bermain','$statusPenilaian');";
                mysqli_query($conn, $sql);
                $counter++;
            }

            if ($counter > 0) {
                $ip = $_SERVER["HTTP_HOST"];
                echo "<script>window.location.href='http://$ip/solidsport/modul/atlet';</script>";
            }
            // hapus kembali file .xls yang di upload tadi
            unlink($_FILES['fileAtlet']['name']);
        }
        ?>
        <div class="col-md-6">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            Pilih File:
                            <input name="fileAtlet" class="form-control" type="file" required="required">
                            <span class="badge badge-warning">!pastikan format yang diimport dalam bentuk Excel 97 - 2003.xls</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input name="upload" class="btn btn-default mt-4" type="submit" value="Import">

                    </div>
                </div>
            </form>

        </div>
    <?php }
    ?>
    </div>
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>

    </html>