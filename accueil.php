<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <?php
            require("utilitaires/authentification.php");
            
            if(isset($_SESSION["adminUser"])) require("utilitaires/admin-header.html");
            else require("utilitaires/entete.html");
        ?>
    </header>
    <h1 class="dernier-emprunt">
        Dernier emprunt
    </h1>
    <?php
        require("utilitaires/message_important.html");
    ?>

</body>
</html>