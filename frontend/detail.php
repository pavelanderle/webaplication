<?php
    $id = $_GET['id']; // získání id článku

    $article = new detailArticle(); // vytvoření objektu 
    $article->loadDataById($id); // volání metody objektu
?>
<div>
    <h1><?php echo $article->getNameArticle()?></h1>
    <p>Datum publikování: <?php echo $article->getDatePublic()?></p>
    <p><img src=<?php echo $article->getImg()?> /></p>
    <div class="content"><?php echo $article->getContentArticle() ?></div>
    <p>Autor: <?php echo $article->getAuthor() ?></p>

    <p><a href="index.php" >Zpět na seznam článků >>></a></p>
</div>