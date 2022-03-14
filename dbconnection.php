<?php

$server="localhost";
$username="root";
$password="";
$dbname="blogs";


$conn=new mysqli($server,$username,$password,$dbname);
if ($conn->connect_error) {
    die("Faild To connect".$conn->connect_error);
}


?>