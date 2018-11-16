<?php


    $serveur ="localhost";
    $login = "Arthur";
    $pass ='ChatArthur0';
    $name ="live_chat";

    $bdd = new PDO("mysql:host=$serveur;dbname=$name", $login, $pass);
	  $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $requete = $bdd->prepare("SELECT * FROM message ");
          $requete-> execute();
          $resultat = $requete-> fetchall(PDO::FETCH_ASSOC);


          echo  json_encode($resultat);

 
?>