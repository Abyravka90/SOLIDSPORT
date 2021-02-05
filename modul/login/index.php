<?php 
  include "../../config/templates/header.php";
  include "../../config/database/koneksi.php";
?> 
  <body background="../../assets/img/banner2.jpg" class="g-sidenav-show g-sidenav-pinned" style="min-height: 100vh;">
    <div class="main-content">
      <div class="header py-6 py-lg-7 pt-lg-7">    
      </div>
      <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card">
                  <div class="card-body text-center">
                    <img height="150px" src="../../assets/img/logo-2.jpeg">
                    <!--Blok PHP akan Muncul disini untuk logika login -->
                    <?php if (isset($_POST['username'])){
                      $username =  $_POST['username'];
                      $password = md5($_POST['password']);
                      $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password'";
                      $result = mysqli_query($conn, $sql);
                      $data = mysqli_fetch_array($result);
                      if (!empty($data)) {
                          @session_start();
                          $_SESSION['username'] = $data['username'];
                          $_SESSION['level'] = $data['level'];
                          $_SESSION['statusLogin'] = $data['statusLogin'];
                          $username = $data['username'];
                          $updateStatusLogin = "UPDATE `user` SET statusLogin = statusLogin+1 WHERE `username` = '$username' ";
                          mysqli_query($conn, $updateStatusLogin);
                          if ($_SESSION['level'] == 1 ) {
                              header("location: ../atlet");
                          } else {
                              header("location: ../juri");
                          }
                          } else {echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
                                      <span class="alert-text"><strong>Gagal Log in!</strong>&nbsp;periksa kembali data anda</span>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>';}  
                    } ?>
                  </div>
                </div>
              <div class="card-body px-lg-5 py-lg-1">
                
                <form role="form" action="#" method="post">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                      </div>
                      <input name="username" class="form-control" placeholder="Username" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input name="password" class="form-control" placeholder="Password" type="password">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">Log in</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Core -->
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  
  </body></html>