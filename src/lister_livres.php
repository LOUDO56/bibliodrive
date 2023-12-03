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

    <?php require("utilitaires/authentification.php");?>

    <div class="resultat-recherche">
        <?php
            $req = $connexion->prepare("
                SELECT nolivre,titre FROM livre
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
                    echo '<p><a href="detail.php?livre='.$livre->nolivre.'">'.$livre->titre.'</a><p>';
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