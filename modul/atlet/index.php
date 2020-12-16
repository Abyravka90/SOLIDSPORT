<?php 
@session_start();
if(!isset($_SESSION['username'])){
    @header("location:../login");
}else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //jika tombol update ditekan
    if(isset($_POST['update'])){
        $idAtlet = $_POST['idAtlet'];
        $namaAtlet = $_POST['namaAtlet'];
        $namaKata = $_POST['namaKata'];
        $kontingen = $_POST['kontingen'];
        $grup = $_POST['grup'];
        $atribut = $_POST['atribut'];
        $kelas = $_POST['kelas'];
        foreach($idAtlet as $key => $val){
            $sql = "UPDATE atlet SET namaAtlet = '$namaAtlet[$key]', namaKata = '$namaKata[$key]', kontingen = '$kontingen[$key]',
            grup = '$grup[$key]', atribut = '$atribut[$key]', kelas = '$kelas[$key]' WHERE idAtlet = $idAtlet[$key];";
            $sukses = mysqli_query($conn,$sql);
        }
    }
    //jika tombol hapus ditekan
    if(isset($_GET['idAtlet'])){
        $idAtlet = $_GET['idAtlet'];
        mysqli_query($conn, "DELETE FROM atlet WHERE idAtlet = '$idAtlet'");
    }

    //jika tombol reset data ditekan
    if(isset($_GET['reset'])){
        $reset = $_GET['reset'];
        if($reset=='6512bd43d9caa6e02c990b0a82652dca'){
            mysqli_query($conn, "DELETE FROM atlet");
            mysqli_query($conn, "ALTER TABLE atlet auto_increment=0");
        }
    }

?>
    <!--disini blok jika session berjalan nya-->
                    <div class="card-header border-0">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
                            <span class="alert-text"><strong>Welcome <?= $_SESSION['username']; ?> </strong>&nbsp;periksa kembali data anda</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h1 class="mb-0">Data Atlet</h1>
                    </div>
            <!-- Se table -->
            <div class="card-body">
            <div class="col-md-12">
            <form action="#" method="POST" enctype="multipart/form-data">
                    <table table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="120%">
                        <thead class="thead-light">
                            <tr>
                                <th>action</th>
                                <th>No</th>
                                <th>Nama Atlet</th>
                                <th>Nama Kata</th>
                                <th>Kontingen</th>
                                <th>Grup</th>
                                <th>Atribut</th>
                                <th>Bermain</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php 
                            $i=1;
                            $sql = mysqli_query($conn,"SELECT * FROM atlet");
                            while($data = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                <td><a class="btn btn-danger" href="?idAtlet=<?= $data['idAtlet']?>"><i class="ni ni-fat-delete"></i></a></td>
                                <td><?= $i ?></td>
                                <td><textarea class="form-control" name="namaAtlet[]" id="" cols="10" rows="4"><?= $data['namaAtlet']; ?></textarea></td>
                                <td><textarea class="form-control" name="namaKata[]" id="" cols="10" rows="4"><?= $data['namaKata']; ?></textarea></td>
                                <td><textarea class="form-control" name="kontingen[]" id="" cols="10" rows="4"><?= $data['kontingen']; ?></textarea></td>
                                <td><input class = "form-control" type="text" name="grup[]" id="" value="<?= $data['grup']; ?>"></td>
                                <td>
                                    <select class="form-control" name="atribut[]">
                                        <option value="Aka" <?php if($data['atribut'] == "Aka"){echo "selected";} ?>><span class="badge badge-default"> Aka</span></option>
                                        <option value="Ao" <?php if($data['atribut'] == "Ao"){echo "selected";}?>><span class="badge badge-danger">Ao</span></option>
                                    </select>
                                </td>
                                <td>sudah</td>
                                <td><textarea class="form-control" name="kelas[]" id="" cols="10" rows="4"><?= $data['kelas']; ?></textarea></td>
                                <input type="hidden" name="idAtlet[]" value=<?= $data['idAtlet']; ?>>
                                </tr>
                            <?php
                            $i++;
                            } 
                            ?>
                        </tbody>
                    </table>
                <div class="pl-3">
                    <input type="submit" class="btn btn-primary" name="update" value="update"></input>
                    <a href="?reset=<?= md5(11) ?>" class="btn btn-success">reset</a>
                </div>
                </form>
            </div> 
            </div>
<?php
    } 
    include "../../config/templates/footer.php";
?>
</body>
</html>