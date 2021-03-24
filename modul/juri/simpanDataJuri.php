
<?php
include "../../config/database/koneksi.php";
$username = $_POST['username'];
$namaAtlet = $_POST['namaAtlet'];
$sqlPoint = "SELECT DISTINCT namaAtlet, juriMenilai from `point` WHERE namaJuri = '$username'";
$data = mysqli_query($conn, $sqlPoint);
$row = mysqli_fetch_object($data);
if ($row -> juriMenilai == 1) {
    echo 'sudah';
} else if ($row -> namaAtlet != '-') {
    $sqlCekAtlitValid = "SELECT namaAtlet from `point`";
    $queryCekAtlitValid = mysqli_query($conn, $sqlCekAtlitValid);
    $row = mysqli_fetch_object($queryCekAtlitValid);
    $namaAtletValid = $row -> namaAtlet;
    if($namaAtlet != $namaAtletValid){
        echo 'mismatch';
    } else {
        $nilaiTeknik = $_POST['nilaiTeknik'];
        $nilaiAtletik = $_POST['nilaiAtletik'];
        $queryJuri = "UPDATE `point` SET nilaiTeknik = '$nilaiTeknik', nilaiAtletik = '$nilaiAtletik', juriMenilai = 1 WHERE namaJuri = '$username'";
        mysqli_query($conn, $queryJuri);
        echo 'success';
    }
} 
?>
