<?php
$json = file_get_contents('php://input');
$json = json_decode($json, true);

if (is_array($json) ) {
  if (!empty($json["pseudo"]) && !empty($json["message"])) {
    
    $dbLink = new Database();
    
    $req1 = $dbLink->execute("SELECT * FROM users");
    $req2 = $dbLink->execute("SELECT * FROM users WHERE username = :username", ["username" => "rigwild"]);
    
    $requete = $bdd->prepare("insert into message (pseudo, message) values( :pseudo , :message) ");
    // $requete->bindParam(':envoyeur', $envoyeur);
    // $envoyeur = 7;
    $res = $requete-> execute(Array(
      "pseudo" => htmlspecialchars($json["pseudo"], ENT_QUOTES, 'UTF-8'),
      "message" =>htmlspecialchars( $json["message"], ENT_QUOTES, 'UTF-8'),
    ));
    
    echo json_encode(!!$res);
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
