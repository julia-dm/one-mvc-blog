<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="OneBlog | accueil de mon blog" />
        <meta name="author" content="Pitz Michaël" />
        <title>OneBlog | TITRE de ARTICLE</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
<body>
    <!-- Responsive navbar-->
     <?php include_once BASE_URL."/view/include/menu.public.html.php" ?>   
     <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>OneBlog | TITRE de ARTICLE</h1>
                <p class="lead">Page d'accueil de mon blog</p>
            </div>

            <!-- Three columns -->
            <div class="row">

      <div>
        <h4><a href="?idarticle=<?= $article['id'] ?>"><?= $article['title'] ?></a></h4>
        <?php
        // si pas de category (===null)
        if(is_null($article['idcategory'])):
        ?>
        <h5>Aucune catégorie</h5>
        <?php
        // il y a au moins 1 catégorie
        else:
            // on va transformer les chaînes en tableau indexé
            // via un séparateur grâce à explode()
            // echo $article['idcategory']."<br>".$article['titlecategory'];
            $idcateg = explode(",", $article['idcategory']);
            $titlecategory = explode("_|♥|_", $article['titlecategory']);
            // on compte le nombre de catégories
            $nbcateg = count($idcateg);
        ?>
        <h5 class="p-3"><?php
            // tant qu'on a des catégories
            for($i=0; $i<$nbcateg; $i++):
                // on les affiches avec le lien qui sont leurs IDs
                ?>
            <a href="?idcateg=<?= $idcateg[$i] ?>"><?= $titlecategory[$i] ?></a> | 
                <?php
            endfor;
        ?></h5>
        <?php
        endif;
        ?>
        <p class="lead">Ecrit par <a href="?iduser=<?= $article['iduser'] ?>"><?= $article['realname'] ?></a> le <?= $article['datetime'] ?></pa> 
        <p><?= nl2br($article['content']) ?></p>
      </div>

            </div>
        </div>



        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
    <?php
    // var_dump($connection,$articles,$menu);
    ?>
</body>
</html>