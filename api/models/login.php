<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  $res = $dbLink->select(
    'SELECT * FROM user WHERE pseudo = :pseudo',
    ['pseudo' => $pseudo]
  );

  if (count($res) === 0) {
    // Error : User not found
    $error = "Invalid username or password";
    $httpCode = 409;
    return;
  }

  $res = $res[0];

  if ($res['is_banned']) {
    // Error : User is banned
    $error = "You are banned from the website.";
    $httpCode = 403;
    return;
  }
  
  if (!password_verify($password, $res['password'])) {
    // Error : Bad password
    $error = "Invalid username or password";
    $httpCode = 409;
    return;
  }

  // We remove useless infos for $_SESSION
  $res = [
    'id' => $res['id'],
    'pseudo' => $res['pseudo']
  ];
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
