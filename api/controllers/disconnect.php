<?php

// We verify the user is logged in
Util::checkLoggedInAPI();

session_destroy();

// Everything is fine, send the result
echo json_encode(true);
?>
