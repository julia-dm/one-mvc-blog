<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="OneBLog | accueil de mon blog" />
        <meta name="author" content="Yuliia Dmytruk" />
        <title>OneBlog  | Accueil </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
<body>
            <!-- Responsive navbar-->
     
        <?php
        include BASE_URL."/view/include/menu.public.html.php";
        ?>

           <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>OneBlog | Accueil</h1>
                <p class="lead">Page d'accueil de mon blog</p>
            
            </div>
               <?php 
            // si pas d'articles
            if(empty($articles)):
        
        ?>
        <h3>Pas encore d'article</h3>
       <?php
            // il y a au mois un article
            else:
                // on va compter le nombre d'articles
                $count=count($articles);
                // preparation du pluriel si on a plus d'un message
                $pluriel = $count > 1 ? "s" : "";
            ?>
               <h4>Il y a <?= $count ?> article<?= $pluriel ?></h4>
         <?php 
       endif;
        
        ?>
        </div>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
     
    <?php 
    var_dump($connection,$articles,$menu);
    ?>
</body>
</html>