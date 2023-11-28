<?php
    
    session_start();

    if($_SESSION["connected"]){
        if(isset($_REQUEST["ajout"])){    
            if(!in_array($_REQUEST["nolivre"], $_SESSION["panier"])){          
                array_push($_SESSION["panier"], $_REQUEST["nolivre"]);                 
            }

        } elseif(isset($_REQUEST["retirer"])){         
            $id = array_search($_REQUEST["nolivre"],$_SESSION["panier"]);
            unset($_SESSION["panier"][$id]);
        }
        
        header("Location: ../detail.php?livre=".$_REQUEST["nolivre"]."");
    } else {
        header("Location: ../accueil.php");
    }



?>