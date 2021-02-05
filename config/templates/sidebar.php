<?php
$test = explode("/", $_SERVER['REQUEST_URI']);
$mod = $test[count($test) - 2];
$base_url = "http://$_SERVER[HTTP_HOST]/solidsport/modul";
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin keluar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="<?= $base_url ?>/logout/" type="button" class="btn btn-danger">Keluar</a>
      </div>
    </div>
  </div>
</div>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="../../assets/img/logo-2.jpeg" style="max-height: 5rem;" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner mt-5">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <br>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a <?php
                if ($mod == "atlet") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/atlet/">
              <i class="ni ni-circle-08 text-primary"></i>
              <span class="nav-link-text">Atlet</span>
            </a>
          </li>

          <li class="nav-item">
            <a <?php
                if ($mod == "grouping") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/grouping/">
              <i class="ni ni-bullet-list-67 text-primary"></i>
              <span class="nav-link-text">Grouping</span>
            </a>
          <li class="nav-item">
            <a <?php
                if ($mod == "final") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?>href="<?= $base_url ?>/final/">
              <i class="ni ni-paper-diploma text-primary"></i>
              <span class="nav-link-text">Final</span>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a <?php
                if ($mod == "scoreboard") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/scoreboard/">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Scoreboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a <?php
                if ($mod == "klasemen") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/klasemen/">
              <i class="ni ni-chart-bar-32 text-primary"></i>
              <span class="nav-link-text">Klasemen</span>
            </a>
          </li>
          <li class="nav-item">
            <a <?php
                if ($mod == "scoring") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/scoring/">
              <i class="ni ni-ruler-pencil text-primary"></i>
              <span class="nav-link-text">Scoring</span>
            </a>
          </li>

          <li class="nav-item">
            <a <?php
                if ($mod == "import") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/import/">
              <i class="ni ni-archive-2 text-primary"></i>
              <span class="nav-link-text">Import Data</span>
            </a>
          </li>
          <li class="nav-item">
            <a <?php
                if ($mod == "user") {
                  echo 'class="nav-link active"';
                } else {
                  echo 'class="nav-link"';
                } ?> href="<?= $base_url ?>/user/">
              <i class="ni ni-badge text-primary"></i>
              <span class="nav-link-text">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal">
              <i class="ni ni-button-power  text-danger"></i>
              <span class="nav-link-text">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>