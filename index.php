<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>MyBlog</title>
</head>
<body>
    <?php 
        /* include external file myblog.class.php and config.php*/
        include "config.php";
        include "backend/myblog.class.php";
    ?>
    <!-- Header of front-end aplication-->
    <div class="wrap">
        <header>
            <?php include "frontend/header.php"?>
        <header>
        <!-- Navigation of front-end aplication-->
        <nav>
            <?php include "frontend/nav.php"?>
        </nav>
        <!-- Main content of front-end aplication-->
        <section>
            <?php 
                if (isset($_GET['id'])) {
                    include "frontend/detail.php";
                }
                else {
                    include "frontend/listArticles.php";
                }
            
            ?>
        </section>
        <!-- Footer of front-end aplication-->
        <footer>
            <?php include "frontend/footer.php" ?>
        </footer>
    </div>
</body>
</html>