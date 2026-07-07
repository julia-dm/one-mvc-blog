<?php

function selectHomepageArticle(PDO $db): array|string|bool
{
    $sql ="SELECT  a.`id`, a.`title`, SUBSTRING(a.`content`,1, 200) AS `content`, a.`datetime`,
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

    // si pas de résultats
    // if($stmt->rowCount()===0){
    //     // bonne pratique
    //     $stmt->closeCursor();
    //     // on renvoie null (?)
    //     return null;

    // }

    // on a aumoins un resultat
    $articles = $stmt->fetchAll();
    // bonne pratique 
    $stmt->closeCursor();

    // envoie du résultat
    return $articles;

}