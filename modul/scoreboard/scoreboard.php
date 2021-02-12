<html>
<meta http-equiv="refresh" content="0.5" charset="UTF-8">
<link rel="stylesheet" href="../../assets/css/style.css">
<?php
error_reporting(0);
include "../../config/templates/header.php";
include "../../config/database/koneksi.php";

$sqlScoreBoard = "SELECT * FROM `papanskor` WHERE `status` = 'aktif'";
$data = mysqli_query($conn, $sqlScoreBoard);
$row = mysqli_fetch_array($data);
$tampil = $row['jenisScoreboard'];
$grup = $row['grup'];
//ambil value  atlet dari table point ke layar
$sqlJuriMenilai = mysqli_query($conn, "SELECT SUM(juriMenilai) as juriMenilai from `point`");
$rowJuriMenilai = mysqli_fetch_array($sqlJuriMenilai);
$sqlPoint = mysqli_query($conn, "SELECT DISTINCT `namaAtlet`,`kontingen`,`grup`,`kelas`,`namaKata`, `atribut` FROM `point`");
$rowPoint = mysqli_fetch_array($sqlPoint);
$namaAtlet = $rowPoint['namaAtlet'];
$kontingen = $rowPoint['kontingen'];
$namaKata = $rowPoint['namaKata'];
$atribut = $rowPoint['atribut'];
$grup = $rowPoint['grup'];
$kelas = $rowPoint['kelas'];


//menghitung jumlah penilaian juri
$JuriMenilai = $rowJuriMenilai['juriMenilai'];


//ambil value nilai dan data Juri dari table point ke table yang ditampilkan
$sqlNilai = mysqli_query($conn, "SELECT `namaJuri`, `nilaiTeknik`, `nilaiAtletik` from `point`");
$sqlNilai2 = mysqli_query($conn, "SELECT `namaJuri`, `nilaiTeknik`, `nilaiAtletik` from `point`");
$sqlNilai3 = mysqli_query($conn, "SELECT `namaJuri`, `nilaiTeknik`, `nilaiAtletik` from `point`");
include '../../config/prosesPerhitungan.php';
?>

