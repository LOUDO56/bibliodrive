<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            $req = $connexion->prepare("
                SELECT nolivre,titre FROM livre
                INNER JOIN auteur ON livre.noauteur = livre.noauteur
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

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

</body>
</html>