<?php 
ob_start();
session_start();

define('SITEURL', "https://gardenia-order-app.herokuapp.com/Food_Order/");
define('LOCALHOST', "us-cdbr-east-05.cleardb.net");
define('DB_USERNAME', "ba7b717cc93067");
define('DB_PASSWORD', "15f757e3");
define('DBNAME', "heroku_2a1b9786518a26f");

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DBNAME) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DBNAME) or die(mysqli_error($conn));

?>
