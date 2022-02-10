<?php
$salt = "oq&wi&epo&sdkaljsd";
//database_connection.php
$host = "localhost";
$db   = "ecom_db";
$user = "root";
$pass = "";

//FOR MYSQLi
$dbCon = mysqli_connect($host,$user,$pass,$db);

//FOR PDO USE
$connect = new PDO("mysql:host=".$host.";dbname=".$db."", "".$user."", "".$pass."");


?>