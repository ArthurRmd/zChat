<?php

require __DIR__.'/../lib/Util.class.php';

Util::checkLoggedInAPI();

if (!empty($_GET['friendId'])) {
  $userId = $_SESSION['user']['id'];
  $friendId = $_GET['friendId'];

  require __DIR__.'/../models/getMessage.php';

  // The user does not exist
  if (isset($error)) {
    http_response_code(404);
    echo json_encode(['error' => $error]);
    exit();
  }
  
  echo json_encode($res);
  exit();
}
else // Incomplete request
  http_response_code(400);

?>
