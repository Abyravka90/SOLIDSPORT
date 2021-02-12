<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else{
    include "../../config/templates/header.php";
    include "../../config/templates/sidebar.php";
    include "../../config/templates/mainContent.php";
    include "../../config/database/koneksi.php";
    
    ?>
    <style>
        .blinking {
            animation: blinkingText 1.2s infinite;
            font-size: 40px;
        }
    
        @keyframes blinkingText {
            0% {
                color: #000;
            }
    
            49% {
                color: #000;
            }
    
            60% {
                color: transparent;
            }
    
            99% {
                color: transparent;
            }
    
            100% {
                color: #000;
            }
        }
    </style>
    <!--TOMBOL PLAY DI KLIK! proses update ke table point -->
    <?php
    if (isset($_GET['idAtlet'])) {
        $idAtlet = $_GET['idAtlet'];
        $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `point` LIMIT 1");
        while ($cekData = mysqli_fetch_array($sqlStatusPenilaian)) {
            $statusPenilaian = $cekData['statusPenilaian'];
        }
        if ($statusPenilaian != 'staging') {
            $sql = "SELECT * FROM atlet WHERE idAtlet = '$idAtlet'";
            $hasil = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_array($hasil)) {
                $idAtlet = $data['idAtlet'];
                $namaAtlet = $data['namaAtlet'];
                $kelas = $data['kelas'];
                $kontingen = $data['kontingen'];
                $namaKata = $data['namaKata'];
                $grup = $data['grup'];
                $atribut = $data['atribut'];
                //proses update ke table point
                $sqlPoint = "UPDATE `point` SET idAtlet = '$idAtlet', namaAtlet = '$namaAtlet', kelas = '$kelas', kontingen = '$kontingen', namaKata = '$namaKata', 
                            grup = '$grup', atribut = '$atribut', statusPenilaian = 'staging', nilaiTeknik = 0, nilaiAtletik=0, juriMenilai = 0;";
                mysqli_query($conn, $sqlPoint);
                $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'staging' WHERE idAtlet = '$idAtlet';";
                mysqli_query($conn, $sqlAtlet);
            }
        } else {
            echo 
                '<div class="card card-body"><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Gagal Play!</strong> belum di stop!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>';
        }
    }
    ?>


    <!-- TOMBOL STOP DI KLIK! proses simpan ke table klasemen -->
    <?php
    if (isset($_GET['idSimpan'])) {
        $idAtlet = $_GET['idSimpan'];
        $sqlStatusPenilaian = mysqli_query($conn, "SELECT statusPenilaian from `atlet` WHERE idAtlet = '$idAtlet' LIMIT 1");
        $cekData = mysqli_fetch_array($sqlStatusPenilaian);
        $statusPenilaian = $cekData['statusPenilaian'];
        if ($statusPenilaian == 'staging') {
        
            //jika jumlah juri menilai kurang dari yang ditentukan
            $sqlJuriMenilai = mysqli_query($conn, "SELECT SUM(juriMenilai) as `juriMenilai` from `point`");
            $rowJuriMenilai = mysqli_fetch_array($sqlJuriMenilai);
            $jumlahJuriMenilai = $rowJuriMenilai['juriMenilai'];
        
            if($jumlahJuriMenilai == 5){
                $sql = "SELECT * FROM `point` WHERE idAtlet = '$idAtlet' LIMIT 1";
                $hasil = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($hasil)) {
                    $idAtlet = $data['idAtlet'];
                    $namaAtlet = $data['namaAtlet'];
                    $atribut = $data['atribut'];
                    $kontingen = $data['kontingen'];
                    $grup = $data['grup'];
                    $bermain = $data['bermain'];
                    include '../../config/prosesPerhitungan.php';
                    $totalPoint = $totalNilai;
                     //MENYIMPAN KE TABEL KLASEMEN
                     $sqlKlasemen = "INSERT INTO klasemen (idKlasemen, idAtlet, namaAtlet, atribut, kontingen, grup, totalPoint) 
                     VALUES ('','$idAtlet','$namaAtlet','$atribut','$kontingen','$grup','$totalPoint')";
                     mysqli_query($conn, $sqlKlasemen);
                    //LOGIKA SELEKSI NILAI
                         //LOGIKA SELEKSI NILAI
                         $T1 = $nilaiTeknik[0]; $T2 = $nilaiTeknik[1]; $T3 = $nilaiTeknik[2]; $T4 = $nilaiTeknik[3]; $T5 = $nilaiTeknik[4];
                         $A1 = $nilaiAtletik[0]; $A2 = $nilaiAtletik[1]; $A3 = $nilaiAtletik[2]; $A4 = $nilaiAtletik[3]; $A5 = $nilaiAtletik[4];
                        //JIKA NILAINYA SAMA DENGAN NILAI DI CORET MAKA TAMBAH KE COUNTER
                        $counterTeknik1 = 0;
                        $counterTeknik2 = 0;
                        $counterAtletik1 = 0;
                        $counterAtletik2 = 0;
                         //nilaiterendahTeknik
                         if($T1 == $deretSisaTeknik1 AND $counterTeknik1 == 0 ){ $T1 = '('.$nilaiTeknik[0].')'; $counterTeknik1 = 1;}
                         if($T2 == $deretSisaTeknik1  AND $counterTeknik1 == 0 ){ $T2 = '('.$nilaiTeknik[1].')'; $counterTeknik1 = 1;}
                         if($T3 == $deretSisaTeknik1  AND $counterTeknik1 == 0 ){ $T3 = '('.$nilaiTeknik[2].')'; $counterTeknik1 = 1;}
                         if($T4 == $deretSisaTeknik1  AND $counterTeknik1 == 0 ){ $T4 = '('.$nilaiTeknik[3].')'; $counterTeknik1 = 1;}
                         if($T5 == $deretSisaTeknik1  AND $counterTeknik1 == 0 ){ $T5 = '('.$nilaiTeknik[4].')'; $counterTeknik1 = 1;}
                         //nilaiTertinggiTeknik
                         if($T1 == $deretSisaTeknik2 AND $counterTeknik2 == 0 ){ $T1 = '('.$nilaiTeknik[0].')'; $counterTeknik2 = 1;}
                         if($T2 == $deretSisaTeknik2  AND $counterTeknik2 == 0 ){ $T2 = '('.$nilaiTeknik[1].')'; $counterTeknik2 = 1;}
                         if($T3 == $deretSisaTeknik2  AND $counterTeknik2 == 0 ){ $T3 = '('.$nilaiTeknik[2].')'; $counterTeknik2 = 1;}
                         if($T4 == $deretSisaTeknik2  AND $counterTeknik2 == 0 ){ $T4 = '('.$nilaiTeknik[3].')'; $counterTeknik2 = 1;}
                         if($T5 == $deretSisaTeknik2  AND $counterTeknik2 == 0 ){ $T5 = '('.$nilaiTeknik[4].')'; $counterTeknik2 = 1;}
                         //nilaiTerendahAtletik
                         if($A1 == $deretSisaAtletik1 AND $counterAtletik1 == 0 ){ $A1 = '('.$nilaiAtletik[0].')'; $counterAtletik1 = 1;}
                         if($A2 == $deretSisaAtletik1  AND $counterAtletik1 == 0 ){ $A2 = '('.$nilaiAtletik[1].')'; $counterAtletik1 = 1;}
                         if($A3 == $deretSisaAtletik1  AND $counterAtletik1 == 0 ){ $A3 = '('.$nilaiAtletik[2].')'; $counterAtletik1 = 1;}
                         if($A4 == $deretSisaAtletik1  AND $counterAtletik1 == 0 ){ $A4 = '('.$nilaiAtletik[3].')'; $counterAtletik1 = 1;}
                         if($A5 == $deretSisaAtletik1  AND $counterAtletik1 == 0 ){ $A5 = '('.$nilaiAtletik[4].')'; $counterAtletik1 = 1;}
                         //nilaiTertinggiAtletik
                         if($A1 == $deretSisaAtletik2 AND $counterAtletik2 == 0 ){ $A1 = '('.$nilaiAtletik[0].')'; $counterAtletik2 = 1;}
                         if($A2 == $deretSisaAtletik2  AND $counterAtletik2 == 0 ){ $A2 = '('.$nilaiAtletik[1].')'; $counterAtletik2 = 1;}
                         if($A3 == $deretSisaAtletik2  AND $counterAtletik2 == 0 ){ $A3 = '('.$nilaiAtletik[2].')'; $counterAtletik2 = 1;}
                         if($A4 == $deretSisaAtletik2  AND $counterAtletik2 == 0 ){ $A4 = '('.$nilaiAtletik[3].')'; $counterAtletik2 = 1;}
                         if($A5 == $deretSisaAtletik2  AND $counterAtletik2 == 0 ){ $A5 = '('.$nilaiAtletik[4].')'; $counterAtletik2 = 1;}
                        
                         //MENYIMPAN DATA REKAP 
                        $sqlRekap =  "INSERT INTO rekap (idRekap, idAtlet, grup, T1, T2, T3, T4, T5, A1, A2, A3, A4, A5, bermain, totalPoint)
                        VALUES ('', '$idAtlet','$grup', '$T1', '$T2', '$T3', '$T4', '$T5',
                        '$A1', '$A2', '$A3', '$A4', '$A5', '$bermain', '$totalPoint')";
                         mysqli_query($conn, $sqlRekap);
                   
                   
                    $sqlPoint = "UPDATE `point` SET statusPenilaian = 'saved'";
                    mysqli_query($conn, $sqlPoint);
                    $sqlAtlet = "UPDATE `atlet` SET statusPenilaian = 'standby'";
                    mysqli_query($conn, $sqlAtlet);
                    $sqlHitungBermain = "UPDATE `atlet` SET bermain = bermain+1 WHERE idAtlet = '$idAtlet'";
                    mysqli_query($conn, $sqlHitungBermain);
                    echo '<div class="card card-body"><div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Berhasil</strong> data disimpan di tabel klasemen</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div></div>';
                    }
                }else{

                    echo "
                        <script>
                            alert('Gagal Proses!  ada Juri Belum Menilai');
                            window.history.back();
                        </script>
                        ";
                }
        } else{

            //STATUS PENILAIAN SELAIN STAGING
            echo '<div class="card card-body"><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Gagal Proses!</strong>BELUM AKTIF atau Bukan Atlet yang dimaksud</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div></div>';
        }
    }
    ?>
    <!-- TOMBOL RESET DI KLIK! proses reset nilai -->
    <?php
    if (isset($_GET['reset'])) {
        $reset = $_GET['reset'];
        if ($reset > 0) {
            mysqli_query($conn, "UPDATE `point` SET idAtlet = '-', namaAtlet = '-', kelas = '-', kontingen = '-', namaKata = '-',
            grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0");
            mysqli_query($conn, "UPDATE `atlet` SET statusPenilaian = 'standby'");
        }
    }
    ?>

    <!--PROSES UPDATE DATA ATLET-->
    <?php
    if (isset($_POST['idAtlet'])) {
        $idAtlet = $_POST['idAtlet'];
        $namaKata = $_POST['namaKata'];
        $atribut = $_POST['atribut'];
        foreach ($idAtlet as $key => $val) {
            $sqlPoint = "UPDATE `point` SET `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
            $sqlAtlet = "UPDATE `atlet` SET `grup` = 'final', `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
            mysqli_query($conn, $sqlPoint);
            mysqli_query($conn, $sqlAtlet);
        }
    }
    ?>
    <!-- Card header -->
    <div class="container-fluid border-0 mt-5 mb-5">
    
        <!-- Se table -->
        <form action="#" method="POST">
            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Nama Atlet</th>
                        <th>Group</th>
                        <th>Proses</th>
                        <th>Nama Kata</th>
                        <th>Atribut</th>
                    </tr>
                </thead>
                <tbody>
    
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM atlet WHERE grup = 'final' OR grup = 'Bronze-1' OR grup = 'Bronze-2' ORDER BY grup ";
                    $hasil = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($hasil)) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td class="text-muted"><?php if ($data['statusPenilaian'] == "staging") {
                                                            echo '<span class="blinking badge badge-success">bermain</span>';
                                                        } else {
                                                            $query = "SELECT DISTINCT idAtlet, statusPenilaian FROM `point` WHERE idAtlet = $data[idAtlet]";
                                                            $dataPoint = mysqli_query($conn, $query);
                                                            $cekDataPoint = mysqli_num_rows($dataPoint);
                                                            if ($cekDataPoint > 0) {
                                                                $rowPoint = mysqli_fetch_object($dataPoint);
                                                                if ($rowPoint->statusPenilaian == 'saved') {
                                                                    echo '<span class="blinking badge badge-primary">disimpan</span>';
                                                                }
                                                            }
                                                        } ?></td>
                            <td><?= $data['namaAtlet']; ?></td>
                            <td style="font-size:40px;"><?= $data['grup']; ?></td>
                            <td>
                                <!-- dari sini proses dilempar ke TOMBOL PLAY DIATAS  -->
                                <button type="button" onclick="handleURL('?grup=<?= $data['grup'] ?>&&idAtlet=<?= $data['idAtlet'] ?>')" class="btn btn-warning" id="btn-play-<?= $data['idAtlet'] ?>" disabled="disabled"><i class="ni ni-button-play"></i>&nbsp;play</button>

                                <!-- dari sini proses dilempar ke TOMBOL STOP DIATAS  -->
                                <button type="button" onclick="handleURL('?grup=<?= $data['grup'] ?>&&idSimpan=<?= $data['idAtlet'] ?>')" class="btn btn-primary" id="btn-stop-<?= $data['idAtlet'] ?>" disabled="disabled"><i class="ni ni-button-power"></i>&nbsp;stop / save</button>
                                <!--dilanjutkan ke line TOMBOL RESET DIATAS-->
                                <button type="button" onclick="handleURL('?grup=<?= $data['grup'] ?>&&reset=<?= $data['idAtlet'] ?>')" class="btn btn-danger" id="btn-reset-<?= $data['idAtlet'] ?>" disabled="disabled">↻&nbsp;reset</button>
                            </td>
                            <input type="hidden" name="idAtlet[]" value="<?= $data['idAtlet'] ?>">
                            <td><textarea class="form-control awesomplete" name="namaKata[]" id="kata" cols="10" rows="3"><?= $data['namaKata'] ?></textarea></td>
                            <td>
                                <select name="atribut[]" class="form-control">
                                    <option value="Aka" <?php if ($data['atribut'] == 'Aka') {
                                                            echo 'selected';
                                                        } ?>>Aka</option>
                                    <option value="Ao" <?php if ($data['atribut'] == 'Ao') {
                                                            echo 'selected';
                                                        } ?>>Ao</option>
                                </select>
                            </td>
                        </tr>
                    <?php $i++;
                    }
    
                    ?>
                </tbody>
            </table>
            <div class="pl-3">
                <!-- lanjut ke line 90-->
                <input class="btn btn-warning" name="update" type="submit" value="Ubah data">
        </form>
    </div>
    </div>
    <!-- Footer -->
    <?php
    include "../../config/templates/footer.php";
    ?>
    </body>
    <script>
    const input = document.querySelectorAll("[id='kata']");
    for(var i = 0; i < input.length; i++) {
        const awesomplete = new Awesomplete(input[i], {
            minChars: 1
        })
        awesomplete.list = ["ANAN"  ,   "JIIN"  ,   "PASSAI" ,
            "ANAN DAI"  ,   "JION"  ,   "PINAN SHODAN",
            "ANANKO"    ,   "JITTE" ,   "PINAN NIDAN",
            "AOYAGI"    ,   "JYUROKU"   ,   "PINAN SANDAN",
            "BASSAI"    ,   "KANCHIN"   ,   "PINAN YONDAN",
            "BASSAI DAI",   "KANKU DAI" ,   "PINAN GODAN",
            "BASSAI SHO"    ,   "KANKU SHO" ,   "ROHAI",
            "CHATANYARA KUSHANKU"   ,   "KANSHU"    ,   "SAIFA",
            "CHIBANA NO KUSHANKU"   ,   "KISHIMOTO NO KUSHANKU" ,   "SANCHIN",
            "CHINTE"    ,   "KOSOUKUN"  ,   "SANSAI",
            "CHINTO"    ,   "KOSOUKUN DAI"  ,   "SANSEIRU",
            "ENPI"  ,   "KOSOUKUN  SHO" ,   "SANSERU",
            "FUKYGATA ICHI" ,   "KURURUNFA" ,   "SEICHAN",
            "FUKYGATA NI"   ,   "KUSANKU",      "SEIENCHIN (SEIYUNCHIN)",
            "GANKAKU",      "KYAN NO CHINTO",       "SEIPAI",
            "GARYU" ,   "KYAN NO WANSHU",       "SEIRYU",
            "GEKISAI (GEKSAI) ICH",     "MATSUKAZE" ,   "SEISHAN",
            "GEKISAI (GEKSAI) NI"   ,   "MATSUMURA BASSAI",     "SEISAN (SESAN)",
            "GOJUSHIHO" ,   "MATSUMURA ROHAI"   ,   "SHIHO KOUSOUKUN",
            "GOJUSHIHO DAI" ,   "MEIKYO"    ,   "SHINPA",
            "GOJUSHIHO SHO" ,   "MYOJO" ,   "SHINSEI",
            "HAKUCHO"   ,   "NAIFANCHIN SHODAN" ,   "SHISOCHIN",
            "HANGETSU"  ,   "NAIFANCHIN NIDAN"  ,   "SOCHIN",
            "HAUFA (HAFFA)" ,   "NAIFANCHIN SANDAN" ,   "SUPARINPEI",
            "HEIAN SHODAN"  ,   "NAIHANCHIN",       "TEKKI SHODAN",
            "HEIAN NIDAN"   ,   "NIJUSHIHO" ,   "TEKKI NIDAN",
            "HEIAN SANDAN"  ,   "NIPAIPO",      "TEKKI SANDAN",
            "HEIAN YONDAN",     "NISEISHI",     "TENSHO",
            "HEIAN GODAN",      "OHAN",     "TOMARI BASSAI",
            "HEIKU",        "OHAN DAI",     "UNSHU",
            "ISHIMINE BASSAI",      "OYADOMARI NO PASSAI",      "UNSU",
            "ITOSU ROHAI SHODAN",       "PACHU" ,   "USEISHI",
            "ITOSU ROHAI NIDAN" ,   "PAIKU",        "WANKAN",
            "ITOSU ROHAI SANDAN",       "PAPUREN",      "WANSHU",

        ];
        awesomplete.evaluate();
        
    }
</script>
    
    </html>
<?php } ?>
