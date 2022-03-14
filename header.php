
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Blogs</title>
    <style>
        .register{
            height: 31.1rem;
        }
        .login{
            height: 31.1rem;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Weak-2-Task</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="create_post.php">Create Posts</a>
        </li>
        <?php
        
        if (isset($_SESSION['username'])) {
            echo ' 
            
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="myposts.php">My Posts</a>
      </li>
            ';
        }else{
            echo '
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
      </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="registration.php">Register</a>
      </li>
            ';
        }
        
        ?>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
              
              if (isset($_SESSION['username'])) {
                   echo $_SESSION['username'];        
              }else{
                   echo '';
              }

              ?>
        
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              
              if (!isset($_SESSION['username'])) {
                  
                  echo '
                 
                  ';
              }else{
                  echo ' 
                 
                  <li><a class="dropdown-item" href="logout.php">logout</a></li>      
                  ';
              }

              ?>
            
          </ul>
        </li>

        </ul>
     
    </div>
  </div>
</nav>




   

