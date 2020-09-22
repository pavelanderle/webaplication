<?php
include "../config.php";
$id = $_GET["id"]; //add An

$sqlConn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);

$sql = "SET CHARACTER SET UTF8"; // SQL dotaz nastavující kódovou stránku pro komunikaci s DB serverem
$sqlConn->query($sql);

$sql = "DELETE FROM articles WHERE id='$id'";

$sqlConn->query($sql); // add An

$sqlConn->close();

?>