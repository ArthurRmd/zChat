<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Check user exist
  $res = $dbLink->select('SELECT COUNT(*) FROM user WHERE id = :id', ['id' => $friendId]);
  if ($res[0]['COUNT(*)'] === 0) {
    // Error : User to send the message to does not exist
    $httpCode = 404;
    $error = 'The user does not exist.';
    return;
  }

  // Check users are friends
  $query = 'SELECT friend_accept FROM friend
  WHERE (user_asker = :userId AND user_asked = :friendId)
  OR (user_asker = :userId2 AND user_asked = :friendId2)';

  $param = [
    'userId' => $userId,
    'friendId' => $friendId,
    'userId2' => $userId,
    'friendId2' => $friendId
  ];
  $res = $dbLink->select($query, $param);

  if (count($res) === 0 || $res[0]['friend_accept']) {
    // Error : Users are not friends
    $httpCode = 403;
    $error = 'You are not friend with this user.';
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
