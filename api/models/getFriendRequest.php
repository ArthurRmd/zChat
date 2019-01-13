<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Check if friend tuple exist
  $query = 'SELECT
    id,
    pseudo, 
    timestamp_friend_request
  FROM friend
  INNER JOIN user ON user.id = friend.user_asker
  WHERE user_asked = :userId AND friend_accept = 0';

  $param = [
    'userId' => $userId
  ];

  $res = $dbLink->select($query, $param);

  if (isset($res[0]) && count($res[0]) === 0) {
    // Error : There's no friend tuple
    $httpCode = 200;
    $error = 'You do not have any friend requests.';
    return;
  }
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
