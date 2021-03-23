<?php 
include "../../config/database/koneksi.php";
 //DELETE SEMUA DATA
$resetKlasemen = $_POST['resetKlasemen'];
if($resetKlasemen == 1){
    mysqli_query($conn, "TRUNCATE TABLE klasemen") or die(mysqli_error($conn));
    mysqli_query($conn, "ALTER TABLE klasemen auto_increment=0") or die(mysqli_error($conn));
    echo 'success';
}else{
    echo 'error';
}