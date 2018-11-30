<?php

session_start();
$_SESSION['loggedIn'] = true;

?>

<a href="login.php">login.php</a><br>
<a href="show_session.php">show_session.php</a><br>
<a href="disconnect.php">disconnect.php</a><br>
