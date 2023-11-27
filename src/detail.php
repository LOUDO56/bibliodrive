<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bibliodrive - Détail</title>
</head>
<body>

    <?php

        session_start();

        require_once('utilitaires/connexion.php');

        require("utilitaires/authentification.php");
        require("utilitaires/entete.html");

        if(!isset($_GET["livre"])) {
            echo '<h1 class="big-title">Aucun livre renseigné.</h1>.';
            exit;
        }
        else {
            $req = $connexion->prepare("
            SELECT nom,prenom,isbn13,resume,image FROM livre
            INNER JOIN auteur ON livre.noauteur = auteur.noauteur
            WHERE nolivre = :nolivre;
            ");

            $req->bindValue(":nolivre", $_GET["livre"], PDO::PARAM_INT);

            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->execute();
            $info_livre = $req->fetch();
        }
    ?>



    <div class="resume-container">
        <div>
            <p><b>Auteur:</b> <?php echo $info_livre->nom . " " . $info_livre->prenom ;?></p>
            <p><b>ISBN13:</b> <?php echo $info_livre->isbn13;?></p>
            <p class="titre-resume">Résumé du livre</p>
            <div class="bloc-resume">
                <?php echo $info_livre->resume;?>
            </div>
            <div class="info-commande">
                <?php
                    $req = $connexion->prepare("
                    SELECT nolivre FROM emprunter
                    WHERE nolivre = :nolivre;
                    ");
        
                    $req->bindValue(":nolivre", $_GET["livre"], PDO::PARAM_INT);
        
                    $req->setFetchMode(PDO::FETCH_OBJ);
                    $req->execute();
                    $emprute = $req->fetch();

                    if($emprute){
                        echo '<p class="order-unavailable">Indisponible</p>';
                    } else {
                        echo '<p class="order-available">Disponible</p>';
                    }
                
                
                ?>
                <form method="post">
                    <?php
                        if(!$emprute){
                            echo '<input type="submit" value="Ajouter au panier" class="button-general ajout-panier">';
                        }
                    ?>
                </form>
            </div>
        </div>
        <div>
            <?php
                if(file_exists("images/covers/".$info_livre->image)){
                    $cover = $info_livre->image;
                } else {
                    $cover = "book-cover-placeholder.png";
                }
            ?>
            <img src="images/covers/<?php echo $cover?>" alt="Book cover" class="book-cover-img">
        </div>
    </div>
 

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>
    
</body>
</html>

