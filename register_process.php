<?php

include "connection.php";

$docType = $_POST["doc_type"];
$docName = $_FILES["doc_name"]['name'];
$gender = $_POST["gender"];
$fullname = $_POST["fullname"];
$address = $_POST["address"];
$email = $_POST["email"];
$country = $_POST["country"];
$state = $_POST["state"];
$city = $_POST["city"];
$bsc = $_POST["bsc_address"];

    $allowedExt = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $docName); //memisahkan nama file dengan ekstensi yang diupload
    $ext = strtolower(end($x));
    $tmp_file = $_FILES['doc_name']['tmp_name'];   
    $randomN  = rand(1,999);
    $newFileName = $randomN.'-'.$docName; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ext, $allowedExt) === true)  {     
            move_uploaded_file($tmp_file, 'image/'.$newFileName); //memindah file gambar ke folder image

            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan
            $query = "INSERT INTO registration (doc_type, doc_name, gender, fullname, address, email, country, state, city, bsc_address) 
            VALUES ('$docType', '$newFileName', '$gender', '$fullname', '$address', '$email', '$country', '$state', '$city','$bsc')";
            $result = mysqli_query($c, $query);
            if(!$result){
                die ("Query gagal dijalankan: ".mysqli_errno($c)." - ".mysqli_error($c));
            } else {
                echo "<script>alert('Your data successfully registrated.');window.location='index.php';</script>";
            }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Just JPG and PNG extension allowed.');window.location='tambah_produk.php';</script>";
            }
