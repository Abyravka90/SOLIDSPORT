<?php 
include "../../config/database/koneksi.php";
 //DELETE SEMUA DATA
$reset = $_POST['resetKlasemen'];
if($reset == 1){
    mysqli_query($conn, "TRUNCATE TABLE klasemen");
    mysqli_query($conn, "ALTER TABLE klasemen auto_increment=0");
    header("location:/solidsport/modul/klasemen");
}