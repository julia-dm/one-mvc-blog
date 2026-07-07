<?php

/**
 * Routage, ce contrôleur va charger les données et
 * les vues suivant les urls reçues (get)
 * 
 */


/**
 * appel des dépendendances
 */

// appel du gestionnaire de category
require_once BASE_URL."/model/CategoryModel.php";
require_once BASE_URL."/model/ArticleModel.php";


try{
    $connection = new PDO(
        dsn:DB_DSN,
        username:DB_LOGIN,
        password:DB_PWD,
        options:[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
}catch(Exception $e){
    // arrêt du script et affichage de l'erreur
    die($e->getMessage());
}

/**
 * homepage
 */


// récupération des category pourmenu 

$menu = selectCategoryForMenu($connection);
$articles= selectHomepageArticle($connection);
// gestion des données

// appel de la vue

// appel
include BASE_URL."/view/homepage.html.php";

// bonne pratique, fermeture de connexion
$connection = null;