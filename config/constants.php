<?php 
ob_start();
session_start();

define('SITEURL', "http://localhost/Food_Order/");
define('LOCALHOST', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DBNAME', "db1_21815369");

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DBNAME) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DBNAME) or die(mysqli_error($conn));

?>