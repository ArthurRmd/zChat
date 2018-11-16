<?php
$json = file_get_contents('php://input');
$json = json_decode($json, true);

if (is_array($json) ) {
  if (!empty($json["pseudo"]) && !empty($json["message"])) {


    $serveur ="localhost";
    $login = "Arthur";
    $pass ='ChatArthur0';
    $name ="live_chat";

    $bdd = new PDO("mysql:host=$serveur;dbname=$name", $login, $pass);
	  $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $bdd->prepare("insert into message (pseudo, message) values( :pseudo , :message) ");
          //  $requete->bindParam(':envoyeur', $envoyeur);
            //$envoyeur = 7;
            $res = $requete-> execute(Array(
        
              "pseudo" => htmlspecialchars($json["pseudo"], ENT_QUOTES, 'UTF-8'),
              "message" =>htmlspecialchars( $json["message"], ENT_QUOTES, 'UTF-8'),
         
            ));
            if ($res)
              echo json_encode(true);
            else
              echo json_encode(false);

  }




}


      /*    $i = 2;

          if ($_POST['nb'] == 2){
          echo  json_encode($resultat);
        }
        else {
            echo  json_encode("test");
        }

        */

        ?>