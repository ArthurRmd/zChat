<?php

require __DIR__.'/../lib/Util.class.php';

Util::checkLoggedInAPI();

$json = Util::getJSON();

if ($json && !empty($json['toFriendId'])) {
  $userId = $_SESSION['user']['id'];
  $toFriendId = $json['toFriendId'];

  require __DIR__.'/../models/insertFriendRequest.php';

  // The user does not exist or already friends
  if (isset($error)) {
    http_response_code(isset($httpCode) ? $httpCode : 500);
    echo json_encode(['error' => $error]);
    exit();
  }
  
  echo json_encode($res);
  exit();
}
else // Incomplete request
  http_response_code(400);

?>
