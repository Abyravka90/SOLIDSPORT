<?php
@session_start();
if (!isset($_SESSION['username'])) {
    header("location:../login");
} else {
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //JIKA TOMBOL UBAH PASSWORD DI KLIK
    if(isset ($_GET['idUser'])){
      $idUser = $_GET['idUser'];
      $sqlUser = mysqli_query($conn, "SELECT * FROM `user` WHERE `idUser` = '$idUser' ");
      if(mysqli_num_rows($sqlUser)>0){
        $row = mysqli_fetch_object($sqlUser);
        echo '
        <div class="card">
          <div class="card-body">
            <form action="tambahUser.php" method="post">
            <h1><span class="badge badge-danger">UBAH DATA : </span><span class="badge badge-success">'.$row -> username.'</span></h1>
            <input type="hidden" name="idUser" value='.$row -> idUser.'>
            <h5>Password baru</h5>
            <input style="width:300px;" type="password"  name="password1" class="form-control">
            <h5>Ulangi Password</h5>
            <input type="password" style="width:300px;"  name="password2" class="form-control" required>
            <br/><button type="submit" class="btn btn-info">Simpan</button>
            </form>
          </div>
        </div>';
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
                    <?= $row -> statusLogin ?>
                    </td><td>
                    <?php if($row -> level == 1 ) {echo 'admin';} else { echo 'juri'; } ?>
                    </td><td>
                    <a href="?idUser=<?= $row -> idUser ?>" class="btn btn-success">ubah password</a>
                    </td>
                </tr>
                <?php 
                }
                ?>
            </thead>
        </table>
        </div>
        <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
    </html>
    <?php }
    ?>