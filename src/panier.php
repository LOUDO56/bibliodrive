<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("utilitaires/import.html");?>
    <title>Bibliodrive - Panier</title>
</head>
<body>

    <?php

        session_start();
        require_once('utilitaires/connexion.php');

        require("utilitaires/entete.html");

        if(isset($_POST["emprunt_livre"])){
            if(isset($_SESSION["connected"]) && count($_SESSION["panier"]) != 0) {
                $date_emprunt = date("Y-m-d");
                $date_retour = date('Y-m-d', strtotime($date_emprunt. ' + 30 days'));
                $req = $connexion->prepare("INSERT INTO emprunter(mel,nolivre,dateemprunt,dateretour) 
                                            VALUES(:email, :nolivre, :dateemprunt, :dateretour);");
                $req->bindValue(":email", $_SESSION["email"]);
                $req->bindValue(":dateemprunt", $date_emprunt);
                $req->bindValue(":dateretour", $date_retour);

                foreach($_SESSION["panier"] as $livre){
                    $req->bindValue(":nolivre", $livre, PDO::PARAM_INT);
                    $req->execute();
                }

                $_SESSION["panier"] = array();

            }
        }

    ?>

    <?php require("utilitaires/authentification.php");?>

    <h1 class="big-title">Votre panier</h1>

    <div class="panier-container">
        <?php
            if(!isset($_SESSION["panier"])){
                echo "Vous n'êtes pas connecté. Connectez-vous pour ajouter des livres dans votre panier.";
            } else {
                if(count($_SESSION["panier"]) > 0){
                    foreach($_SESSION["panier"] as $livre){
                        $req = $connexion->prepare("
                            SELECT nolivre, nom, prenom, titre, anneeparution
                            FROM livre
                            JOIN auteur ON livre.noauteur = auteur.noauteur
                            WHERE nolivre = :nolivre;
                        ");
    
                        $req->bindValue(":nolivre", $livre, PDO::PARAM_INT);
    
                        $req->setFetchMode(PDO::FETCH_OBJ);
                        $req->execute();
                        while($panier_info = $req->fetch()){
                            echo '<div class="panier-info">';
                            echo "<p>".$panier_info->nom." ".$panier_info->prenom." - ".$panier_info->titre." (".$panier_info->anneeparution.")</p>";
                            echo '<a href="utilitaires/panier_manager.php?retirer=true&nolivre='.$panier_info->nolivre.'&redirect=panier.php" class="button-general">Annuler</a>';
                            echo '</div>';
                        }
    
                    }

                    echo '<form method="post">';
                    echo '<input type="hidden" name="emprunt_livre" value="true">';
                    echo '<input type="submit" value="Valider le panier" class="button-general validate-button">';
                    echo '</form>';


                } else {
                    echo "<p>Il n'y a rien... Il est temps de remplir ce panier !</p>";
                }
            

            }
        ?>
    
    </div>

    <div class="retour-accueil">
        <a href="accueil.php">← Retour à l'accueil</a>
    </div>
    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

    
</body>
</html>