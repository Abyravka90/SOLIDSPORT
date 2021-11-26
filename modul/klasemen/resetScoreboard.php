<?php 
include "../../config/database/koneksi.php";
 //DELETE SEMUA DATA
$resetPapanSkor = $_POST['resetPapanSkor'];
if($resetPapanSkor == 1){
    mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'aktif' where jenisScoreboard = 'scoreboard'");
    mysqli_query($conn, "UPDATE `papanskor` SET `status` = 'idle',`grup` = '-', `tampilkan` = 4 where jenisScoreboard = 'klasemen'");
    mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
                    grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
                    mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby'");
                    echo 'success';
}else{
    echo 'error';
}