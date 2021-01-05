<?php
$test = explode("/", $_SERVER['REQUEST_URI']);
$mod = $test[count($test) - 2];
?>

<body>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <div class="header pb-6" style="background-image: url('../../assets/img/banner2.jpg');" class="header pb-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <p class="text-center text-light mt-3" style="margin:auto;font-size: 40px;text-transform:capitalize;">
              <?= $mod; ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">