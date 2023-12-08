<?php
    
    session_start();

    require_once('connexion.php');

    if($_SESSION["connected"]){
        if(isset($_REQUEST["ajout"])){    
            if(!in_array($_REQUEST["nolivre"], $_SESSION["panier"])){
                // Vérifier si l'utilisateur n'a pas déjà le livre emprunté (si utilisation via requete)
                $req = $connexion->prepare("SELECT mel FROM emprunter WHERE mel = :email");
                $req->bindValue(":email", $_SESSION["email"]);
                $req->setFetchMode(PDO::FETCH_OBJ);
                $req->execute();
    
                if((count($_SESSION["panier"]) + $req->rowCount()) < 5){ // Vérifier si la personne n'a pas plus de 5 emprunts
                    $req = $connexion->prepare("SELECT mel FROM emprunter WHERE nolivre = :nolivre");
                    $req->bindValue(":nolivre", $_REQUEST["nolivre"], PDO::PARAM_INT);
                    $req->execute();
                    $user_mel = $req->fetch();
                    if(!isset($user_mel->mel) || $user_mel->mel != $_SESSION["email"]) {
                        array_push($_SESSION["panier"], $_REQUEST["nolivre"]);                 
                    }
                }
            }

        } elseif(isset($_REQUEST["retirer"])){         
            $id = array_search($_REQUEST["nolivre"],$_SESSION["panier"]);
            unset($_SESSION["panier"][$id]);
        }
        header("Location: ../".$_REQUEST["redirect"]);

    } else {
        header("Location: ../accueil");
    }



?>