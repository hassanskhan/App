<?php
session_start();
$wrong=false;
$invalid=false;

include "dbconnection.php";
include "header.php";
    if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="SELECT * FROM `users` where `email`='$email'";

    $Actualquery=$conn->query($query);
    $emailcount=mysqli_num_rows($Actualquery);
    if ($emailcount) {
        $pickEmail=mysqli_fetch_assoc($Actualquery);
        $db_pass=$pickEmail['password'];
        $password_decode=password_verify($password,$db_pass);
        if ($password_decode) {
          $_SESSION['username']=$pickEmail['username'];
          $_SESSION['id']=$pickEmail['id'];
            ?>
            <script>
                alert('login Successfully');
                location.replace('index.php');
            </script>
            <?php
        }
        else{
            $wrong=true;
           
        }
    }else{
        $invalid=true;
       
    }
    }
    if ($wrong) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong!</strong> Email or Password did not matched!
        
      </div>';
      }
      if ($invalid) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Invalid!</strong> Invalid Email!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
echo ' <div class="container login">
<h1>Login Here</h1>
<hr>

<form action="login.php" method="POST" enctype="multipart/form-data">


    <div class="mb-3">
      <label for="" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="" placeholder="Enter your email ">
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="" placeholder="Enter your password ">
    </div>
    <button type="submit" name="submit" class="btn btn-lg btn-success">login</button>   
</form>
<strong><span>Not Have An Account?<a href="registration.php"> Register Here</a></span> </strong>
</div>';
?>

<?php

include "footer.php";

?>
