<?php
session_start();
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    include "../../config/database/koneksi.php";
    $sql = "UPDATE `user` SET statusLogin = 0 WHERE username = '$user' ";
    $resetSession = mysqli_query($conn, $sql);
    session_destroy();
if($resetSession){header("location: ../../modul/login");}
}else{
    @header("location: ../../modul/login");
}
 

?>