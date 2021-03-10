<!-- proses simpan data juri -->
<?php
include "../../config/database/koneksi.php";
include "../../config/templates/header.php";
$username = $_POST['username'];
$namaAtlet = $_POST['namaAtlet'];
$sqlPoint = "SELECT DISTINCT namaAtlet, juriMenilai from `point` WHERE namaJuri = '$username'";
$data = mysqli_query($conn, $sqlPoint);
$row = mysqli_fetch_object($data);
if ($row -> juriMenilai == 1) {
    echo '<script>setTimeout(function(){
        swal({
            title : "Gagal Proses",
            text : "Atlet ini sudah anda nilai",
            type : "error"
        }).then(function(){
            window.location.href="index.php";
        })
    },1000)</script>';
} else if ($row -> namaAtlet != '-') {
    $sqlCekAtlitValid = "SELECT namaAtlet from `point`";
    $queryCekAtlitValid = mysqli_query($conn, $sqlCekAtlitValid);
    $row = mysqli_fetch_object($queryCekAtlitValid);
    $namaAtletValid = $row -> namaAtlet;
    if($namaAtlet != $namaAtletValid){
        echo '<script>setTimeout(function(){
            swal({
                title : "INFO",
                text : "Data Atlet Tidak Cocok, Klik untuk pembaruan data",
                type : "info"
            }).then(function(){
                window.location.href="index.php";
            })
        },1000)</script>';
    } else {
        $nilaiTeknik = $_POST['nilaiTeknik'];
        $nilaiAtletik = $_POST['nilaiAtletik'];
        $queryJuri = "UPDATE `point` SET nilaiTeknik = '$nilaiTeknik', nilaiAtletik = '$nilaiAtletik', juriMenilai = 1 WHERE namaJuri = '$username'";
        mysqli_query($conn, $queryJuri);
        echo '<script>setTimeout(function(){
            swal({
                title : "Berhasil",
                text : "Nilai Berhasil disimpan",
                type : "success"
            }).then(function(){
                window.location.href="index.php";
            })
        },1000)</script>';
    }
} else {
    echo '<script>setTimeout(function(){
        swal({
            title : "INFO",
            text : "Belum ada atlet yang aktif, klik untuk pembaruan data",
            type : "info"
        }).then(function(){
            window.location.href="index.php";
        })
    },1000)</script>';
}
?>
<script src="../../assets/js/sweetalert2.min.js"></script>