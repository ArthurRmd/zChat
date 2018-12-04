<?php

require __DIR__.'/../lib/Util.class.php';

Util::checkLoggedInAPI();

$json = Util::getJSON();

if ($json && !empty($json['friendId']) && !empty($json['content'])) {
  $userId = $_SESSION['user']['id'];
  $friendId = $json['friendId'];
  $content = $json['content'];

  require __DIR__.'/../models/insertMessage.php';
  
  // Bad request
  if (isset($error)) {
    http_response_code(400);
    echo json_encode(['error' => $error]);
    exit();
  }

  echo json_encode($res);
}
else // Incomplete request
  http_response_code(400);

?>
