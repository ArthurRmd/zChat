<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

// Check if user to get the messages from exists
$res = $dbLink->select(
  'SELECT COUNT(*) count FROM user WHERE id = :friendId',
  ['friendId' => $friendId]
);

if ($res[0]['count'] === 0) {
  // Error : User to get the messages from does not exist
  $httpCode = 404;
  $error = 'The user does not exist.';
  return;
}


// Get the messages
$query = 'SELECT * FROM message WHERE
(sender = :userId AND receiver = :friendId)
OR
(sender = :friendId2 AND receiver = :userId2)
ORDER BY timestamp ASC
LIMIT 50';

$param = [
  'userId' => $userId,
  'friendId' => $friendId,
  'userId2' => $userId,
  'friendId2' => $friendId
];


try {
  $res = $dbLink->select($query, $param);
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
