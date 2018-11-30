<?php

require 'Database.class.php';

$dbLink = new Database();

$query = 'INSERT INTO message (sender, receiver, content)
VALUES (
  (SELECT id FROM user WHERE pseudo = :sender),
  (SELECT id FROM user WHERE pseudo = :receiver),
  :content
)';

$param = [
  'sender' => $sender,
  'receiver' => $receiver,
  'content' => $content
];

try {
  $res = $dbLink->execute($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
