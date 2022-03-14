<?php
$success = false;
$wrong = false;
$exists = false;
include "dbconnection.php";

if (isset($_POST['submit'])) {
    $username = ($_POST['name']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $emailcount = "SELECT * FROM `users` where `email`='$email'";
    $query = $conn->query($emailcount);
    if ($query) {
        // echo "done";
    } else {
        echo "not done";
    }
    $emailcond = mysqli_num_rows($query);
    if ($emailcond > 0) {
        $exists = true;;
    } else {
        if ($password === $cpassword) {
            $insert = "INSERT INTO `users` (`username`, `email`, `password`, `cpassword`) VALUES ('$username', '$email', '$pass', '$cpass')";
            $sql = $conn->query($insert);
            if ($sql) {
                $success = true;
            } else {
                echo "data not insert";
            }
        } else {
            $wrong = true;
        }
    }
}

?>


<?php

include "header.php";

if ($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Congragulation Your Account created successfully!
 
</div>';
}
if ($wrong) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Wrong!</strong> Password did not matched!
  
</div>';
}
if ($exists) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>oops!</strong> Email You Entered Already exists
  
</div>';
}
echo '
<div class="container mt-3 register">
<h1 class="text-center">Register Here</h1>


    <form action="" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" name="name" id=""  placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="password" id="" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" class="form-control" name="cpassword" id="" placeholder="Password">
        </div>
        <button type="submit" name="submit" class="btn btn-success mt-2">Submit</button>
        <strong>Already have an account<a href="login.php"> Login Here</a></strong> 
      </form>
</div>

';
include "footer.php";

?>