<?php
 
/**
 * Routage, ce contrôleur va charger les données et
 * les vues suivant les urls reçues (GET)
 *
 */
 
/**
 * Appel des dépendances
 */
require_once BASE_URL."/model/CategoryModel.php";

//appel du gestionnaire d'article
require_once BASE_URL."/model/ArticleModel.php";

/**
 * On a besoin d'une connexion MySQL
 * pour toutes nos pages, on va d'onc l'ouvrir 
 */

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
 
/****************************
 * homepage
 ***************************/
 
// gestion des données

// récuperation des  catégories pour le menu
$menu=selectCategoryFromMenu($connection);

// récuperation des  articles pour la homepage
$articles=selectHomepageArticle($connection);
// appel de la vue
 
// appel
include_once BASE_URL."/view/homepage.html.php";


// bonne pratique, fermeture de connexion
$connection=null;

