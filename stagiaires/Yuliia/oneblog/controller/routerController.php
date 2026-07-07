<?php

/**
 * Routage, ce contrôleur va charger les données et
 * les vues suivant les urls reçues (GET)
 *
 */

/**
 * Appel des dépendances
 */
require_once BASE_URL . "/model/CategoryModel.php";

//appel du gestionnaire d'article
require_once BASE_URL . "/model/ArticleModel.php";

/**
 * On a besoin d'une connexion MySQL
 * pour toutes nos pages, on va d'onc l'ouvrir 
 */

try {
    $connection = new PDO(
        dsn: DB_DSN,
        username: DB_LOGIN,
        password: DB_PWD,
        options: [
            # activation de l'affichage des erreurs
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            # on ne récupère les données qu'au formation tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $e) {
    // arrêt du script et affichage de l'erreur
    die($e->getMessage());
}
// gestion des données utiles pour toutes les pages

// récuperation des  catégories pour le menu
$menu = selectCategoryFromMenu($connection);

/**
 * detail
 */

// on va vérifier l'existance (avec isset ou le fait qu'il soit non vide pour le 0)
// de la variable
if (!empty($_GET['idarticle']) && ctype_digit($_GET['idarticle'])) {
    /*
 */

    // echo $_GET['idarticle'];

    //on met dans une variable locale la variable GET transformée en entier
    $idarticle = (int) $_GET['idarticle'];
    // ou settype($_GET['idarticle'],"integer")

    //récupération de l'article
    $article = selectArticleById($connection, $idarticle);

    // si l'article vaut null (non trouvé)
    if (is_null($article)) {
        // appel 404
        //include BASE_URL."/view/404.html.php";
    } else {
        // appel de la vue
        include BASE_URL . "/view/article.html.php";
    }
} else {

    /****************************
     * homepage
     ***************************/
    // récuperation des  articles pour la homepage
    $articles = selectHomepageArticle($connection);
    // appel de la vue

    // appel
    include_once BASE_URL . "/view/homepage.html.php";
}









// bonne pratique, fermeture de connexion
$connection = null;
