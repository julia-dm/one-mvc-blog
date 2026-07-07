<?php
# formateur/model/ArticleModel.php

/**
 * Gestion de la table  Articles
 */

// on va récupérer les articles 

function selectHomepageArticle(PDO $db): array
{
    // requête sql
    $sql = "SELECT  a.`id`, a.`title`, SUBSTRING(a.`content`,1, 200) AS `content`, a.`datetime`,
		u.`id` AS `iduser`, u.`login`, u.`realname`,
        c.`id` AS `idcategory`, c.`title` AS `titlecategory`
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

    //récupération des articles
    $articles = $stmt->fetchAll();
    // bonne pratique 
    $stmt->closeCursor();

    // envoie du résultat
    return $articles;
}

/**
 * function qui va couper le text en dehors des mots
 */

function cutTheText(string $text, int $length = 200): string
{
    // on compt le nombre de caractères
    $count = strlen($text);

    // si la longeur du texte est plus petite ou égale à $length
    if ($count <= $length) return $text; // else implicite apres cette ligne 
    // on coupe à la longeur de $length 
    $text = substr($text, 0, $length);

    //on va trouver l'emplacement du dernier espace, si il y en a dans le reste de texte
    $lastSpace = strripos($text," ");
    // on coupe au dernier espace trouvé
    $text = substr($text, 0, $lastSpace);
    // retour du texte traité
    return $text;
}
//echo cutTheText("coucou les bbbib", 7);
