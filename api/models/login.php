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
  if (!password_verify($password, $res['password'])) {
    // Error : Bad password
    $error = "Invalid username or password";
    $httpCode = 409;
    return;
  }
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
