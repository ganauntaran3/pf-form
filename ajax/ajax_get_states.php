<?php

include '../connection.php';

$countryId = $_GET['country_id'] ?? $_POST['country_id'] ?? false;
$defaultResponse = [
  'data' => [],
  'error' => false,
  'message' => '',
];

if (!(bool) $countryId) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = 'Invalid type of required data: Country ID';

  echo json_encode($response);
  exit;
}

$sql = "SELECT id, name FROM states WHERE country_id={$countryId}";
$states = mysqli_query($c, $sql);

if ($states === false) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = "Error while requesting data from the server!";

  echo json_encode($response);
  exit;
}

$response = $defaultResponse;
$response['message'] = "States with Country ID: {$countryId} found!";

while ($state = mysqli_fetch_assoc($states)) {
  $response['data'][] = [
    'id' => $state['id'],
    'name' => $state['name'],
  ];
}

echo json_encode($response);
exit;
