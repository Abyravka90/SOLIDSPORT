<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php"
    ?>
    
    <!-- Ambil Dari Database -->
    <?php 
    //jika data udah ada
    if(isset($_POST['nilaiTeknik'])){
        $i = 0;
        $namaJuri = $_POST['namaJuri'];
        $nilaiTeknik = $_POST['nilaiTeknik'];
        $nilaiAtletik = $_POST['nilaiAtletik'];
        foreach($nilaiTeknik as $key => $val){
        $sql = "UPDATE `point` SET `nilaiTeknik` = '$nilaiTeknik[$key]', `nilaiAtletik` = '$nilaiAtletik[$key]', `juriMenilai` = 1 WHERE `namaJuri` = '$namaJuri[$key]' ;";
        mysqli_query($conn, $sql);
        $i+=1;
        }
        if($i>0)
        {
            echo '<div class="card card-body"><div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Berhasil</strong> data nilai disimpan</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div></div>';
        }
        else
        {
            echo '<div class="card card-body"><div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Gagal!</strong> data tidak disimpan</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div></div>';
        }
    }
        //kumpulan data tiap record
        $sql = "SELECT `namaJuri`, `nilaiTeknik`, `nilaiAtletik` FROM `point`";
        $data = mysqli_query($conn, $sql);
        $data2 = mysqli_query($conn, $sql);//data nilai teknik
        $data3 = mysqli_query($conn, $sql);// data nilai atletik
        //ambil nama atlet dan kontingennya
        $sqlAtlet = "SELECT `namaAtlet`, `kontingen` from `point` ORDER BY namaAtlet LIMIT  1";
        $dataAtlet = mysqli_query($conn, $sqlAtlet);
        $row = mysqli_fetch_array($dataAtlet);
        $namaAtlet = $row['namaAtlet'];
        $kontingen = $row['kontingen'];
    ?>
    <div class="container-fluid mt-5 mb-5">
    <form action="#" method="post">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                <th colspan=3> Nama Atlet : <h1><span  class="badge badge-success"><?= $namaAtlet ?></span></h1></th>
                <th colspan=3> Kontingen : <h1><span  class="badge badge-primary"><?= $kontingen ?></span></h1></th>
                </tr>
                <tr>
                    <th>Nilai</th>
                    <?php while($row=mysqli_fetch_array($data)){
                        echo "<th>$row[namaJuri]</th>";//namaJuri
                    } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nilai Teknik</td>
                    <?php while($row2=mysqli_fetch_array($data2)){
                         echo '<td><input type="hidden" name="namaJuri[]" value='.$row2['namaJuri'].'><input name = "nilaiTeknik[]" value='.$row2['nilaiTeknik'].' type="number" class="form-control" name="nilaiTeknik" placeholder="0.0" min="0" max="10" step=0.1></td>';
                  
                    } ?>
                </tr>
                <tr>
                    <td>Nilai Atletik</td>
                    <?php while($row3=mysqli_fetch_array($data3)){
                        echo '<td><input type="hidden" name="namaJuri[]" value='.$row3['namaJuri'].'><input name="nilaiAtletik[]" value='.$row3['nilaiAtletik'].' type="number" class="form-control" name="nilaiTeknik" placeholder="0.0" min="0" max="10" step=0.1></td>';
                    }?>
                </tr>
            </tbody>
        </table>
        <input name = "simpan" type="submit" value="simpan" class="btn btn-primary">&nbsp;
    </form>
    <a style="font-size:17px;" href="" class="btn btn-info">&#8635;</a>
    </div>
    
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
    
    </html>
<?php } ?>
