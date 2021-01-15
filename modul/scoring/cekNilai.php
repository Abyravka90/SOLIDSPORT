<?php
$namaJuri = $_POST['namaJuri'];
$nilaiTeknik = $_POST['nilaiTeknik'];
$nilaiAtletik = $_POST['nilaiAtletik'];

foreach($nilaiTeknik as $key => $val){
    $sql = "UPDATE `point` SET `nilaiTeknik` = '$nilaiTeknik[$key]', `nilaiAtletik` = '$nilaiAtletik[$key]' WHERE `namaJuri` = '$namaJuri[$key]' ;";
    echo $sql;
}
?>