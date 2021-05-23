<?php

include '../connection.php';

$defaultResponse = [
  'data' => [],
  'error' => false,
  'message' => ''
];

$sql = "SELECT id, name FROM countries";
$countries = mysqli_query($c, $sql);

if ($countries === false) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = "Error while requesting data from the server!";

  exit(json_encode($response));
}

$response = $defaultResponse;
$response['message'] = "Countries fetched!";

while ($country = mysqli_fetch_assoc($countries)) {
  $response['data'][] = [
    'id' => $country['id'],
    'name' => $country['name']
  ];
}

exit(json_encode($response));
