<?php

require __DIR__.'/../lib/Database.class.php';

$dbLink = new Database();

try {
  $res = $dbLink->select(
    'SELECT * FROM user WHERE pseudo = :pseudo',
    ['pseudo' => $pseudo]
  );

  if (count($res) > 0) {
    // Error : Pseudo not available
    $error = "Pseudo is already taken.";
    $httpCode = 409;
    return;
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);
  $res = $dbLink->execute(
    'INSERT INTO user (pseudo, password) VALUES (:pseudo, :password)',
    [
      'pseudo' => $pseudo,
      'password' => $hash
    ]
  );
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>
