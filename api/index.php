<?php

session_start();

function routerReq($page = "erreur")
{
  if (!empty($_GET['page']) && is_file('controllers/'.$_GET['page'].'.php'))
    require('controllers/'.$_GET['page'].'.php');
  else {
    $page = "controllers/". $page .".php";
    if (file_exists($page))
      require $page;
    else 
      echo "Le fichier $page n'existe pas.";
  }
}

routerReq("accueil");

?>
