<?php
# formateur/controller/routerController.php

/**
 * Routage, ce contrôleur va charger les données et
 * les vues suivant les urls reçues (GET)
 */

/**
 * Appel des dépendances
 */

// appel du gestionnaire de category
require_once BASE_URL."/model/CategoryModel.php";
// appel du gestionnaire de article
require_once BASE_URL."/model/ArticleModel.php";

/**
 * On a besoin d'une connexion MySQL
 * pour toutes nos pages, on va d'onc l'ouvrir
 * ici
 */

try{
    $connection = new PDO(
        dsn:DB_DSN,
        username:DB_LOGIN,
        password:DB_PWD,
        options:[
            # activation de l'affichage des erreurs
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            # on ne récupère les données qu'au formation tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
// en cas d'erreur    
}catch(Exception $e){
    // arrêt du script et affichage de l'erreur
    die($e->getMessage());
}

// gestion des données utiles pour toutes les pages

// récupération des catégories pour le menu
$menu = selectCategoryForMenu($connection);

/**
 * Début du router
 */

// on va vérifier l'existance (avec isset ou le fait qu'il soit non vide pour le 0) de la variable get idarticle et qu'il ne contient que des digits (0_9)
if(!empty($_GET['idarticle'])&& ctype_digit($_GET['idarticle'])){

/*************************
 * détail d'un article
 *************************/

    // echo gettype($_GET['idarticle']);// affichage du type
    // on met dans une variable locale la variable get transformée en entier
    $idarticle = (int) $_GET['idarticle'];
    // settype($_GET['idarticle'],"integer");

    // récupération de l'article
    $article = selectArticleById($connection,$idarticle);

    // si l'article vaut null (non trouvé)
    if(is_null($article)){
        // variables pour la 404
        $content = "Cette page n'existe plus, merci de visiter les autres sections de notre site";
        // appel de la 404
        include_once BASE_URL."/view/404.html.php";
    }else{
        // appel de la vue
        include_once BASE_URL."/view/article.html.php";
    }
}else{

/*************************
 * homepage
 *************************/

        // récupération des articles pour la homepage
        $articles = selectHomepageArticle($connection);

        // appel de la vue
        include_once BASE_URL."/view/homepage.html.php";

}

// bonne pratique, fermeture de connexion
$connection = null;