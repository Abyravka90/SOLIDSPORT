<?php
$test = explode("/", $_SERVER['REQUEST_URI']);
$mod = $test[count($test) - 2];
?>

<body>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-dark border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
                <i class="fas fa-bars text-white"></i>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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