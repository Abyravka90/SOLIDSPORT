<?php 
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    //jika grup dipilih
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
                        $grup = $_GET['grup'];
                        $i = 1;
                        $sql = "SELECT * FROM atlet WHERE grup = '$grup'";
                        $hasil = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($hasil)){ ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?php if($data['bermain'] == 1){ echo '<span class="blinking badge badge-success">bermain</span>';} ?></td>
                                <td><?= $data['namaAtlet']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning"><i class="ni ni-button-play"></i>&nbsp;mainkan</a>
                                        <br><br>
                                    <a href="#" class="btn btn-primary"><i class="ni ni-book-bookmark"></i>&nbsp;simpan nilai</a>
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
                <input class="btn btn-secondary" type="submit" value="reset pertandingan">
                </form>
                </div>
                <!-- Footer -->
<?php 
    include "../../config/templates/footer.php";
?>
</body>
</html>