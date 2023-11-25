<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bibliodrive - Ajouter un membre</title>
</head>
<body>
    <?php
        session_start();

        if(!$_SESSION["adminUser"]) {
            echo "Accès non autorisé."; // Ne rien afficher à un utilisateur curieux 
            exit;
        }

        require("utilitaires/authentification.php");
        require("utilitaires/admin-header.html");

        if(isset($_POST["email"])){

            $email = $_POST["email"];
            $mdp = $_POST["mdp"];
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $adresse = $_POST["adresse"];
            $ville = $_POST["ville"];
            $codepostal = $_POST["codePostal"];

           try {
                $req = $connexion->prepare("
                INSERT INTO 
                utilisateur(mel,motdepasse,nom,prenom,adresse,ville,codepostal,profil) 
                VALUES(:email, :mdp, :nom, :prenom, :adresse, :ville, :codepostal, 'client')
                ");

                $req->bindValue(":email", $email);
                $req->bindValue(":mdp", $mdp);
                $req->bindValue(":nom", $nom);
                $req->bindValue(":prenom", $prenom);
                $req->bindValue(":adresse", $adresse);
                $req->bindValue(":ville", $ville);
                $req->bindValue(":codepostal", $codepostal, PDO::PARAM_INT);

                $req->execute();
                $member_added = TRUE;

           } catch(Exception $e) {
                $erreur = $e;
                $member_added = FALSE;
           }
            
            
        }

    ?>

        <h1 class="dernier-emprunt">Ajouter un membre</h1>

        <form method="post" class="form-admin">

            <label for="email">Email : </label>
            <input type="email" name="email" id="email" autocomplete="off" required>
            
            <label for="mdp">Mot de passe : </label>
            <input type="password" name="mdp" id="mdp" autocomplete="off" required>
            
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" autocomplete="off" required>
            
            <label for="prenom">Prenom : </label>
            <input type="text" name="prenom" id="prenom" autocomplete="off" required>

            <label for="adresse">Adresse : </label>
            <input type="text" name="adresse" id="adresse" autocomplete="off" required>

            <label for="ville">Ville : </label>
            <input type="text" name="ville" id="ville" autocomplete="off" required>

            <label for="codePostal">Code Postal : </label>
            <input type="number" name="codePostal" id="codePostal" min="1" max="100000" autocomplete="off" required>



            <input type="submit" value="Créer un membre" class="button-general" required>

            <?php 
            
                if(isset($member_added)) {
                    if ($member_added == TRUE) 
                        echo '<p class="member_added">Membre ajouté avec succès !</p>';
                    else
                        echo '<p class="member_error">Une erreur est survenue l\'or de l\'ajout du membre : '. $erreur . '</p>';
                }
            ?>

        </form>

</body>
</html>