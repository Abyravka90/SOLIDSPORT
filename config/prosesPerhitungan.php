<?php 
    include 'database/koneksi.php';
    $queryTeknik = mysqli_query($conn, "SELECT `nilaiTeknik` from `point`");
    while($rowTeknik = mysqli_fetch_array($queryTeknik)){
        $nilaiTeknik[] = $rowTeknik['nilaiTeknik'];
    }
    $queryAtletik = mysqli_query($conn, "SELECT `nilaiAtletik` from `point`");
    while($rowAtletik = mysqli_fetch_array($queryAtletik)){
        $nilaiAtletik[] = $rowAtletik['nilaiAtletik'];
    }
    //proses sorting
    sort($nilaiTeknik);
    sort($nilaiAtletik);
    //proses slicing nilai teknik
    $deretTeknik = array_slice($nilaiTeknik, 1, 3);
    //proses filter sisa nilai teknik
    $deretSisaTeknik1 = $nilaiTeknik[0];
    $deretSisaTeknik2 = $nilaiTeknik[4];
    //proses slicing nilai atletik
    $deretAtletik = array_slice($nilaiAtletik, 1, 3);
    //proses filter nilai atletik
    $deretSisaAtletik1 = $nilaiAtletik[0];
    $deretSisaAtletik2 = $nilaiAtletik[4];
    //nilai di sum
    $sumTeknik = array_sum($deretTeknik);
    $sumAtletik = array_sum($deretAtletik);
    //perhitungan nilai teknik
    $totalNilaiTeknik = 0.7 * $sumTeknik;
    //perhitungan nilai atletik
    $totalNilaiAtletik = 0.3 * $sumAtletik;
    $totalNilai = $totalNilaiTeknik + $totalNilaiAtletik;
    /* check array
    print_r ($nilaiTeknik);echo '<- nilai teknik <br/>';
    print_r ($deretTeknik);echo '<- nilai teknik slice<br/>';
    print_r ($deretSisaTeknik);echo '<- nilai teknik sisa<br/>';
    print_r ($nilaiAtletik);echo '<- nilai Atletik <br/>';
    print_r ($deretAtletik);echo '<- nilai Atletik deret<br/>';
    print_r ($deretSisaAtletik);echo '<- nilai Atletik sisa<br/>'
    */

?>