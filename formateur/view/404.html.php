<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="OneBlog | accueil de mon blog" />
        <meta name="author" content="Pitz Michaël" />
        <title>OneBlog | Erreur 404</title>
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
                <h1>OneBlog | Erreur 404</h1>
                <p class="lead"><?= $content ?></p>
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