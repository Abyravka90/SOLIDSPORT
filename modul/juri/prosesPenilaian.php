<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:../login");
} else if ($_SESSION['statusLogin'] == 1) {
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
              <div class="card-header">
                <div class="text-center"><img height="120px" src="../../assets/img/logo-2.jpeg"><br></div>
              </div>
              <div class="card-body px-lg-4 py-lg-3">

                <?php
                $username = $_POST['username'];
                $sqlPoint = "SELECT DISTINCT namaAtlet, kelas, kontingen, namaKata from `point`";
                $data = mysqli_query($conn, $sqlPoint);
                $row = mysqli_fetch_object($data);
                ?>
                <h3 class="display-5 text-muted text-center mb-0" style="font-family: 'Montserrat', sans-serif;font-weight:bold;"><?= $row->kelas ?></h3>
                <!-- <h1 class="text-center mb-0"><i class="ni ni-paper-diploma"></i></h1> -->
                <div class="title" style="background:#eaeaea;">

                  <h2 class="display-5 mt-3 text-muted mb-0 text-center" style="font-family: 'Montserrat', sans-serif;">DATA ATLET</h2>

                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12 text-center mb-0">
                        <h1 class="card-text mb-0" style="font-weight: bold;font-size:32px;text-transform:uppercase"><strong class="text-dark"> <?= $row->namaAtlet ?></strong></h1>
                        <p class="card-text mb-0" style="margin-top: -10px;"> <?= $row->kontingen ?> </p>
                        <hr>
                      </div>
                      <div class="col-md-12 text-center">
                        <p class="card-text mb-0"> MEMAINKAN KATA </p>
                        <h1 class="card-text mb-0" style="font-size:28px;font-weight: bold;margin-top:-10px;"><strong class="text-primary"> <?= $row->namaKata ?></strong></h1>
                      </div>

                    </div>

                  </div>
                </div>
                
                  <input type="hidden" id="username" name="username" value="<?= $username ?>">
                  <input type="hidden" id="namaAtlet" name="namaAtlet" value="<?= $row -> namaAtlet ?>">
                  <div class="form-group mb-3">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">
                        <h3 class="display-5" style="font-family: 'Montserrat', sans-serif;">Nilai Teknik : </h3>
                      </label>
                      <select id="nilaiTeknik" name="nilaiTeknik" class="form-control">
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
                      <label for="exampleFormControlSelect1">
                        <h3 class="display-5" style="font-family: 'Montserrat', sans-serif;">Nilai Atletik : </h3>
                      </label>
                      <select id="nilaiAtletik" name="nilaiAtletik" class="form-control">
                        <?php
                        for ($i = 5; $i <= 10; $i = $i + 0.2) {
                          echo '<option value="' . number_format($i, 1) . '">' . number_format($i, 1) . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="text-center">
                        <button id="buttonNilai" class="btn btn-primary btn-block mt-5 mb-4">Nilai</button>
                      </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                          <button id="update" class="btn btn-success btn-block mt-5 mb-4">Refresh</button>
                        </div>
                    </div>
                  </div>
                  
                
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
    <script src="../../assets/js/argon.js?v=1.2.0"></script>
    <div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>


  </body>
  <script src="../../assets/js/sweetalert2.min.js"></script>
  </html>
  <script>
    $('document').ready(function(){
      
      $('#update').click(function(){
        window.location.reload();
      });

      //PROSES INPUT DATA
      $('#buttonNilai').click(function(){
        var username = $('#username').val();
        var namaAtlet = $('#namaAtlet').val();
        var nilaiTeknik = $('#nilaiTeknik').val();
        var nilaiAtletik = $('#nilaiAtletik').val();
        //mainkan ajax nya
        $.ajax({
          url:'simpanDataJuri.php',
          type:'POST',
          data:{
            "username":username,
            "namaAtlet":namaAtlet,
            "nilaiTeknik":nilaiTeknik,
            "nilaiAtletik":nilaiAtletik,
          },
          success:function(response){
            console.log("response: ", response);
            response = response.trim()
            if(response == "success"){
                Swal.fire({
                  type:'success',
                  title:'berhasil',
                  text:'nilai berhasil diinput',
                }).then(function(){
                  window.location.href='index.php';
                  console.log(response);
                });
            }else if(response == 'sudah'){
              Swal.fire({
                type:'warning',
                title:'gagal',
                text:'Atlet ini sudah anda nilai klik untuk melanjutkan',
              }).then(function(){
                window.location.href='index.php';
               
              });
            }else if(response == 'mismatch'){
              Swal.fire({
                type:'info',
                title:'Update',
                text:'Data atlet tidak cocok klik untuk melanjutkan',
              }).then(function(){
                window.location.href='index.php';
               
              });
            }else {
              Swal.fire({
                type:'error',
                title:'gagal',
                text:'Gagal simpan data klik untuk melanjutkan',
              }).then(function(){
                window.location.href='index.php';
               
              });
            }
          }
        });
      });
    });
  </script>
<?php
} 
?>