<?php

class detailArticle {
    
    /* Atributy odpovídají atributům z DB tabulky */
    private $id;
    private $nameArticle;
    private $contentArticle;
    private $author;
    private $category;
    private $datePublic;
    private $img;

    /* constructor */
    public function __construct(){
    }

    /* getters */
    public function getId(){
        return $this->id;
    }

    public function getNameArticle(){
        return $this->nameArticle;
    }

    public function getContentArticle(){
        return $this->contentArticle;
    }

    public function getContentArticleTrunc(){
        return strip_tags(substr($this->contentArticle, 0, 150)). "...";
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getDatePublic(){
        return $this->datePublic;
    }

    public function getImg(){
        return $this->img;
    }

    /* setters */
    public function setAllAttributes($id,$nameArticle,$contentArticle,$author,$category,$datePublic,$img){
        if (is_numeric($id)){
            $this->id = $id;
        }
        if (is_string($nameArticle)){
            $this->nameArticle = $nameArticle;
        }
        if (is_string($contentArticle)){
            $this->contentArticle = $contentArticle;
        }
        if (is_string($author)){
            $this->author = $author;
        }
        if (in_array($category,CATEGORYARRAY)){
            $this->category = $category;
        }
        if (is_string($datePublic)){
            $this->datePublic = $datePublic;
        }
        if (filter_var($img, FILTER_VALIDATE_URL)){
            $this->img = $img;
        }
    }

    public function setNameArticle($nameArticle){
        if (is_string($nameArticle)){
            $this->nameArticle = $nameArticle;
        }
    }

    public function setcontentArticle($contentArticle){
        if (is_string($contentArticle)){
            $this->contentArticle = $contentArticle;
        }
    }


    public function setAuthor($author){
        if (is_string($author)){
            $this->author = $author;
        }
    }

    public function setCategory($category){
        if (in_array($category,CATEGORYARRAY)){
            $this->category = $category;

        }
    }

    public function setDatePublic($datePublic){
        if (is_string($datePublic)){
            $this->datePublic = $datePublic;
        }
    }

    public function setImg($img){
        if (filter_var($img, FILTER_VALIDATE_URL)){
            $this->img = $img;
        }
    }

    /* Metoda, která načte informace jednoho záznamu z DB tabulky Articles dle id článku*/
    public function loadDataById($id){
        $feedBack = true; // počáteční nastavení návratové hodnoty
        $dbConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME); // vytvoření objektu mysqli - paramerty převzaty z config.php
        
        if ($dbConn->connect_error) { 
            $feedBack = false; // nastavení návratové hodnoty na false v případě chyby s připojením k DB serveru
        }

        $sql = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $dbConn->query($sql); // odeslání SQL dotazu na DB server

        $sql = "SELECT * FROM articles WHERE id='$id'"; // SQL dotaz pro výběr článku dle id z tabulky articles

        $result = $dbConn->query($sql); // odeslání SQL dotazu na DB server - $result obsahuje výsledek dotazu

        if ($result->num_rows > 0) { // kontrola zdali SQL dotaz SELECT vrátil článek 
            while($row = $result->fetch_assoc()) { // postupné procházení řádek výsledku - fetch_assoc() vrací pole hodnot jednoho řádku  
                $this->id = $row["id"]; // přiřazení hodnoty id z pole $row do atributu objektu
                $this->nameArticle = $row["nameArticles"];
                $this->contentArticle = $row["contentArticles"];
                $this->author = $row["author"];
                $this->category = $row["category"];
                $this->datePublic = $row["datePublic"];
                $this->img = $row["img"];
            }
        }
            else {
                $feedBack = false; // v případě, že DB server nevrátí žádný záznam - výstupní hodnota False
            }
        $dbConn->close();
        return $feedBack;
    }

}

class listOfArticles {
    private $listArticles;

    public function __construct(){

    }

    public function getListArticles(){
        return $this->listArticles;
    }

    /* načtení seznamu článků dle zadaného SQL */
    public function loadListArticlesBySQL($sql){
        $feedBack = true; // počáteční nastavení návratové hodnoty
        $dbConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME); // vytvoření objektu mysqli - paramerty převzaty z config.php
        
        if ($dbConn->connect_error) { 
            $feedBack = false; // nastavení návratové hodnoty na false v případě chyby s připojením k DB serveru
        }

        $sqlCharSet = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $dbConn->query($sqlCharSet); // odeslání SQL dotazu na DB server

