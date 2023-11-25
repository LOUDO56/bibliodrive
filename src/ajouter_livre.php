<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bibliodrive - Ajouter un livre</title>
</head>
<body>
    <?php
        // Ne rien afficher à un utilisateur curieux 

        session_start();

        if(!$_SESSION["adminUser"]) {
            echo "Accès non autorisé.";
            exit;
        }

        require("utilitaires/authentification.php");
        require("utilitaires/admin-header.html");

    ?>

        <h1 class="dernier-emprunt">Ajouter un livre</h1>

        <form method="post" class="form-admin">
            <label for="auteur">Auteur : </label>
            <?php
                    echo "<select name=\"auteur\" id=\"auteur\" required>";
                    echo "<option value=\"\" disabled selected>---- Sélectionner ----</option>";
                    $req = $connexion->query("SELECT nom FROM auteur");
                    $req->setFetchMode(PDO::FETCH_OBJ);

                    while($auteur = $req->fetch()){
                        echo "<option value=\"{$auteur->nom}\">{$auteur->nom}</option>";
                    }

                    echo "</select>";
                
            ?>

            <label for="titre">Titre : </label>
            <input type="text" name="titre" id="titre" autocomplete="off" required>
            
            <label for="ISBN13">ISBN13 :</label>
            <input type="text" name="ISBN13" id="ISBN13" autocomplete="off" required>
            
            <label for="annee_parution">Année de parution : </label>
            <input type="text" name="annee_parution" id="annee_parution" autocomplete="off" required>
            
            <label for="resume">Résumé : </label>
            <textarea name="resume" id="resume" autocomplete="off" rows="7" required></textarea>     

            <label for="cover">Image : </label>
            <input type="file" id="cover" name="cover" accept="image/png, image/jpeg" autocomplete="off" required/>

            <input type="submit" value="Ajouter le livre" class="button-general" required>

</body>
</html>