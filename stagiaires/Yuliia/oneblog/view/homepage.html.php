<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="OneBLog | accueil de mon blog" />
    <meta name="author" content="Yuliia Dmytruk" />
    <title>OneBlog | Accueil </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->

    <?php
    include BASE_URL . "/view/include/menu.public.html.php";
    ?>

    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>OneBlog | Accueil</h1>
            <p class="lead">Page d'accueil de mon blog</p>

        </div>
        <?php
        // si pas d'articles
        if (empty($articles)):

        ?>
            <h3>Pas encore d'article</h3>
        <?php
        // il y a au mois un article
        else:
            // on va compter le nombre d'articles
            $count = count($articles);
            // preparation du pluriel si on a plus d'un message
            $pluriel = $count > 1 ? "s" : "";
        ?>

            <h4 class="pb-3">Il y a <?= $count ?> article<?= $pluriel ?></h4>
            <div class="row ">
                <?php

                foreach ($articles as $article):

                ?>
                    <!-- Three columns of text below the carousel -->

                    <div class="col-lg-4">
                        <h3><a href="?idarticle=<?= $article['id'] ?>"><?= $article['title'] ?></a> </h3>
                        <?php

                        if (is_null($article['idcategory'])):
                        ?>

                            <h4> Aucune catégorie</h4>
                        <?php
                        else:
                            // on va transformer les chaines en tableau indexé
                            // via un separateur grace à explode()
                            $idcateg = explode(",", $article['idcategory']);
                            $titlecategory = explode("_|♥|_", $article['titlecategory']);

                            // on compte le nombre de categories 
                            $nbcateg = count($idcateg);
                        ?>
                            <h5>
                                <?php
                                    for($i=0;$i<$nbcateg;$i++):
                                ?>
                               <a href="?idcateg=<?= $idcateg[$i] ?>"><?= $titlecategory[$i] ?></a> | 
                            </h5>
                        <?php
                        endfor;
                        endif;
                        ?>

                        <p class="lead">Ecrit par
                            <a href="?iduser=<?= $article['iduser'] ?>">
                                <?= $article['realname']  ?></a> le <?= $article['datetime'] ?>
                        <p>
                        <p> <?=cutTheText( $article['content'],180 ) ?> ... <a href="?idarticle=<?= $article['id'] ?>">lire la suite</a></p>
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
    // var_dump($connection, $articles, $menu);
    ?>
</body>

</html>