<?php 
    $listArts = new ListOfArticles(); // vytvoření nového objektu seznam článků

    $sql = "Select * from articles"; // SQL dotaz pro výběr všech článků (záznamů) z DB
    
    
    if (isset($_GET['category'])) {
        $listArts->loadListArticlesByCategory($_GET['category']);
    }
    else{
        $listArts->loadListArticlesBySQL($sql);
    }
     // volání metody, která naplní seznam článků dle SQL dotazu
    //$listArts->loadListArticlesByAuthor($author);
    //$listArts->loadListArticlesByDate($date);
 

    foreach ($listArts->getlistArticles() as $value) {
        echo "<article class='flex-container'>";
            echo "<div class='articleImg'>";
            echo "<img src='". $value->getImg()."' alt='img' />"; // zobrazení obrázku článku
            echo "</div>";
            echo "<div class='articleContent'>";
            echo "<h2><a href='index.php?id=".$value->getId()."'>".$value->getNameArticle()."</a></h2>"; // zobrazení nadpisu
            echo "<p>".$value->getContentArticleTrunc()."</p>"; // zobrazení zkráceného obsahu článku
            echo "<p class='author'>". $value->getAuthor() ."</p>"; // zobrazení autora článku
            echo "<p class='datePublic'>". $value->getDatePublic() ."</p>"; // zobrazení data publikování
            echo "</div>";
        echo "</article>";
    }
?>
