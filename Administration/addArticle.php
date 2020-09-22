<?php
    include "../config.php";
    $nameArticle=$_POST["nameArticle"];
    $contentArticle=$_POST["contentArticle"];
    $author=$_POST["author"];
    $category=$_POST["category"];
    $date=$_POST["date"];
    $img=$_POST["img"];

    $sqlConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);

    $sql = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem 
        $sqlConn->query($sql);

    // Check connection
    if ($sqlConn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $sql = "INSERT INTO articles (nameArticles, contentArticles, author, category, datePublic, img ) VALUES ('$nameArticle', '$contentArticle', '$author', '$category','$date', '$img')";

    if ($sqlConn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $sqlConn->error;
    }

    $sqlConn->close();

?>