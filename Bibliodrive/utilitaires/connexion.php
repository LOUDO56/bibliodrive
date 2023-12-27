<?php

try {
    $dns = 'mysql:host=db;dbname=bibliodrive'; // dbname : nom de la base
    $utilisateur = 'admin'; // root sur vos postes
    $motDePasse = 'pass'; // pas de mot de passe sur vos postes
    $connexion = new PDO($dns, $utilisateur, $motDePasse);
} catch (Exception $e) {
    echo "Connexion à la base de donnée bibliodrive impossible : ", $e->getMessage();
    die();
}

?>