<?php 
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    
?>
                <style>
                .blinking{
                    animation:blinkingText 1.2s infinite;
                    font-size:40px;
                }
                @keyframes blinkingText{
                    0%{     color: #000;    }
                    49%{    color: #000; }
                    60%{    color: transparent; }
                    99%{    color:transparent;  }
                    100%{   color: #000;    }
                }
                </style>
                <!-- proses update ke table point -->
                <?php
                if (isset($_GET['idAtlet'])){
                    $idAtlet = $_GET['idAtlet'];
                    $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `point` LIMIT 1");
                    while($cekData = mysqli_fetch_array($sqlStatusPenilaian)){$statusPenilaian = $cekData['statusPenilaian'];}
                    if($statusPenilaian != 'staging'){
                        $sql = "SELECT * FROM atlet WHERE idAtlet = '$idAtlet'";
                        $hasil = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($hasil)){
                        $idAtlet = $data['idAtlet'];
                        $namaAtlet = $data['namaAtlet'];
                        $kelas = $data['kelas'];
                        $kontingen = $data['kontingen'];
                        $namaKata = $data['namaKata'];
                        $grup = $data['grup'];
                        $atribut = $data['atribut'];
                        //proses update ke table point
                        $sqlPoint = "UPDATE `point` SET idAtlet = '$idAtlet', namaAtlet = '$namaAtlet', kelas = '$kelas', kontingen = '$kontingen', namaKata = '$namaKata', 
                        grup = '$grup', atribut = '$atribut', statusPenilaian = 'staging';"; 
                        mysqli_query($conn, $sqlPoint);
                        $sqlAtlet = "UPDATE `atlet` SET bermain = bermain+1, statusPenilaian = 'staging' WHERE idAtlet = '$idAtlet';";
                        mysqli_query($conn, $sqlAtlet);
                    }
                    }else{
                        echo '<script>alert("silahkan klik tombol stop terlebih dahulu")</script>';
                    }
                    
                }
                ?>
                <!-- proses simpan ke table klasemen -->
                <?php
                    if(isset($_GET['idSimpan'])){
                    $idAtlet = $_GET['idSimpan'];
                    $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `atlet` WHERE idAtlet = '$idAtlet' LIMIT 1");
                    while($cekData = mysqli_fetch_array($sqlStatusPenilaian)){$statusPenilaian = $cekData['statusPenilaian'];}
                    if($statusPenilaian == 'staging'){
                        $sql = "SELECT * FROM `point` WHERE idAtlet = '$idAtlet' LIMIT 1";
                        $hasil = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($hasil)){
                            $idAtlet = $data['idAtlet'];
                            $namaAtlet = $data['namaAtlet'];
                            $kontingen = $data['kontingen'];
                            $grup = $data['grup'];
                            $totalPoint = 0 ;
                            $sqlKlasemen = "INSERT INTO klasemen (idKlasemen, idAtlet, namaAtlet, kontingen, grup, totalPoint) 
                            VALUES ('','$idAtlet','$namaAtlet','$kontingen','$grup','$totalPoint')";
                            mysqli_query($conn, $sqlKlasemen);
                            $sqlPoint = "UPDATE `point` SET statusPenilaian = 'saved'";
                            mysqli_query($conn, $sqlPoint);
                            $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'standby'";
                            mysqli_query($conn, $sqlAtlet);
                        }
                    } else {
                        echo '<script>alert("bukan atlet yang sedang bermain")</script>';
                    }   
                    }
                ?>
            <!-- Card header -->
                <div class="card-header border-0">
                  <h1 class="mb-0">Pertandingan Grup</h1>
                </div>
                <div class="card-header border-0">
                  <h3 class="mb-0">Pilih Grup : 
                  <form action="" method="GET">
                    <select class="form-control" name="grup" >
                        <?php 
                            //menghindari duplikasi pada record
                            $sql = "SELECT DISTINCT grup from atlet";
                            $hasil = mysqli_query($conn, $sql);
                            while($data=mysqli_fetch_array($hasil)){
                                echo "<option value='$data[0]'>$data[0]</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <input class="btn btn-default" type="submit">
                    </form>
                  </h3>
                </div>
            <!-- Se table -->
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Nama Atlet</th>
                        <th>Proses</th>
                        <th>Nama Kata</th>
                        <th>Atribut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($_GET['grup'])){
                        //jika grup dipilih
                        $grup = $_GET['grup'];
                        $i = 1;
                        $sql = "SELECT * FROM atlet WHERE grup = '$grup'";
                        $hasil = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($hasil)){ ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?php if($data['statusPenilaian'] == "staging"){ echo '<span class="blinking badge badge-success">bermain</span>';} ?></td>
                                <td><?= $data['namaAtlet']; ?></td>
                                <td>
                                <!-- dari sini proses dilempar ke line 23 -->
                                    <a href="?grup=<?= $data['grup'] ?>&&idAtlet=<?= $data['idAtlet'] ?>" class="btn btn-warning"><i class="ni ni-button-play"></i>&nbsp;play</a>
                                        <br><br>
                                <!-- dari sini proses dilempar ke line 44-->
                                    <a href="?grup=<?= $data['grup'] ?>&&idSimpan=<?= $data['idAtlet'] ?>" class="btn btn-primary"><i class="ni ni-button-power"></i>&nbsp;stop</a>
                                </td>
                                <form action="">
                                <td><input type="text" name="namaKata[]" class="form-control" value="<?= $data['namaKata']?>"></td>
                                <td>
                                    <select name="atribut[]" class="form-control">
                                        <option value="Aka" <?php if($data['atribut'] == 'Aka'){ echo 'selected';} ?>>Aka</option>
                                        <option value="Ao" <?php if($data['atribut'] == 'Ao'){ echo 'selected';} ?>>Ao</option>
                                    </select>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                </tbody>
                </table>
                <div class="pl-3">
                <input class="btn btn-primary" type="submit" value="rubah data">
                </form>
                <input class="btn btn-secondary" type="submit" value="reset pertandingan">
                </div>
                <!-- Footer -->
<?php 
    include "../../config/templates/footer.php";
?>
</body>
</html>