<?php 
include "../../config/database/koneksi.php";
 //DELETE SEMUA DATA
$reset = $_POST['resetKlasemen'];
if($reset == 1){
    mysqli_query($conn, "TRUNCATE TABLE klasemen") or die(mysqli_error($conn));
    mysqli_query($conn, "ALTER TABLE klasemen auto_increment=0") or die(mysqli_error($conn));
    header("location:/solidsport/modul/klasemen");
}