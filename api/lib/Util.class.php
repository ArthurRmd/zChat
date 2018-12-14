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

  // Convert :emojis: to unicode emojis
  public static function convertEmoji($str = "")
  {
    // Get emojis
    $emojis = file_get_contents(__DIR__.'/discord_emojis.min.json');
    $emojis = json_decode($emojis, true);

    // Match possible emojis in string
    $matched = [];
    preg_match_all('/\:\w+\:/', $str, $matched);
    $matched = $matched[0];

    // Get the emojis for the matches
    $matchedEmojis = [];
    foreach ($matched as $key => $value) {
      $search = array_key_exists($value, $emojis);
      if ($search) $matchedEmojis[$value] = $emojis[$value];
    }

    // Replace emojis in the string
    foreach ($matchedEmojis as $key => $value)
      $str = str_replace($key, $value, $str);

    return $str;
  }
}

?>
