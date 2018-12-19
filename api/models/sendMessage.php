<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  $res = $dbLink->select('SELECT COUNT(*) FROM user WHERE id = :id', ['id' => $friendId]);
  if ($res[0]['COUNT(*)'] === 0) {
    // Error : User to send the message to does not exist
    $httpCode = 404;
    $error = 'The user does not exist.';
    return;
  }

  $query = 'INSERT INTO message (sender, receiver, content)
  VALUES (:userId, :friendId, :content)';

  $param = [
    'userId' => $userId,
    'friendId' => $friendId,
    'content' => $content
  ];

  $res = $dbLink->execute($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