        $result = $dbConn->query($sql);
        if ($result->num_rows > 0) { // kontrola zdali SQL dotaz SELECT vrátil články 
            while($row = $result->fetch_assoc()) { // postupné procházení řádek výsledku - fetch_assoc() vrací pole hodnot jednoho řádku  
                $actArticle = new detailArticle(); // vytvoření nového objektu článku
                $actArticle->setAllAttributes($row["id"], $row["nameArticles"], $row["contentArticles"], $row["author"],  $row["category"], $row["datePublic"], $row["img"]); //naplnění atributů objektu hodnotami
                $this->listArticles[] = $actArticle; // přidání objektu do pole článků
            }
        }
            else {
                $feedBack = false; // v případě, že DB server nevrátí žádný záznam - výstupní hodnota False
            }
        $dbConn->close();
        return $feedBack;
    }

    /* načtení seznamu článků dle zadané kategorie */
    public function loadListArticlesByCategory($category){
        $sql= "SELECT * FROM Articles WHERE category='$category'";
        $feedBack = true; // počáteční nastavení návratové hodnoty
        $dbConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME); // vytvoření objektu mysqli - paramerty převzaty z config.php
        
        if ($dbConn->connect_error) { 
            $feedBack = false; // nastavení návratové hodnoty na false v případě chyby s připojením k DB serveru
        }

        $sqlCharSet = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $dbConn->query($sqlCharSet); // odeslání SQL dotazu na DB server

        $result = $dbConn->query($sql);
        if ($result->num_rows > 0) { // kontrola zdali SQL dotaz SELECT vrátil články 
            while($row = $result->fetch_assoc()) { // postupné procházení řádek výsledku - fetch_assoc() vrací pole hodnot jednoho řádku  
                $actArticle = new detailArticle(); // vytvoření nového objektu článku
                $actArticle->setAllAttributes($row["id"], $row["nameArticles"], $row["contentArticles"], $row["author"],  $row["category"], $row["datePublic"], $row["img"]); //naplnění atributů objektu hodnotami
                $this->listArticles[] = $actArticle; // přidání objektu do pole článků
            }
        }
            else {
                $feedBack = false; // v případě, že DB server nevrátí žádný záznam - výstupní hodnota False
            }
        $dbConn->close();
        return $feedBack;
    }

    /* načtení seznamu článků dle zadaného autora */
    public function loadListArticlesByAuthor($author){
        $sql= "SELECT * FROM Articles WHERE author='$author'";
        $feedBack = true; // počáteční nastavení návratové hodnoty
        $dbConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME); // vytvoření objektu mysqli - paramerty převzaty z config.php
        
        if ($dbConn->connect_error) { 
            $feedBack = false; // nastavení návratové hodnoty na false v případě chyby s připojením k DB serveru
        }

        $sqlCharSet = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $dbConn->query($sqlCharSet); // odeslání SQL dotazu na DB server

        $result = $dbConn->query($sql);
        if ($result->num_rows > 0) { // kontrola zdali SQL dotaz SELECT vrátil články 
            while($row = $result->fetch_assoc()) { // postupné procházení řádek výsledku - fetch_assoc() vrací pole hodnot jednoho řádku  
                $actArticle = new detailArticle(); // vytvoření nového objektu článku
                $actArticle->setAllAttributes($row["id"], $row["nameArticles"], $row["contentArticles"], $row["author"],  $row["category"], $row["datePublic"], $row["img"]); //naplnění atributů objektu hodnotami
                $this->listArticles[] = $actArticle; // přidání objektu do pole článků
            }
        }
            else {
                $feedBack = false; // v případě, že DB server nevrátí žádný záznam - výstupní hodnota False
            }
        $dbConn->close();
        return $feedBack;
    }

    /* načtení seznamu článků dle zadaného data  */
    public function loadListArticlesByDate($startDate){
        $sql= "SELECT * FROM Articles WHERE datePublic>'$startDate'";
        $feedBack = true; // počáteční nastavení návratové hodnoty
        $dbConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME); // vytvoření objektu mysqli - paramerty převzaty z config.php
        
        if ($dbConn->connect_error) { 
            $feedBack = false; // nastavení návratové hodnoty na false v případě chyby s připojením k DB serveru
        }

        $sqlCharSet = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $dbConn->query($sqlCharSet); // odeslání SQL dotazu na DB server

        $result = $dbConn->query($sql);
        if ($result->num_rows > 0) { // kontrola zdali SQL dotaz SELECT vrátil články 
            while($row = $result->fetch_assoc()) { // postupné procházení řádek výsledku - fetch_assoc() vrací pole hodnot jednoho řádku  
                $actArticle = new detailArticle(); // vytvoření nového objektu článku
                $actArticle->setAllAttributes($row["id"], $row["nameArticles"], $row["contentArticles"], $row["author"],  $row["category"], $row["datePublic"], $row["img"]); //naplnění atributů objektu hodnotami
                $this->listArticles[] = $actArticle; // přidání objektu do pole článků
            }
        }
            else {
                $feedBack = false; // v případě, že DB server nevrátí žádný záznam - výstupní hodnota False
            }
        $dbConn->close();
        return $feedBack;
    }




}

?>