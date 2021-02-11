<?php
@session_start();
if (!isset($_SESSION['username'])) {
    @header("location:../login");
} else {
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
                //HARUS DI TAMBAHKAN 1 UNTUK MENYIMPAN KE REKAP
                $bermain = $data['bermain']+1;
                //proses update ke table point
                $sqlPoint = "UPDATE `point` SET idAtlet = '$idAtlet', namaAtlet = '$namaAtlet', kelas = '$kelas', kontingen = '$kontingen', namaKata = '$namaKata', 
                            grup = '$grup', atribut = '$atribut', statusPenilaian = 'staging', nilaiTeknik = 0, nilaiAtletik=0, juriMenilai = 0, bermain = '$bermain';";
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

            if ($jumlahJuriMenilai == 5) {
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
                    
                     
                    //MENYIMPAN DATA REKAP
                    $sqlRekap = "INSERT INTO rekap (idRekap, idAtlet, grup, T1, T2, T3, T4, T5, A1, A2, A3, A4, A5, bermain, totalPoint)
                    VALUES ('', '$idAtlet','$grup', '$nilaiTeknik[0]', '$nilaiTeknik[1]', '$nilaiTeknik[2]', '$nilaiTeknik[3]', '$nilaiTeknik[4]',
                    '$nilaiAtletik[0]', '$nilaiAtletik[1]', '$nilaiAtletik[2]', '$nilaiAtletik[3]', '$nilaiAtletik[4]', '$bermain', '$totalPoint')";
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
            } else {

                //JIKA JUMLAH JURI MENILAI KURANG DARI 5
                echo '<div class="card card-body"><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Gagal Proses!</strong> ada Juri Belum Menilai</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div></div>';
            }
        } else {

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
            grup = '-', atribut = '-', nilaiTeknik = 0, nilaiAtletik = 0, statusPenilaian = 'standby', juriMenilai = 0, bermain = 0");
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
        $grup = $_POST['grup'];
        foreach ($idAtlet as $key => $val) {
            $sqlPoint = "UPDATE `point` SET `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
            $sqlAtlet = "UPDATE `atlet` SET `grup` = '$grup[$key]', `namaKata` = '$namaKata[$key]', `atribut` = '$atribut[$key]' WHERE `idAtlet` = '$idAtlet[$key]';";
            mysqli_query($conn, $sqlPoint);
            mysqli_query($conn, $sqlAtlet);
        }
    }
    ?>
    <!-- Se table -->
    <div class="container-fluid mt-4">
        <!-- Card header -->

        <div class="card-header border-0">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <p class="mb-0">Pilih Grup :
                    </p>

                </div>
                <div class="col-md-6">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control" name="grup">
                                    <?php
                                    //menghindari duplikasi pada record
                                    $sql = "SELECT DISTINCT grup from atlet";
                                    $hasil = mysqli_query($conn, $sql);
                                    while ($data = mysqli_fetch_array($hasil)) {
                                        if ($data[0] != "final" and $data[0] != "Bronze-1" and $data[0] != "Bronze-2") {
                                            echo "<option value='$data[0]'>$data[0]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">

                                <input class="btn btn-success" type="submit" value="proses">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <form action="#" method="POST">
            <table id="example" class="table table-striped table-bordered nowrap" style="width:110%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Nama Atlet</th>
                        <th>Proses</th>
                        <th>Nama Kata</th>
                        <th style="width:100px">Grup</th>
                        <th style="width:100px">Atribut</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_GET['grup'])) {
                        //jika grup dipilih
                        $grup = $_GET['grup'];
                        $i = 1;
                        $sql = "SELECT * FROM atlet WHERE grup = '$grup'";
                        $hasil = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($hasil)) { ?>
                            <tr>
                                <td class="text-muted"><?= $i ?></td>
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
                                <td class="text-muted"><?= $data['namaAtlet']; ?></td>
                                <td class="text-muted">
                                    <!-- dari sini proses dilempar ke TOMBOL PLAY DIATAS  -->
                                    <a href="?grup=<?= $data['grup'] ?>&&idAtlet=<?= $data['idAtlet'] ?>" class="btn btn-warning"><i class="ni ni-button-play"></i>&nbsp;play</a>

                                    <!-- dari sini proses dilempar ke TOMBOL STOP DIATAS  -->
                                    <a href="?grup=<?= $data['grup'] ?>&&idSimpan=<?= $data['idAtlet'] ?>" class="btn btn-primary"><i class="ni ni-button-power"></i>&nbsp;stop / save</a>
                                    <!--dilanjutkan ke line TOMBOL RESET DIATAS-->
                                    <a href="?grup=<?= $data['grup'] ?>&&reset=<?= $data['idAtlet'] ?>" class="btn btn-danger">↻&nbsp;reset</a>
                                </td>
                                <input type="hidden" name="idAtlet[]" value="<?= $data['idAtlet'] ?>">
                                <td class="text-muted"><textarea class="form-control awesomplete" id="kata" name="namaKata[]" cols="30" rows="3"><?= $data['namaKata'] ?></textarea></td>
                                <td class="text-muted">
                                    <select name="grup[]" class="form-control">
                                        <option value="<?= $data['grup'] ?>"><?= $data['grup'] ?></option>
                                        <option value="Bronze-1">Lanjut Bronze-1</option>
                                        <option value="Bronze-2">Lanjut Bronze-2</option>
                                        <option value="final">Lanjut Final</option>
                                    </select>
                                </td>
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

<?php } ?>