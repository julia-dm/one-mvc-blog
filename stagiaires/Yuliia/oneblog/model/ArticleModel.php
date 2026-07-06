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