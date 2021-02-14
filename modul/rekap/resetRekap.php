<?php
include "../../config/database/koneksi.php";
 //DELETE SEMUA DATA
$reset = $_POST['resetRekap'];
if($reset == 1){
    mysqli_query($conn, "TRUNCATE TABLE rekap");
    mysqli_query($conn, "ALTER TABLE rekap auto_increment=0");
    header("location:index.php");
}