<html>
<link rel="stylesheet" href="../../assets/css/style.css">
<?php include "../../config/templates/header.php"; ?>

<body style="position:fixed; width: 100%; height: 100%;background:url('../../assets/img/banner3.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <h1 class="text-center pt-3" style="font-family: 'Montserrat', sans-serif;text-transform: uppercase;color: #fff;">
                    <b>
                        Kadet Putra -
                        <i>Group A</i>
                    </b>
                    <hr class="bg-white" />
                </h1>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-12 col-lg-12 col-xl-12">

            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-danger" style="width: 100%;height: auto;">
                        <div class="card-body">
                            <h1 class="text-center blinking" *ngIf="finalScore && finalScore !== 1001 && finalScore !== 10000" style="font-size: 150px;color: white;">
                                <b>
                                    20.0
                                </b>

                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card">
                        <div class="container">
                            <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                Ade Adjie
                            </h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="container">

                            <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                Citra indah
                            </h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="container">

                            <h1 class="mb-0" style="font-family: 'Arial', sans-serif;font-size: 50px;text-transform: uppercase;">
                                UNSU
                            </h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================SCOREBOARD======================== -->
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">

                <div class="table-responsive">

                    <table class="table">
                        <thead class="bg-danger">

                            <tr class="text-center">
                                <th style="background-color: #fff !important;">
                                    <div class="text-center">
                                        <img src="../../assets/img/logo-2.jpeg" class="img-fluid" style="width: 80px;" alt="">
                                    </div>
                                </th>
                                <th>J-1 <span class="dot bg-success" style="position:absolute"></span></th>
                                <th>J-2 <span class="dot bg-success" style="position:absolute"></span></th>
                                <th>J-3 <span class="dot bg-success" style="position:absolute"></span></th>
                                <th>J-4 <span class="dot bg-success" style="position:absolute"></span></th>
                                <th>J-5 <span class="dot bg-success" style="position:absolute"></span></th>
                                <th>FAC</th>
                                <th>JUMLAH</th>
                                <th>HASIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th style="color: #fff;font-weight: 700;">TEKNIK</th>

                                <td data-column="J-1">0</td>
                                <td data-column="J-2">0</td>
                                <td data-column="J-3">0</td>
                                <td data-column="J-4">0</td>
                                <td data-column="J-5">0</td>
                                <td data-column="FAC">0.3</td>
                                <td data-column="JUMLAH">0</td>
                                <td data-column="HASIL">0</td>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <th style="color: #fff;font-weight: 700;">ATLETIK</th>

                                <td data-column="J-1">0</td>
                                <td data-column="J-2">0</td>
                                <td data-column="J-3">0</td>
                                <td data-column="J-4">0</td>
                                <td data-column="J-5">0</td>
                                <td data-column="FAC">0.3</td>
                                <td data-column="JUMLAH">0</td>
                                <td data-column="HASIL">0</td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->




    <!-- ========================LISTSCORE======================== -->
    <div class="container mt-4">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-12">
                <div class="">
                    <table class="table table-small table-bordered table-sm align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Peringkat</th>
                                <th class="text-center">Nama atlet</th>
                                <th class="text-center">Kontingen</th>
                                <th class="text-center">Atribut</th>
                                <th class="text-center">Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center text-capitalize">
                                    Ade Adjie
                                </td>
                                <td class="text-center text-capitalize">Citra Indah</td>
                                <td class="text-center bg-danger text-uppercase">
                                    AKA
                                </td>
                                <td class="text-center score blinking">20.0</td>
                            </tr>
                        </tbody>

                        <!-- ========================NOTHING ATLET======================== -->
                        <!-- <tbody>
                            <tr>
                                <td class="text-center py-5" colspan="5">
                                    Ranking atlet belum tersedia
                                </td>
                            </tr>
                        </tbody> -->
                    </table>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>

</html>