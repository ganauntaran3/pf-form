<?php

$config = require './config.php';
$c = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
) or echo 'Koneksi gagal';