<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:../login");
} else {
  include "../../config/templates/header.php";
  if ($_SESSION['statusLogin'] == 0) {
?>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
      <meta name="author">
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
              <div class="card mb-0">
                <div class="card-header py-0">
                  <div class="text-center">
                    <img class="text-center" height="120px" src="../../assets/img/logo-2.jpeg">
                  </div>
                </div>
                <div class="card-body px-lg-5 py-lg-3 bg-secondary">
                  <img src="../../assets/img/welcome.png" class="img-fluid" alt="">
                  <h2 class="mt-3 text-muted text-center" style="font-family: 'Montserrat', sans-serif;font-weight:lighter;">PENILAIAN | <strong class="text-primary" style="font-family: 'Montserrat', sans-serif;font-weight:900;"><?= $_SESSION['username'] ?></strong></h2>
                  <?php $username = $_SESSION['username'] ?>
                  <form role="form" method="post" action="prosesPenilaian.php">
                    <div class="text-center">
                      <input type="hidden" name="username" value="<?= $username ?>">
                      <button type="submit" class="btn btn-primary btn-block mt-4">Mulai</button>
                      <a class="btn btn-light btn-sm mt-3 mb-4" style="float: left;" href="http://<?= $_SERVER['HTTP_HOST'] ?>/solidsport/modul/logout"> <i class="fas fa-angle-left"></i> Keluar</a>
                  </form>
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
      <script src="../../assets/js/argon.js?v=1.2.0"></script>
      <div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>
    </body>

    </html>
<?php
  } else {
    echo
    '<script>
    setTimeout(function(){
      swal({
        title : "Gagal Masuk!",
        text : "coba reset login melalui admin",
        type : "error",
      }).then(function(){
        window.location.href="../login";
      })
    },1000);
    </script>';
  }
}
?>
<!-- Sweet Alert -->
<script src="../../assets/js/sweetalert2.min.js"></script>