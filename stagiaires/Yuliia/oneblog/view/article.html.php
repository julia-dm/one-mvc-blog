<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="OneBLog | accueil de mon blog" />
    <meta name="author" content="Yuliia Dmytruk" />
    <title>OneBlog | TITRE de ARTICLE </title>
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
    
            <div class="row ">
                    <!-- Three columns of text below the carousel -->

                    <div >
                        <h3 class="text-center"><a href="?idarticle=<?= $article['id'] ?>"><?= $article['title'] ?></a> </h3>
                        <?php

                        if (is_null($article['idcategory'])):
                        ?>

                            <h4 class="text-center"> Aucune catégorie</h4>
                        <?php
                        else:
                            // on va transformer les chaines en tableau indexé
                            // via un separateur grace à explode()
                            $idcateg = explode(",", $article['idcategory']);
                            $titlecategory = explode("_|♥|_", $article['titlecategory']);

                            // on compte le nombre de categories 
                            $nbcateg = count($idcateg);
                        ?>
                            <h5 class="text-center">
                                <?php
                                    for($i=0;$i<$nbcateg;$i++):
                                ?>
                               <a class="text-center" href="?idcateg=<?= $idcateg[$i] ?>"><?= $titlecategory[$i] ?></a> | 
                            </h5>
                        <?php
                        endfor;
                        endif;
                        ?>

                        <p class="lead text-center">Ecrit par <a href="?iduser=<?= $article['iduser'] ?>"> <?= $article['realname']  ?></a> le <?= $article['datetime'] ?><p>
                        <p> <?=nl2br( $article['content']) ?> </p>
                    </div>




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