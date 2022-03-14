<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
include "header.php";
include "databaseclass.php";

?>
<div class="container mt-3">
    <h1>My Posts</h1>
    <hr>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  
  <?php
  
  
$id=$_SESSION['id'];
$obj=new Database();
$posts=$obj->select("posts","*",null,"user_id='$id'",null,null);
$getres=$obj->getresult();
foreach ($getres as $value) {
    echo '
    
    
  <tbody>
  <tr>
    <th scope="row">'.$value['id'].'</th>
  <td><a href="details.php?id='.$value['id'].'"> '.$value['title'].'</a></td>
    <td>'.$value['description'].'</td>
    <td class="d-flex inline">
    
   <a href="edit.php?id='.$value['id'].'"> <button type="submit" name="edit" class="btn btn-primary"> Edit </button><a>||  
   <a href="delete.php?id='.$value['id'].'"> <button type="button" name "delete" class="btn btn-danger">Delete</button> </a>
    </td>
  </tr>
 
    
    ';
} 


  ?>


   
   
  </tbody>
</table>
<div>    
      