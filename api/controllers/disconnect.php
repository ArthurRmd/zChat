<?php

require __DIR__.'/../lib/Util.class.php';
// We verify the user is logged in
Util::checkLoggedInAPI();

// Everything is fine, send the result
echo json_encode(session_destroy());
exit();

?>
