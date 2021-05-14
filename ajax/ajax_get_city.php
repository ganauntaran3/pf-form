<?php

include '../connection.php';

$state = $_GET['state'] ?? '';

if ($state !== '') {
  $data = [];
  $query = mysqli_query($c, "SELECT * FROM cities WHERE state_id={$state}");

  while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
  }

  echo json_encode($data);
}