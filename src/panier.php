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
        // ini_set('session.cache_limiter','public');
        // session_cache_limiter(false); // Eviter un "Le document a expiré !" A cause du post quand on fait un retour en arrière.
        
        session_start();

        require("utilitaires/authentification.php");
        require("utilitaires/entete.html");

        if($_SESSION["connected"]){
            if(isset($_POST["ajout_panier"])){
                if(!in_array($_POST["nolivre"], $_SESSION["panier"])){
                    array_push($_SESSION["panier"], $_POST["nolivre"]);
                }
                header("Location: panier.php");
            }
        }

    ?>

    <h1 class="big-title">Votre panier</h1>

    <div class="resume-container">
        <?php

        
        
        ?>
        
    </div>

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

    
</body>
</html>