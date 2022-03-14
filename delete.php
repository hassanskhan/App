<?php
include "dbconnection.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
$delid=$_GET['id'];
$delete="DELETE  FROM `posts` WHERE `id`='$delid'";
$sql=$conn->query($delete);

if ($sql) {
    header("location:myposts.php");
}


?>