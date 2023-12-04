<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require("utilitaires/import.html");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Bibliodrive - Accueil</title>
</head>
<body>

    <header>
        <?php
            session_start();

            require("utilitaires/authentification.php");

            if($_SESSION["adminUser"]) require("utilitaires/admin-header.html");
            else require("utilitaires/entete.html");
            
            require_once('utilitaires/connexion.php');
            
            ?>
    </header>
    
    <?php
        if($_SESSION["adminUser"]){
            
            echo '
            <h1 class="big-title">
            Admin panel.
            </h1>';
            exit;
        } else {
            
            echo '
            <h1 class="big-title">
            Dernières acquisitions
            </h1>';
        }
        
        
        
        $req = $connexion->prepare("SELECT image FROM livre ORDER BY nolivre DESC LIMIT 2;");
        $req->setFetchMode(PDO::FETCH_OBJ).
        $req->execute();
        
        ?>


    <div class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
                $active = TRUE;
                if($req->rowCount() != 0){
                    while($dernier_acqui = $req->fetch()){
                        if($active){
                            echo '<div class="carousel-item active" data-bs-interval="5000">';
                            $active = FALSE;
                        } else {
                            echo '<div class="carousel-item" data-bs-interval="5000">';
                        }
                        echo '<img src="images/covers/'.$dernier_acqui->image.'" class="d-block">';
                        echo '</div>';

                    }
                }
            
            ?>  
        </div>
    </div>

    <footer>
        <?php require('utilitaires/message_important.html')?>
    </footer>

</body>
</html>