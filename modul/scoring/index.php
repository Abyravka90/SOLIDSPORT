<?php
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
    $sql = "UPDATE `point` SET `nilaiTeknik` = '$nilaiTeknik[$key]', `nilaiAtletik` = '$nilaiAtletik[$key]' WHERE `namaJuri` = '$namaJuri[$key]' ;";
    mysqli_query($conn, $sql);
    $i+=1;
    }
    if($i>0){echo "<script>alert('data berhasil dirubah');</script>";}else{echo "<script>alert('data gagal dirubah');</script>";}
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
    <input name = "simpan" type="submit" value="simpan" class="btn btn-primary">&nbsp;<a style="font-size:17px;" href="#" class="btn btn-info">&#8635;</a>
</form>
</div>

<!-- Footer -->
<?php
include "../../config/templates/footer.php";
?>
</body>

</html>