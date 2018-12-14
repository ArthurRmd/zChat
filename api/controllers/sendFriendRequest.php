<?php

require __DIR__.'/../lib/Util.class.php';

// We verify the user is logged in
Util::checkLoggedInAPI();

// Get the body from the request
$json = Util::getJSON();

// API endpoint request method
$requestType = 'POST';

// Check if HTTP method matches
if ($_SERVER['REQUEST_METHOD'] !== $requestType) {
  http_response_code(405);
  exit();
}

// Check if the body of the request contains the needed data
if (!$json || !empty($json['toFriendId'])) {
  http_response_code(400);
  exit();
}

$userId = $_SESSION['user']['id'];
$toFriendId = $json['toFriendId'];

require __DIR__.'/../models/insertFriendRequest.php';

// The database returned an error
if (isset($error))
  require __DIR__.'/error.php';

// Everything is fine, send the result
echo json_encode($res);

?>
