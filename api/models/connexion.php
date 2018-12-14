<?php

$json = file_get_contents('php://input');
$json = json_decode($json, true);

if (is_array($json))
{
	if (!empty($json["pseudo"]) && !empty($json["mdp"]))
	{

		if (!empty($resultat) && $resultat[0]['pseudo'] == $pseudo)
		{
			$password = $json["mdp"];
			$password_hash = $resultat[0]['password'];
			if (password_verify($password, $password_hash))
			{
				$_SESSION['pseudo'] = $pseudo;
				echo json_encode("connecter");
			}
			else
			{
				echo json_encode("mdp_pas_bon");
			}
		}
		else
		{
			echo json_encode("pseudo_pas_bon");
		}
	}
	else
	{
		echo json_encode(false);
	}
}
else
{
	echo json_encode(false);
}

