<?php
session_start();
include "header.php";
include "databaseclass.php";

$obj = new Database();
$id = $_GET['id'];
$show = $obj->select("posts", "*", null, 'id=' . $id . '', null, null);
$result = $obj->getresult();
foreach ($result as $key => list("id" => $id, "title" => $title, 'description' => $description)) {
    echo  '

    <div class="container"  style="height:"500px;">
    
<a href="details.php?id=' . $id . '"><h1 class="display-4">' . $title . '</h1></a> 
    <p class="lead">' . $description . '</p>
    <hr class="my-4">
   </div> ';
}

$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $user = $_POST['user_id'];
    $post = $_POST['post_id'];
    $comment = $_POST['comment'];

    $values = ['comment' => $comment, 'user_id' => $user, 'post_id' => $post];
    if ($obj->insert("comments", $values)) {
        echo '<div class="alert alert-success container" role="alert">
       Your comment submit successfully
      </div';
    }
}

if (!isset($_SESSION['username'])) {
    echo '
    <div class="container">
    <h4>You need to login First for commenting a post</h4>
    <h2><a href="login.php">Login</a></h2>
    <br>
    <br>
    <br>
    </div>
    ';
} else {
    $reqserver = $_SERVER['REQUEST_URI'];
    $sessid = $_SESSION['id'];
    $getid = $_GET['id'];
    echo ' 
    <div class="container">
    
        <form action="' . $reqserver . '" method="POST">
        <div class="mb-3">
        <label for="" class="form-label">Comment Here</label>
        <textarea class="form-control" name="comment" id="" rows="3"></textarea>
      </div>
            
            <input type="hidden" class="form-control" name="user_id" value="' . $sessid . '">
            <input type="hidden" class="form-control" name="post_id" value="' . $getid . '">
            <button type="submit" name="submit" class="btn btn-lg btn-success mt-3">submit</button>
        </form>
    </div>
        ';
}

?>

<hr>
<div class="container" style="height: 100%;">
    <h1>Comments</h1>
    <hr>
    <?php

    $allcomments = $obj->sql("SELECT * FROM `comments` WHERE post_id=$id");
    $collect = $obj->getresult();
    foreach ($collect as $values) {
        $cnameid = $values['user_id'];
        $name = $obj->sql("SELECT * FROM `users` WHERE `id`=$cnameid");
        $getname = $obj->getresult();
         foreach ($getname as $usersname) {
             $cname=$usersname['username'];
             
            }    
        echo

        '<div class="media">
<img src="images/user.png" class="align-self-center mr-3" alt="..." width="70px" height="50px">
<div class="media-body">

  <h5 class="mt-0">'.$cname.'</h5>
  <p>'.$values['date'].'</p>
  <p class="mb-0"><b>Comment: ' . $values['comment'] . '</b></p>
</div>
</div>';
    }

    ?>
</div>

<?php
include "footer.php";
?>