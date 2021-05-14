<?php

$c = mysqli_connect("localhost", "root", "", "pf");
if(!$c){
    echo "Koneksi gagal";
}