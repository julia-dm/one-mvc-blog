<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="OneBlog | accueil de mon blog" />
        <meta name="author" content="Pitz Michaël" />
        <title>OneBlog | Accueil</title>
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
                <h1>OneBlog | Accueil</h1>
                <p class="lead">Page d'accueil de mon blog</p>
            </div>

            <?php
            // si pas d'articles
            if(empty($articles)):
            ?>
            <h3>Pas encore d'article</h3>
            <?php
            // sinon au moin un article
            else:
                // on va compter le nombre d'articles
                $count = count($articles);
                // on ajoute le pluriel si plus d'un
                $pluriel = ($count>1)? "s" : "";
            ?>
            <h4 class="pb-3">Il y a <?= $count ?> article<?= $pluriel ?></h4>
            <!-- Three columns -->
            <div class="row">
            <?php
                // tant qu'on a des articles
                foreach($articles as $article):
            ?>

      <div class="col-lg-4">
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
        <p><?= $article['content'] ?></p>
      </div>

            <?php
                endforeach;
            endif;
            ?>
            </div>
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