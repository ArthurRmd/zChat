
<?php

$json = file_get_contents('php://input');
$json = json_decode($json, true);
$date = date('Y/d/m H:i:s');

if (is_array($json))
{
	if (!empty($json["pseudo"]) && !empty($json["mdp"]))
	{
		$requete = $bdd->prepare("select * from user where pseudo= :pseudo  ");
		$requete->bindParam(':pseudo', $pseudo);
		$pseudo = $json["pseudo"];
		$requete->execute();
		$resultat = $requete->fetchall();
		if (count($resultat) < 1)
		{
			$mdp = password_hash($json["mdp"], PASSWORD_DEFAULT);
			$requete = $bdd->prepare("insert into user(pseudo, password) values(:pseudo, :password) ");
			$res = $requete->execute(Array(
				"password" => $mdp,
				"pseudo" => htmlspecialchars($json["pseudo"], ENT_QUOTES, 'UTF-8') ,
			));
			if ($res)
			{
				$_SESSION['pseudo'] = $json["pseudo"];
				echo json_encode(true);
			}
			else
			{
				echo json_encode(false);
			}
		}
		else
		{
			echo json_encode("pseudo_deja_enregistre");
		}
	}
	else
	{
		echo json_encode(false);
	}
}

