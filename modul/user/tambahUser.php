<?php //JIKA TOMBOL SIMPAN DI KLIK
    include "../../config/database/koneksi.php";
    $idUser = $_POST['idUser'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1 == $password2){
      mysqli_query($conn,"UPDATE `user` SET `password` = md5('$password2') WHERE idUser = '$idUser'");
      echo
      '<script>alert("password berhasil dirubah");window.location.href="index.php";</script>';
    }else{
      echo
        '<script>alert("password tidak cocok")</script>';
    }
  ?>