<?php

http_response_code($httpCode ?? 500);

header('Content-Type: application/json');
echo json_encode(['error' => $error ?? 'Unknown error']);

exit();

?>