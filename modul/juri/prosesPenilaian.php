<?php 
  session_start();
  if( !isset($_SESSION['username'])){
    header("location:../login");
  } else if($_SESSION['statusLogin'] == 1){
    header("location:../login");
  } else { 
    include "../../config/templates/header.php";
    include "../../config/database/koneksi.php";
  ?> 
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>.:SOLIDSPORTS:.</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
   
   
    
  </head>
  
  <body background="../../assets/img/banner2.jpg" class="g-sidenav-show g-sidenav-pinned" style="min-height: 100vh;">
    <!-- Navbar -->
    
    <!-- Main content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header py-6 py-lg-7 pt-lg-7">    
      </div>
      <!-- Page content -->
      
      <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
              <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center">
                      <h3 class="display-5"><i class="ni ni-paper-diploma"></i>&nbsp;Data Atlit</h3><br>
                    </div>
                    <?php 
                    $username = $_POST['username'];
                    $sqlPoint = "SELECT DISTINCT namaAtlet, kelas, kontingen, namaKata from `point`";
                    $data = mysqli_query($conn,$sqlPoint);
                    $row = mysqli_fetch_object($data);
                    ?>
                      <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <div class="text-center"><img height="75px" src="../../assets/img/logo-2.jpeg"><br></div>
                        <p class="card-text"> Nama : <span class="badge badge-danger"><?= $row -> namaAtlet?></span> </p>
                        <p class="card-text"> Kelas : <span class="badge badge-danger"><?= $row -> kelas ?></span></p>
                        <p class="card-text"> Kontingen : <span class="badge badge-danger"><?= $row -> kontingen ?></span></p>
                        <p class="card-text"> Nama Kata : <span class="badge badge-danger"><?= $row -> namaKata ?></span></p>
                        </div>
                      </div>
                    <form role="form" method="post" action="simpanDataJuri.php">
                      <input type="hidden" name="username" value="<?= $username ?>">
                      <div class="form-group mb-3">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1"><h1 class="display-5 text-primary">nilai teknik : </h1></label>
                          <select name = "nilaiTeknik" class="form-control" >
                            <option>0.0</option>
                            <?php 
                            for ($i = 5; $i <= 10; $i = $i + 0.2) {
                              echo '<option value="' . number_format($i, 1) . '">' . number_format($i, 1) . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1"><h1 class="display-5 text-primary">nilai atletik : </h1></label>
                          <select name = "nilaiAtletik" class="form-control" >
                          <option>0.0</option>
                            <?php 
                            for ($i = 5; $i <= 10; $i = $i + 0.2) {
                              echo '<option value="' . number_format($i, 1) . '">' . number_format($i, 1) . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">simpan</button>
                      </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
   <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Argon JS -->
    <script src="../../assets/js/argon.js?v=1.2.0"></script><div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>
  
  
  </body></html>
<?php
   } ?> 