<body style="position:fixed; width: 100%; height: 100%;background:url('../../assets/img/banner3.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <h1 class="text-center pt-3" style="font-family: 'Montserrat', sans-serif;text-transform: uppercase;color: #fff;">
                    <b>
                        <?= $kelas ?> -
                        <i>Group <?= $grup ?></i>
                    </b>
                    <hr class="bg-white" />
                </h1>
                <hr>
            </div>
        </div>
    </div>



    <!--Jika Yang ditampilkan adalah Score Board-->
    <?php if ($tampil == 'scoreboard') { ?>
        <div class="container-fluid">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-<?php if ($atribut == 'Ao') {
                                                echo "primary";
                                            } else  if ($atribut == 'Aka') {
                                                echo "danger";
                                            } else {
                                                echo 'dark';
                                            } ?>" style="width: 100%;height: auto;">
                            <div class="card-body">
                                <h1 class="text-center blinking" *ngIf="finalScore && finalScore !== 1001 && finalScore !== 10000" style="font-size: 150px;color: white;">
                                    <b>
                                        <?php if ($JuriMenilai < 5) {
                                            echo "-";
                                        } else {
                                            if ($grup == 'final' or $grup == 'Bronze-1' or $grup =='Bronze-2') {
                                                echo '-';
                                            } else {
                                                echo number_format($totalNilai, 2);
                                            }
                                        }; ?>
                                    </b>

                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-4">
                        <div class="card">
                            <div class="container">
                                <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                    <?= $namaAtlet ?>
                                </h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="container">

                                <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                    <?= $kontingen ?>
                                </h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="container">

                                <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                    <?= $namaKata ?>
                                </h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================SCOREBOARD======================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">

                    <div class="table-responsive">

                        <table class="table">
                            <thead class="mt-0 bg-<?php if ($atribut == 'Ao') {
                                                        echo "primary";
                                                    } else  if ($atribut == 'Aka') {
                                                        echo "danger";
                                                    } else {
                                                        echo 'dark';
                                                    } ?>">

                                <tr class="text-center">
                                    <th style="background-color: #fff !important;">
                                        <div class="text-center">
                                            <img src="../../assets/img/logo-2.jpeg" class="img-fluid" style="width: 80px;" alt="">
                                        </div>
                                    </th>
                                    <!--selama ada data juri-->
                                    <?php while ($rowJuri = mysqli_fetch_array($sqlNilai)) { ?>
                                        <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:28px;padding:0px, 15px,20px,15px !important;"><?= $rowJuri['namaJuri'] ?><span class="dot bg-success" style="position:absolute"></span></th>
                                    <?php } ?>

                                    <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">FAC</th>
                                    <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">JUMLAH</th>
                                    <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">HASIL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">TEKNIK</th>
                                    <?php
                                    $hitungTeknik1 = 1;
                                    $hitungTeknik2 = 1;
                                    while ($rowTeknik = mysqli_fetch_array($sqlNilai2)) { ?>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="<?= $rowTeknik['namaJuri'] ?>">
                                        <?php if ($rowTeknik['nilaiTeknik'] == $deretSisaTeknik1 and $hitungTeknik1 <= 1) {
                                            echo "<del style = 'color:red;'>" . number_format($rowTeknik['nilaiTeknik'], 1) . "</del></td>";
                                            $hitungTeknik1++;
                                        } else if ($rowTeknik['nilaiTeknik'] == $deretSisaTeknik2 and $hitungTeknik2 <= 1) {
                                            echo "<del style = 'color:red;'>" . number_format($rowTeknik['nilaiTeknik'], 1) . "</del></td>";
                                            $hitungTeknik2++;
                                        } else {
                                            echo number_format($rowTeknik['nilaiTeknik'], 1);
                                        }
                                    }
                                        ?>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="FAC">0.7</td>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="JUMLAH"><?= $sumTeknik ?></td>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="HASIL"><?= $totalNilaiTeknik ?></td>
                                        </td>
                                </tr>
                                <tr class="text-center">
                                    <th class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">ATLETIK</th>

                                    <?php
                                    $hitungAtletik1 = 1;
                                    $hitungAtletik2 = 1;
                                    while ($rowAtletik = mysqli_fetch_array($sqlNilai3)) { ?>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="<?= $rowAtletik['namaJuri'] ?>">
                                        <?php if ($rowAtletik['nilaiAtletik'] == $deretSisaAtletik1 and $hitungAtletik1 <= 1) {
                                            echo "<del style = 'color:red;'>" . number_format($rowAtletik['nilaiAtletik'], 1) . "</del></td>";
                                            $hitungAtletik1++;
                                        } else if ($rowAtletik['nilaiAtletik'] == $deretSisaAtletik2 and $hitungAtletik2 <= 1) {
                                            echo "<del style = 'color:red;'>" . number_format($rowAtletik['nilaiAtletik'], 1) . "</del></td>";
                                            $hitungAtletik2++;
                                        } else {
                                            echo number_format($rowAtletik['nilaiAtletik'], 1);
                                        }
                                    }
                                        ?>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="FAC">0.3</td>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="JUMLAH"><?= $sumAtletik ?></td>
                                        <td class="text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" data-column="HASIL"><?= $totalNilaiAtletik ?></td>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- ========================LISTSCORE======================== -->
        <div class="container mt-4">
            <div class="row">
                <div class="col"></div>
                <div class="col-md-12">
                    <div class="">
                        <table class="table table-small table-bordered table-sm align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-dark" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" class="text-center">Peringkat</th>
                                    <th class="text-dark" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" class="text-center">Nama atlet</th>
                                    <th class="text-dark" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" class="text-center">Kontingen</th>
                                    <th class="text-dark" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" class="text-center">Atribut</th>
                                    <th class="text-dark" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;" class="text-center">Point</th>
                                </tr>
                            </thead>
                            <?php
                            //Ambil Data dari database klasemen dan tentukan peringkat
                            $sqlDataKlasemen = mysqli_query($conn, "SELECT grup from `papanskor`");
                            $row = mysqli_fetch_object($sqlDataKlasemen);
                            $grupKlasemen = $row->grup;
                            $queryKlas = "SELECT * FROM klasemen WHERE grup = '$grupKlasemen' ORDER BY `totalPoint` DESC LIMIT 4";
                            $cekDataKlasemen = mysqli_num_rows(mysqli_query($conn, $queryKlas));
                            if ($cekDataKlasemen > 0) {
                                $sqlKlasemen = "SELECT * FROM klasemen WHERE grup = '$grupKlasemen' ORDER BY `totalPoint` DESC LIMIT 4";
                                $dataKlasemen = mysqli_query($conn, $sqlKlasemen);
                                $no = 1;
                            ?>
                                <tbody>
                                    <?php
                                    while ($rowKlasemen = mysqli_fetch_array($dataKlasemen)) { ?>
                                        <tr>
                                            <td class="text-center text-white" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;"><?= $no; ?></td>
                                            <td class="text-center text-white text-capitalize" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;">
                                                <?= $rowKlasemen['namaAtlet'] ?>
                                            </td>
                                            <td class="text-center text-white text-capitalize" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;"><?= $rowKlasemen['kontingen'] ?></td>
                                            <td class="text-center text-white text-capitalize bg-<?php if ($rowKlasemen['atribut'] == 'Ao') {
                                                                                            echo 'primary';
                                                                                        } else {
                                                                                            echo 'danger';
                                                                                        } ?>" style="font-family: 'Arial', sans-serif;font-weight:bold;font-size:25px;"><?= $rowKlasemen['atribut'] ?></td>
                                            <td class="text-center <?php if ($no == 1) {
                                                                                echo 'blinking';
                                                                            } ?>" style="font-family: 'Arial', sans-serif; color:white; font-weight:bold;font-size:25px;"><?= number_format($rowKlasemen['totalPoint'], 2) ?></td>
                                        </tr>
                                    <?php
                                        $no += 1;
                                    }
                                    ?>
                                </tbody>
                            <?php
                            } else {
                                echo '<tbody>
                        <tr>
                            <td class="text-center py-5" colspan="5">
                                Data Belum Tersedia
                            </td>
                        </tr>
                    </tbody';
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    <?php } ?>
</body>

</html>