<?php

include "connection.php";
$country = $_GET["country"];

$state = $_GET["state"];

if($country!=""){
    
    $res = mysqli_query($c, "SELECT * FROM states WHERE country_id=$country");

    echo "<select class='form-control default-select' name='state' id='state_id' onChange='change_state()' >";
    
    while($row=mysqli_fetch_array($res)){
        echo "<option value='$row[id]'>"; echo $row['name']; echo "</option>";
    }
    
    echo "</select>";
    
}


$state = $_GET["state"];
if($state!=""){
    
    $res = mysqli_query($c, "SELECT * FROM cities WHERE state_id=$state");

    echo "<select name='city' id='city_id' class='form-control default-select'>";
    
    while($row=mysqli_fetch_array($res)){
        echo "<option>"; echo $row['name']; echo "</option>";
    }
    
    echo "</select>";
}



?>