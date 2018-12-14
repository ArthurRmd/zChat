<?php

session_start();
$_SESSION['loggedIn'] = true;
$_SESSION['user'] = [];
$_SESSION['user']['id'] = 1;
$_SESSION['user']['pseudo'] = 'rigwild';

?>

<h1>Vous avez été connecté.</h1>
<h2>Contenu de la session :</h2>

<?=var_dump($_SESSION)?>

<a href="login.php">login.php</a><br>
<a href="show_session.php">show_session.php</a><br>
<a href="show_all.php">show_all.php</a><br>
<a href="disconnect.php">disconnect.php</a><br>
