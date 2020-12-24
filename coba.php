<?php 
include 'config/database/koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM `point`");
$results = array();
while ($data = mysqli_fetch_array($result)){
    $results[]= $data['nilaiTeknik'];
}
print_r($results);