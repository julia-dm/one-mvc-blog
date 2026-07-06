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