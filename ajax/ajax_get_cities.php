<?php

include '../connection.php';

$stateId = $_GET['state_id'] ?? $_POST['state_id'] ?? false;
$defaultResponse = [
  'data' => [],
  'error' => false,
  'message' => ''
];

if (!(bool) $stateId) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = 'Invalid type of required data: State ID';

  exit(json_encode($response));
}

$sql = "SELECT id, name FROM cities WHERE state_id={$stateId}";
$cities = mysqli_query($c, $sql);

if ($cities === false) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = "Error while requesting data from the server!";

  exit(json_encode($response));
}

$response = $defaultResponse;
$response['message'] = "Cities with State ID: {$stateId} found!";

while ($city = mysqli_fetch_assoc($cities)) {
  $response['data'][] = [
    'id' => $city['id'],
    'name' => $city['name']
  ];
}

echo json_encode($response);
exit;
