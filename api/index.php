<?php

session_start();

header('Content-Type: application/json');

$controller = $_GET['controller'] ?? null;

// Load the right controller
if (!empty($controller)) {
  if (is_file('controllers/'.$controller.'.php'))
    require __DIR__.'/controllers/'.$controller.'.php';
  else {
    $error = 'Unknown controller.';
    $httpCode = 404;
    require __DIR__.'/controllers/error.php';
  }
}
else {
  $error = 'You must specify a controller by using `?controller=requestedController`.';
  $httpCode = 409;
  require __DIR__.'/controllers/error.php';
}

?>