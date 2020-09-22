<?php
include "../config.php";
$sqlConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
$sql = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem
$sqlConn->query($sql);

$sql = "SELECT * FROM articles";
$result1 = mysqli_query($sqlConn, $sql);


if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
        echo "<a href='deleteArticle.php?id=".$row['id']."'>Delete</a>"."    id: " . $row["id"]. " - Name: " . $row["nameArticles"]. ", Author: " . $row["author"]. ", Category: ".$row["category"].", Date public: ".$row["datePublic"]."<br>"."<br>"; // update An
    }
} else {
    echo "Prázdný blog!";
}
mysqli_close($sqlConn);

?>