<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="css/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>




<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-20 text-secondary">Home</a></li>
          <li><a href="myplaylist.php" class="nav-link px-20 text-white">Playlist</a></li>
          <li><a href="explore.php" class="nav-link px-20  text-white">Explore</a></li>
        </ul>

        <!--<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>-->
        <?php
        if(isset($_SESSION['userid']))
        { ?>

          <div class="text-end">
          <a href="signout.php"><button type="button" class="btn btn-danger">Sign-out</button></a>
        </div>


        <?php } else {?>

        <div class="text-end">
          <a href="login.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
          <a href="signup.php"><button type="button" class="btn btn-warning">Sign-up</button></a>
        </div>
      <?php } ?>


      </div>
    </div>
  </header>
  <div class="b-example-divider"></div>
