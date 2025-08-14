<?php
define('DB_SERVER',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"123456789");
define('DB_DATABASE',"possysytem");

$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if(!$con){
    die("Connection Failed:" . mysqli_connect_error());
}
?>