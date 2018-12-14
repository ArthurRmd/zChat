<?php

http_response_code($httpCode ?? 500);

echo json_encode(['error' => $error ?? 'Unknown error']);

exit();

?>