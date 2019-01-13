<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  // Get the friends
  $query = 'SELECT
    U1.id user1_id, U1.pseudo user1_pseudo, U1.is_banned user1_is_banned,
    U2.id user2_id, U2.pseudo user2_pseudo, U2.is_banned user2_is_banned,
    timestamp_friend_ok
  FROM friend F
  INNER JOIN user U1 ON U1.id = F.user_asker
  INNER JOIN user U2 ON U2.id = F.user_asked
  WHERE friend_accept = 1 AND (U1.id = :userId OR U2.id = :userIdBis)';

  $param = [
    'userId' => $userId,
    'userIdBis' => $userId,
  ];

  $friends = $dbLink->select($query, $param);

  // Filter the array with only the needed data
  $res = [];
  foreach($friends as $key => $value) {
    if ($value['user1_id'] === $userId && $value['user2_id'] !== $userId) {
      array_push($res, [
        'id' => $value['user2_id'],
        'pseudo' => $value['user2_pseudo'],
        'is_banned' => $value['user2_is_banned'],
        'timestampFriends' => $value['timestamp_friend_ok']
      ]);
    }
    elseif ($value['user1_id'] !== $userId && $value['user2_id'] === $userId) {
      array_push($res, [
        'id' => $value['user1_id'],
        'pseudo' => $value['user1_pseudo'],
        'is_banned' => $value['user1_is_banned'],
        'timestampFriends' => $value['timestamp_friend_ok']
      ]);
    }
  }
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
