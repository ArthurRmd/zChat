<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Check if friend tuple exist
  $query = 'SELECT
    COUNT(*) count,
    MAX(friend_accept) friend_accept
  FROM friend
  WHERE (user_asker = :userId AND user_asked = :otherUserId)
  OR (user_asked = :userId2 AND user_asker = :otherUserId2)';

  $param = [
    'userId' => $userId,
    'otherUserId' => $otherUserId,
    'userId2' => $userId,
    'otherUserId2' => $otherUserId
  ];

  $res = $dbLink->select($query, $param);

  if ($res[0]['count'] === 0) {
    // Error : There's no friend tuple
    $httpCode = 409;
    $error = 'No friend request from this user.';
    return;
  }
  elseif ($res[0]['friend_accept'] === 1) {
    // Error : They are already friend
    $httpCode = 409;
    $error = 'Already friends.';
    return;
  }


  $query = 'DELETE FROM friend
  WHERE (user_asker = :userId AND user_asked = :otherUserId)
  OR (user_asked = :userId2 AND user_asker = :otherUserId2)';

  $param = [
    'userId' => $userId,
    'otherUserId' => $otherUserId,
    'userId2' => $userId,
    'otherUserId2' => $otherUserId
  ];

  // Accept friend request
  $res = $dbLink->execute($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
