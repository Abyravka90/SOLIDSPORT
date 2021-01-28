<?php
    session_start();
    if (!isset($_SESSION['username'])){
        header("location:../login");
    } else {
        include "../../config/database/koneksi.php";
        $login = "SELECT * from `user` WHERE `username` = '$_SESSION[username]'";
        $sqlLogin = mysqli_query($conn, $login);
        $cekLogin = mysqli_fetch_object($sqlLogin);
        if($cekLogin -> statusLogin == 1){
      include "../../config/templates/header.php";
      ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" http-equiv="refresh"  content="2">
    <title>.:SOLIDSPORTS:.</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
  </head>
  <body background="../../assets/img/banner2.jpg" class="g-sidenav-show g-sidenav-pinned" style="min-height: 100vh;">
    <!-- Navbar -->
    
    <div class="main-content">
      <!-- Header -->
      <div class="header py-6 py-lg-7 pt-lg-7">    
      </div>
      <!-- Page content -->
      <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7">
            <div class="card  border-0 mb-0">
              <div class="card-body px-lg-5 py-lg-5">
                    <h1 class="display-3 text-center"><i class="ni ni-paper-diploma"></i> Penilaian <?= $_SESSION['username'] ?></h1>
                    <?php $username = $_SESSION['username'] ?>  
                    <form role="form" method="post" action="prosesPenilaian.php">
                        <div class="text-center">
                          <input type="hidden" name="username" value="<?= $username ?>">
                          <button type="submit" class="btn btn-primary my-4">proses</button>
                          <br>
                      </form>
                        <img height="75px" src="../../assets/img/logo-2.jpeg">
                      </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
   <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Argon JS -->
    <script src="../../assets/js/argon.js?v=1.2.0"></script><div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>
  
  
  </body></html>
  <?php 
        } else if($cekLogin -> statusLogin > 1){
                $resetCounter = "UPDATE `user` SET `statusLogin` = 1 WHERE `username` = '$_SESSION[username]'";
                mysqli_query($conn, $resetCounter);
                echo 
                '<script>
                    alert("hubungi admin untuk login kembali");
                    window.location.href="../login";
                </script>';
            }else{
                echo 
                '<script>
                alert("hubungi admin untuk login kembali");
                window.location.href="../login";
                </script>';
            }
           
        }
    ?>