<?php
    $server = "meera.id.rapidplex.com";
    $username = "bisapast_solidsport";
    $password = "solidsport123";
    $dbName = "bisapast_solidsport";

    $conn = mysqli_connect($server, $username, $password, $dbName);
    if(mysqli_connect_errno()){ echo 'Failed to connect to Mysql : '.mysqli_connect_error();exit();}
