<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bibliodrive - Panier</title>
</head>
<body>

    <?php

        session_start();

        require("utilitaires/authentification.php");
        require("utilitaires/entete.html");

    ?>

    <h1 class="big-title">Votre panier</h1>

    <div class="panier-container">
        <?php

            if(count($_SESSION["panier"]) > 0){
                foreach($_SESSION["panier"] as $livre){
                    $req = $connexion->prepare("
                        SELECT nom, prenom, titre, anneeparution
                        FROM livre
                        JOIN auteur ON livre.noauteur = auteur.noauteur
                        WHERE nolivre = :nolivre;
                    ");

                    $req->bindValue(":nolivre", $livre, PDO::PARAM_INT);

                    $req->setFetchMode(PDO::FETCH_OBJ);
                    $req->execute();

                    while($panier_info = $req->fetch()){
                        echo "<p>".$panier_info->nom." ".$panier_info->prenom." - ".$panier_info->titre." (".$panier_info->anneeparution.")";
                    }

                }
            }
        
        ?>
        
    </div>

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

    
</body>
</html>