<?php
@session_start();
if (!isset($_SESSION['username'])) {
    header("location:../login");
} else {
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";

    //JIKA TOMBOL LOGOUT DI KLIK 
    if(isset($_GET['logout'])){
      $logout = $_GET['logout'];
      if($logout != 'admin'){
        mysqli_query($conn, "UPDATE `user` set `statusLogin` = 0 WHERE `username` = '$logout'");
        echo "
                    <script>
                    setTimeout(function(){
                        Swal.fire({
                            type:'success',
                            title : 'Berhasil',
                            text : 'Login Berhasil di Reset',
                        });
                    },3)
                    </script>
                    ";
      }
    }

    //JIKA TOMBOL UBAH PASSWORD DI KLIK
    if(isset($_POST['password2'])){
      $idUser = $_POST['idUser'];
      $password1 = $_POST['password1'];
      $password2 = $_POST['password2'];
      if($password1 == $password2){
      mysqli_query($conn,"UPDATE `user` SET `password` = md5('$password2') WHERE idUser = '$idUser'");
      echo "
      <script>
      setTimeout(function(){
          Swal.fire({
              type:'success',
              title : 'Berhasil',
              text : 'Password Berhasil dirubah',
          });
      },3)
      </script>
      ";
      }else{
        echo "
        <script>
        setTimeout(function(){
            Swal.fire({
                type:'error',
                title : 'Gagal',
                text : 'Password tidak cocok',
            });
        },3)
        </script>
        ";
      }
    }
?>
        <!-- Card header -->
        <div class="container-fluid mt-5 mb-5 border-0">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status Login</th>
                    <th>Level</th>
                    <th>Edit</th>
                    <th>Logout</th>
                </tr>
                <?php 
                $sqlUser = mysqli_query($conn, "SELECT * FROM `user` ");
                while($row = mysqli_fetch_object($sqlUser)){?>

                <tr>
                    <td>
                    <?= $row -> idUser ?>
                    </td>
                    <td>
                    <?= $row -> username ?>
                    </td>
                    <td>
                    <?= $row -> password ?>
                    </td><td>
                    <?php if($row -> statusLogin == 0 ) {echo '<span class="badge badge-danger">logout</span>';} else { echo '<span class="badge badge-success">login</span>'; } ?>
                    </td><td>
                    <?php if($row -> level == 1 ) {echo 'admin';} else { echo 'juri'; } ?>
                    </td>
                    <td>
                    <button class="btn btn-success" onclick="getUserId(<?= $row->idUser ?>)" data-toggle="modal" data-target="#resetPasswordModal">ubah password</button>
                    </td>
                    <td>
                    <?php if($row -> level == 2) {?><a href="?logout=<?= $row -> username ?>" class="btn btn-danger">Reset Login</a> <?php } ?>
                    </td>
                </tr>
                <?php 
                }
                ?>
            </thead>
        </table>
        <!-- Modal reset password -->
        <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <form action="" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Reset Password User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="idUser" value="" id="idUser">
                  <div class="row">
                    <div class="col-md-12 pb-2">
                      <label>Password baru: </label>
                      <input type="password" class="form-control" name="password1" />
                    </div>
                    <div class="col-md-12">
                      <label>Ulangi password baru: </label>
                      <input type="password" class="form-control" name="password2"/>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        </div>
        <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
    <script>
      function getUserId(idUser) {
        document.getElementById('idUser').value = idUser;
      }
    </script>
    </html>
    <?php }
    ?>