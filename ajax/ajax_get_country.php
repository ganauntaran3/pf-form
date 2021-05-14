<?php

include '../connection.php';

$country = $_GET['country'] ?? '';

if ($country !== '') {
  $data = [];
  $query = mysqli_query($c, "SELECT * FROM states WHERE country_id={$country}");

  while($row = mysqli_fetch_assoc($query)){
    $data[] = $row
  }

  echo json_encode($data);
}