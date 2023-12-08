<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require("utilitaires/import.html");?>
    <title>Bibliodrive - Recherche</title>
</head>
<body>
    <header>
        <?php
            session_start();

            require("utilitaires/authentification.php");

            require("utilitaires/entete.html");

        ?>
    </header>

    <h1 class="big-title">
        <?php

            if(isset($_GET["auteur"])) {
                $auteur = $_GET["auteur"];
                echo "Recherche pour " . $auteur;
            } else {
                echo "Aucun auteur renseigné.";
            } 

        ?>
    </h1>

    <div class="resultat-recherche">

    <?php
            if(isset($auteur)){
                
                $req = $connexion->prepare("
                    SELECT nolivre,image,anneeparution,resume,titre FROM livre
                    INNER JOIN auteur ON livre.noauteur = auteur.noauteur
                    WHERE nom = :auteur;
                ");
    
                $req->bindValue(":auteur", $auteur);
    
                $req->setFetchMode(PDO::FETCH_OBJ);
                $req->execute();
    
                if($req->rowCount() == 0) {
                    echo "<p>Aucun Résultat.</p>";
    
                } else {
    
                    while($livre = $req->fetch()) {
                        if(file_exists("images/covers/".$livre->image   )){
                            $cover = $livre->image;
                        } else {
                            $cover = "book-cover-placeholder.png";
                        }
                        echo '
                            <div class="resultat-container" id="livre_'.$livre->nolivre.'">
                                <div class="resultat-cover">
                                    <img src="images/covers/'.$cover.'" alt="placeholder">
                                </div>
                                <div class="resultat-info">
                                    <p class="resultat-title">'.$livre->titre.'</p>
                                    <p class="resultat-parution">Année parution: <b>'.$livre->anneeparution.'</b></p>
                                    <p class="resultat-resume-title">Résumé</p>
                                    <p class="resultat-resume">
                                        '.$livre->resume.'
                                    </p>
                                    <a href="detail?livre='.$livre->nolivre.'" class="resultat-more-button button-general">Voir plus</a>
                                </div>
                            </div>
                        
                        ';
                    }
                }
            }
        ?>

    </div>

    <div class="retour-accueil">
        <a href="accueil">← Retour à l'accueil</a>
    </div>

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

</body>
</html>