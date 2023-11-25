<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bibliodrive - Accueil</title>
</head>
<body>
    <header>
        <?php
            session_start();
            require("utilitaires/authentification.php");
            if($_SESSION["adminUser"]) require("utilitaires/admin-header.html");
            else require("utilitaires/entete.html");

        ?>
    </header>
    <?php
        if($_SESSION["adminUser"])  
            echo '
            <h1 class="big-title">
                Admin panel.
            </h1>';
        else
            echo '
            <h1 class="big-title">
                Dernier emprunt
            </h1>';
    ?>

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

</body>
</html>