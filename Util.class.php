<?php

class Util {
  // Check if the user is logged in
  public static function checkLoggedInAPI()
  {
    if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])) {
      http_response_code(403);
      exit();
    }
  }

  // Escape bad HTML chars
  public static function escapeHTML($content = "")
  {
    return htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
  }

  // Get JSON sent to the server
  public static function getJSON()
  {
    $json = file_get_contents('php://input');
    $json = json_decode($json, true);
    return json_last_error() === JSON_ERROR_NONE ? $json : null;
  }
}

?>
