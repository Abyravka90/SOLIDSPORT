<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbName = "solidsport2";

    $conn = mysqli_connect($server, $username, $password, $dbName);
    if(mysqli_connect_errno()){ echo 'Failed to connect to Mysql : '.mysqli_connect_error();exit();}
