<?php
include "navbar.php";
include "config.php";

// session_start();
// if (isset($_SESSION["user"])){
//     header("Location: admin.php");
// }
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zomba Private Ambulances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css"/>
    <link rel="stylesheet" href="bootstrap-5.0.0/css/bootstrap.min.css"/>
    <style>
        body {
            background-image: url("your-image-url.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            margin-top: 90px;
        }
        
        @media (max-width: 767.98px) {
            .center-mobile {
                display: flex;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
  <div class="container" >
    <?php 
      if(isset($_POST['login'])){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      require_once "config.php";
      $sql =" SELECT * FROM users WHERE email ='$email' ";
      $result= mysqli_query($con, $sql);
      $user =mysqli_fetch_array($result, MYSQLI_ASSOC);
      if($user){
        if(password_verify($password, $user["password"])){
          session_start();
          $_SESSION['user'] ="yes";
          header("Location: admin.php");
          die();
        }else {
          echo "<div class='alert alert-danger'>Email does not match </div>";

        }
      }else{
        echo "<div class='alert alert-danger'>Password does not match </div>";

       }
      }
    ?>
<form action="login.php" method="post">
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Name</label>
  <input type="text" class="form-control" name="name" placeholder="Example input placeholder">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Email</label>
  <input type="text" class="form-control" name="email" placeholder="Example input placeholder">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Password</label>
  <input type="text" class="form-control" name="password" placeholder="Example input placeholder">
</div>

<div class="">
    <button type="submit" value="login" name="login" href="admin.php" class="btn btn-primary">Log in</button>
  </div>
</form>
  </div>
</body>

<?php include "footer.php";   ?>