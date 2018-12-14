<?php


    $serveur ="localhost";
    $login = "root";
    $pass ='';
    $name ="zchat";

    $bdd = new PDO("mysql:host=$serveur;dbname=$name", $login, $pass);
    $bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

