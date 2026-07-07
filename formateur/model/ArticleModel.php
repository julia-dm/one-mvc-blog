<?php
# formateur/model/ArticleModel.php

/**
 * Gestionnaire de la table Article
 */

/**
 * Sélection de tous les articles pour la page d'accueil
 */
function selectHomepageArticle(PDO $db): array
{
    // requête
    $sql = "SELECT  a.`id`, a.`title`, SUBSTRING(a.`content`,1, 200) AS `content`, a.`datetime`,
		u.`id` AS `iduser`, u.`login`, u.`realname`,
        GROUP_CONCAT(c.`id`) AS `idcategory`, GROUP_CONCAT(c.`title` SEPARATOR '_|♥|_') AS `titlecategory`
	FROM `article` a
    INNER JOIN `user` u 
    	ON a.`user_id` = u.`id`
    LEFT JOIN `category_has_article` h 
    	ON a.`id` = h.`article_id`
    LEFT JOIN `category` c
    	ON c.`id` = h.`category_id`
    WHERE a.`actif`= 1
    GROUP BY a.`id`
    ORDER BY a.`datetime` DESC;";
    // exécution de la requête
    $stmt = $db->query($sql);
    // récupération des articles
    $articles = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // envoi du résultat
    return $articles;
}


/**
 * Sélection d'un article via son id
 * 
 */
function selectArticleById(PDO $db, int $id): ?array
{
    // requête
    $sql = "SELECT  a.`id`, a.`title`,  a.`content`, a.`datetime`,
		u.`id` AS `iduser`, u.`login`, u.`realname`,
        GROUP_CONCAT(c.`id`) AS `idcategory`, GROUP_CONCAT(c.`title` SEPARATOR '_|♥|_') AS `titlecategory`
	FROM `article` a
    INNER JOIN `user` u 
    	ON a.`user_id` = u.`id`
    LEFT JOIN `category_has_article` h 
    	ON a.`id` = h.`article_id`
    LEFT JOIN `category` c
    	ON c.`id` = h.`category_id`
    WHERE a.`id` = ? AND a.`actif`= 1
    GROUP BY a.`id`
  ";
    // préparation de la requête
    $stmt = $db->prepare($sql);

    // essai erreur
    try{
        // exécution de la requête avec un tableau contenant l'id
        $stmt->execute([$id]);

    }catch(Exception $e){
        // en cas d'erreur arrêt du script (die pour le débogage, on fera un .log en production)
        die($e->getMessage());
    }

    // on vérifie si on a pas récupéré de résultat
    if($stmt->rowCount()===0){
        // on met la récupération 
        $article = null;
    }else{
        // récupération de l'article
        $article = $stmt->fetch();
    }
    // bonne pratique
    $stmt->closeCursor();
    // envoi du résultat
    return $article;
}

/**
 * Fonction qui va couper le texte en dehors des mots
 */
function cutTheText(string $text, int $lenght=200): string
{
    // on compte le nombre de caractères
    $count = strlen($text);
    // si la longueur du texte est plus petite ou égale à $length
    if($count<=$lenght) return $text; // else implicite après cette ligne
    // on coupe à la longueur de length
    $text = substr($text,0,$lenght);
    // on va trouver l'emplacement du dernier espace, si il y en a dans le reste de texte
    $lastSpace = strripos($text, " ");
    // on coupe au dernier espce trouvé
    $text = substr($text,0,$lastSpace);
    // retour du texte traité
    return $text;
}

function dateInFrench(string $date): string
{
    // on essaie de convertir la date en timestamp (01/01/1970 en secondes)
    $timestamp = strtotime($date);
    // on va la formater avec la date en français
    $date = date("d/m/Y à H:\hi", $timestamp);
    return $date;
}

// echo cutTheText("coucou les amis",7);