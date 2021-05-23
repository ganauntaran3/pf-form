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
    $addedBsc = "SELECT * FROM registration where bsc_address='$bsc'";
    $qbsc = mysqli_query($c, $addedBsc);
        if(mysqli_num_rows($qbsc) > 0){
            echo "<script>alert('BSC Address is already exist!');window.location.href='index.php';</script>";
        }else{
            move_uploaded_file($tmp_file, 'image/'.$newFileName); //memindah file gambar ke folder image
            $query = "INSERT INTO registration (doc_type, doc_name, gender, fullname, address, email, country, state, city, bsc_address) 
            VALUES ('$docType', '$newFileName', '$gender', '$fullname', '$address', '$email', '$country', '$state', '$city','$bsc')";
            $result = mysqli_query($c, $query);
            if(!$result){
                die ("Failed to added new data!".mysqli_errno($c)." - ".mysqli_error($c));
            } else {
                echo "<script>alert('Your data successfully registrated.');</script>";
            }
        }
