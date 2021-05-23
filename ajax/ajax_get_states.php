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

  exit(json_encode($response));
}

$sql = "SELECT id, name FROM states WHERE country_id={$countryId}";
$states = mysqli_query($c, $sql);

if ($states === false) {
  $response = $defaultResponse;
  $response['error'] = true;
  $response['message'] = "Error while requesting data from the server!";

  exit(json_encode($response));
}

$response = $defaultResponse;
$response['message'] = "States with Country ID: {$countryId} found!";

while ($state = mysqli_fetch_assoc($states)) {
  $response['data'][] = [
    'id' => $state['id'],
    'name' => $state['name'],
  ];
}

exit(json_encode($response));
