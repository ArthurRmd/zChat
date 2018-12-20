<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Check if friend tuple exist
  $query = 'SELECT
    COUNT(*) count,
    MAX(friend_accept) friend_accept
  FROM friend
  WHERE (user_asker = :userId AND user_asked = :toFriendId)
  OR (user_asker = :userId2 AND user_asked = :toFriendId2)';

  $param = [
    'userId' => $userId,
    'toFriendId' => $toFriendId,
    'userId2' => $userId,
    'toFriendId2' => $toFriendId
  ];

  $res = $dbLink->select($query, $param);

  if ($res[0]['count'] === 0) {
    // Error : There's no friend tuple
    $httpCode = 409;
    $error = 'No friend request was sent.';
    return;
  }
  elseif ($res[0]['friend_accept'] === 1) {
    // Error : They are already friend
    $httpCode = 409;
    $error = 'Already friends.';
    return;
  }


  $query = 'UPDATE friend SET friend_accept = 1
  WHERE (user_asker = :userId AND user_asked = :toFriendId)
  OR (user_asker = :userId2 AND user_asked = :toFriendId2)';

  $param = [
    'userId' => $userId,
    'toFriendId' => $toFriendId,
    'userId2' => $userId,
    'toFriendId2' => $toFriendId
  ];

  // Accept friend request
  $res = $dbLink->execute($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
