<?php

require __DIR__.'/../Util.class.php';

Util::checkLoggedInAPI();

$json = Util::getJSON();

if ($json && !empty($json['sender']) && !empty($json['receiver']) && !empty($json['content'])) {
  $sender = $json['sender'];
  $receiver = $json['receiver'];
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
else
  http_response_code(400);

?>
