<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Check if user to send friend request to exists
  $res = $dbLink->select(
    'SELECT COUNT(*) count FROM user WHERE id = :toFriendId',
    ['toFriendId' => $toFriendId]
  );

  if ($res[0]['count'] === 0) {
    // Error : User to send the friend request to does not exist
    $httpCode = 404;
    $error = 'The user does not exist.';
    return;
  }


  // Check if friend tuple already exist
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

  if ($res[0]['count'] > 0) {
    // Error : There's already a friend tuple
    $httpCode = 409;
    $error = 'Friend request already present.';
    return;
  }
  elseif ($res[0]['friend_accept'] === 1) {
    // Error : They are already friend
    $httpCode = 409;
    $error = 'Already friends.';
    return;
  }


  // Adding friend request to db
  $res = $dbLink->execute(
    'INSERT INTO friend (user_asker, user_asked) VALUES (:userId, :toFriendId)',
    ['userId' => $userId, 'toFriendId' => $toFriendId]
  );
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
