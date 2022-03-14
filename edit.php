<?php
$success=false;
$notupdate=false;
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
include "header.php";
include "dbconnection.php";

if (!isset($_GET['id'])) {
  # code...
}else{


$id=$_GET['id'];
$updatepost="SELECT * FROM posts where id='$id'";
$sql=mysqli_query($conn,$updatepost);
while($row=mysqli_fetch_assoc($sql)){
    
    $title=$row['title'];
    $description=$row['description'];

}
if (isset($_POST['submit'])) {
      $id=$_POST['id'];
      $title=$_POST['title'];
      $description=$_POST['description'];
      $update="UPDATE `posts` SET `title` = '$title', `description` = '$description' WHERE `posts`.`id` = $id";
      $sql=$conn->query($update);
      if ($sql) {
        header("location:myposts.php");
          $success=true;
          
      }else{
        $notupdate=true;
      }
}
}

?>

<div class="container" style="height:500px">

<?php

if ($success) {
    echo '
    <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
  <strong>Success !</strong>Your post Update Successfully;
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    ';
}

if ($notupdate) {
  echo ' 
  
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Failed !</strong>Your Post did not Update
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  
  ';
}
?>



<h1>Update Post</h1>
<form action="" method="POST" id="form">

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" class="form-control" name="title" id="" value="<?php echo $title; ?>">
</div>
<div class="mb-3">
  <label for="" class="form-label">Description</label>
  <textarea class="form-control" name="description" id="" rows="3"><?php echo $description; ?></textarea>
</div>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" name="submit" class="btn btn-success">Update</button>
</form>

</div>



<?php include "footer.php"; ?>