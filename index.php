<?php
session_start();
include "header.php";
include "databaseclass.php";

?>

<div class="container" style="height: 100%">

    
    
    <div class="container">
    <h1>All POSTS</h1>
    <?php
    
    $obj=new Database();
    $show=$obj->select("posts","*",null,null,null,null);
    $result=$obj->getresult();
    foreach ($result as $key=>list("id"=>$id,"title"=>$title,'description'=>$description)) {
        echo '
  <a href="details.php?id='.$id.'"><h1 class="display-4">'.$title.'</h1></a> 
        <p class="lead">'.$description.'</p>
        <hr class="my-4">
        ';
    }
    
    ?>
 
  
 
</div>

</div>






</div>


<?php
include "footer.php";
?>