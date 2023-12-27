<?php
$requestedUrl = $_SERVER['REQUEST_URI'];

// Fonction qui va récupérer les nom de la page même si des arguments sont ajoutés dans l'url, récupéré
// dans la variable $requestedUrl
// exemple: "/search?auteur=Wells" retourne /search
function extractPageFromUrl($requestUrl)
{
    $path = parse_url($requestUrl, PHP_URL_PATH);
    $pathSegments = explode('/', trim($path, '/'));
    $lastSegment = end($pathSegments);
    $page = '';
    if (strpos($lastSegment, '?') !== false) {
        list($page, $queryString) = explode('?', $lastSegment, 2);
    } else {
        $page = $lastSegment;
    }
    return '/' . $page;
}

// Set le nom de la page pour le titre et le routeur
$page = extractPageFromUrl($requestedUrl);

$pages_titles = [
    '/' => 'Acceuil',
    '/addbook' => 'Ajouter un livre',
    '/addmember' => 'Ajouter un membre',
    '/detail' => 'Détail',
    '/panier' => 'Panier',
    '/basketmanager' => 'Basketmanager',
    '/search' => 'Recherche',
];

// Set le titre pour la balise <head> en se servant de la variable $page set précedemment
// Si aucun titre n'est trouvé, ne se connecte pas à la BDD et ne démarre pas la session et le routeur retourne la page 404.php
$title = "Page non trouvée";
if (isset($pages_titles[$page])) {
    session_start();
    $title = $pages_titles[$page];
    require_once('utilitaires/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require("utilitaires/import.html"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Bibliodrive -
        <?php echo $title ?>
    </title>
</head>

<body>
    <?php
    switch ($page) {
        case '/':
            include 'accueil.php';
            break;
        case '/addbook':
            include 'ajouter_livre.php';
            break;
        case '/addmember':
            include 'ajouter_membre.php';
            break;
        case '/search':
            include 'lister_livres.php';
            break;
        case '/detail':
            include 'detail.php';
            break;
        case '/panier':
            include 'panier.php';
            break;
        case '/basketmanager':
            include 'utilitaires/panier_manager.php';
            break;
        case '/phpinfo':
            include 'phpinfo.php';
            break;
        default:
            include '404.php';
            break;
    }
    ?>
</body>

</html>