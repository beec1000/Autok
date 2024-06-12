<?php
header("Content-Type:text/html; charset=utf-8");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "autok"); //csak db nevét kell cserélni

$dbconn = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if(!$dbconn){
    die("HIBA az adatbázis csatlakozásakor:" . mysqli_connect());
}
echo "Sikeres kapcsolat";

mysqli_query($dbconn, "SET NAMES utf8");

?>