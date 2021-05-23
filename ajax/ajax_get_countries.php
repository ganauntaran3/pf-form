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

  echo json_encode($response);
  exit;
}

$response = $defaultResponse;
$response['message'] = "Countries fetched!";

while ($country = mysqli_fetch_assoc($countries)) {
  $response['data'][] = [
    'id' => $country['id'],
    'name' => $country['name']
  ];
}

echo json_encode($response);
exit;
