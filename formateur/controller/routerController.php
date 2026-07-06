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



/*************************
 * homepage
 *************************/

// gestion des données

// récupération des catégories pour le menu
$menu = selectCategoryForMenu($connection);

// récupération des articles pour la homepage
$articles = selectHomepageArticle($connection);

// appel de la vue
include_once BASE_URL."/view/homepage.html.php";

// bonne pratique, fermeture de connexion
$connection = null;