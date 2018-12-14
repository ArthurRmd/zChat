
<?php
    session_start();
    if(!isset($_SESSION['pseudo'])) {
        header('location: connexion.php');
        exit();
    }
    else {
        echo "bonjour ". $_SESSION['pseudo'];


    }
    
?>


