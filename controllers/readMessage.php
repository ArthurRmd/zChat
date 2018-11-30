<?php

require __DIR__.'/../Util.class.php';

Util::checkLoggedInAPI();

$json = Util::getJSON();

if ($json && !empty($json['receiver']) && !empty($json['sender'])) {
  $receiver = $json['receiver'];
  $sender = $json['sender'];

  require __DIR__.'/../models/getMessage.php';

  // The user does not exist
  if (isset($error)) {
    http_response_code(404);
    echo json_encode(['error' => $error]);
    exit();
  }
  
  echo json_encode($messages);
  exit();
}
else
  http_response_code(400);

?>
