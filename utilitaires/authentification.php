
<?php require_once('connexion.php')?>
<div class="container-pos">
    <div class="authen-container">
        <?php
            // Vérifier si utilisateur authentifié.
            if(isset($_POST["email"])) {
                $requete = $connexion->prepare("SELECT profil FROM utilisateur WHERE mel = :email AND motdepasse = :mdp");
                $requete->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $requete->bindValue(":mdp", $_POST["mdp"], PDO::PARAM_STR);
                $requete->execute();
                $requete->setFetchMode(PDO::FETCH_OBJ);  
                
                $utilisateur = $requete->fetch();

                if($utilisateur) {
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["connected"] = TRUE;
                }
                else{
                    $erreur_connexion = TRUE;
                    $email_renseigne = $_POST["email"];
                }

            }


            if(isset($_SESSION["connected"])){
                if(isset($_POST["logoff"])) unset($_SESSION["connected"]); // Déconnecter l'utilisateur
                else
                $requete = $connexion->prepare("SELECT mel,nom,prenom,adresse,profil FROM utilisateur WHERE mel = :email");
                $requete->bindValue(":email", $_SESSION["email"], PDO::PARAM_STR);
                $requete->execute();
                $requete->setFetchMode(PDO::FETCH_OBJ);
                $utilisateur = $requete->fetch();
                echo '<p class="titre-form"> Bonjour '.$utilisateur->nom.' '.$utilisateur->prenom.'</p>';
                echo '<p class="email-set">'.$utilisateur->mel.'</p>';
                if($utilisateur->profil == "client"){
                    echo '<p class="adresse-set">'.$utilisateur->adresse.'</p>';
                } else {
                    echo '<p class="admin-account">Vous êtes Administrateur</p>';

                }
                echo '
                    <form method="post" class="form-login">
                        <input type="hidden" name = "logoff" value = "true">
                        <input class="submit-login" type="submit" value="Se déconnecter">
                    </form>
                
                ';
            } else {
                echo '
                
                <p class="titre-form">Connexion</p>
                
                <form method="post" class="form-login">';
                    if(isset($email_renseigne)) // Pour éviter que l'utilisateur retape sans cesse son email en cas d'echec
                        echo '<input class="input-login" type="email" name="email" id="email" placeholder="Email" autocomplete="off" value="'.$email_renseigne.'"required>';
                    else 
                        echo '<input class="input-login" type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>';
                    
                echo '
                    <input class="input-login" type="password" name="mdp" id="mdp" placeholder="Mot de passe" autocomplete="off" required>';
                    if(isset($erreur_connexion)) echo '<p class="erreur-connexion">Votre email ou de passe est incorrect.</p>';
                echo '
                <input class="submit-login" type="submit" value="Se connecter">
                </form>';    
            }
        ?>
    </div>    
</div>