<?php

require 'Database.class.php';

$dbLink = new Database();

$query = 'SELECT * FROM message WHERE
sender = (SELECT id FROM user WHERE pseudo = :sender) AND
receiver = (SELECT id FROM user WHERE pseudo = :receiver)
LIMIT 50';

$param = [
  'sender' => $sender,
  'receiver' => $receiver
];


try {
  $messages = $dbLink->select($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
