<!-- proses simpan data juri -->
<?php
include "../../config/database/koneksi.php";
$username = $_POST['username'];
$sqlPoint = "SELECT DISTINCT namaAtlet, juriMenilai from `point` WHERE namaJuri = '$username'";
$data = mysqli_query($conn,$sqlPoint);
$row = mysqli_fetch_object($data);
if($row -> juriMenilai == 1){
    echo '<script>alert("atlet ini sudah anda nilai");window.location.href="index.php";</script>';
}else if($row -> namaAtlet != '-'){
    $nilaiTeknik = $_POST['nilaiTeknik'];
    $nilaiAtletik = $_POST['nilaiAtletik'];
    $queryJuri = "UPDATE `point` SET nilaiTeknik = '$nilaiTeknik', nilaiAtletik = '$nilaiAtletik', juriMenilai = 1 WHERE namaJuri = '$username'" ;
    mysqli_query($conn,$queryJuri);
    echo '<script>alert("nilai berhasil disimpan");window.location.href="index.php";</script>';
}else{
    echo '<script>alert("belum ada atlet bermain");window.location.href="index.php";</script>';
}
?>