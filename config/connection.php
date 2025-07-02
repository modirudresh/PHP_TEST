<?php

$host = 'localhost';
$user = 'root';
$pass = 'admin123';
$dbname = 'PHP_TEST';


$con = mysqli_connect($host, $user, $pass, $dbname);

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>