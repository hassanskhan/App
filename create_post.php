<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
include "header.php";
include "dbconnection.php";

if (isset($_POST['submit'])) {
    $title=$_POST['title'];
    $userid=$_POST['user_id'];
    $description=$_POST['description'];
    $insert="INSERT INTO posts (`title`,`description`,`user_id`)VALUES('$title','$description','$userid')";
    $query=$conn->query($insert);
    if ($query) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Post Submit successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }else{
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>oops!</strong>Not Submit
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
    }
}
?>


<div class="container" style="height:31.1rem">
    <h1>Blog Post</h1>

    <form action="create_post.php" method="POST">

    <div class="mb-3">
  <label for="" class="form-label">Title</label>
  <input type="text" class="form-control" name="title" id="" placeholder="Enter Your Title">
</div>

    <div class="mb-3">
  
  <input type="hidden" class="form-control" name="user_id" id="" value="
  <?php
  
  echo $_SESSION['id'];
  ?>
  ">
</div>
<div class="mb-3">
  <label for="" class="form-label">Description</label>
  <textarea class="form-control" name="description" id="" rows="3"></textarea>
</div>
<button type="submit" name="submit" class="btn btn-lg btn-success">Post</button>
    </form>
</div>









<?php
include "footer.php";
?>
