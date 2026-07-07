<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="OneBlog | Accueil de mon blog" />
        <meta name="author" content="Pitz Michaël" />
        <title>OneBlog | Accueil</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
<body>
    <?php include_once BASE_URL."/view/inc/menu.public.html.php"?>
    <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>OneBlog | Accueil</h1>
                <p class="lead">Page d'accueil de mon blog</p>
            </div>

            <?php

            if(empty($articles)):
            ?>
            <h3>Pas encore d'arcticle</h3>
            <?php
            else:
                // on va compter le nombre d'articles
                $count = count($articles);
                $pluriel = ($count>1)? "s" : "";
            ?>
            <h4>Il y a <?=$count?> article<?=$pluriel?></h4>
                <!-- Three columns of text below the carousel -->
    <div class="row">
            <?php
            // tant qu'on a des articles
            foreach($articles as $article):
            ?>
            

      <div class="col-lg-4">
        <title>Placeholder</title>
        <h3><a href="?idarticle=<?p= $article['id']?>"><?= $article['title'] ?></a></h3>
        <?php
        if(is_null($article['idcategory'])):
        ?>
        <h5>aucune catégorie</h5>
        <?php

        else:
                $idcateg = explode(",", $article['idcategory']);
                $titlecategory = explode("_|♥|_", $article['titlecategory']);
                $nbcateg = count($idcateg);
        ?>
        <h5><?php
            for($i=0;$i<$nbcateg; $i++):
                ?>
            <a href="?idcateg=<?= $idcateg[$i]?>"><?= $titlecategory[$i]?></a>"_|♥|_"
                <?php
            endfor;
        ?></h5>

        <?php
        endif;
        ?>
        <p class="lead">écrit pas <a href="?iduser=<?= $article["iduser"] ?>"><?= $article['realname'] ?></a> le <?= $article['datetime'] ?> </p>
        <p>Notre texte résumé</p>
      </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
    <?php var_dump($connection,$menu,$articles)?>
</body>
</html>