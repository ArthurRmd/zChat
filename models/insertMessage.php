<?php

require 'Database.class.php';

$dbLink = new Database();

$query = 'INSERT INTO message (sender, receiver, content)
VALUES (:userId, :friendId, :content)';

$param = [
  'userId' => $userId,
  'friendId' => $friendId,
  'content' => $content
];

try {
  $res = $dbLink->execute($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
