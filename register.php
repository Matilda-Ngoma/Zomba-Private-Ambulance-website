<?php
include "navbar.php";
include "config.php";

session_start();
if (isset($_SESSION["user"])){
    header("Location: admin.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
 if(!$con = new mysqli("localhost", "root", "", "zpa"))
{
  die("Connection failed: " . $con->connect_error);

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zomba Private Ambulances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin_style.css"/>
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
    if (isset($_POST['register'])){
      // $userid =$_POST['$userid'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
      $errors = array();
       if(empty($name) OR empty($phone) OR empty($email) OR empty($password) OR empty($confirm_password)){
           array_push($errors, "All fields are required");
          }
    
          $phone = "1234567890"; // Example phone number

          $pattern = "/^\d{10}$/"; // Pattern to match a 10-digit phone number

          if (preg_match($pattern, $phone)) {
            //  echo "Valid phone number";
           } 

      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
      }
    
        if(strlen($password) <8){
          array_push($errors, "Password must be atleast 8 characters long");
          }
    
         if($password !==$confirm_password){
           array_push($errors, "Password does not match");
          }
      }
      require_once "config.php";
      $sql = "SELECT * FROM users WHERE email ='$email' ";
      $result = mysqli_query($con, $sql);
      $rowCount =mysqli_num_rows($result);
      if($rowCount>0){
        array_push($errors, "Email already exists");
      }


      if(count($errors)>0){
        foreach($errors as $errors){
          echo "<div class='alert, alert-danger'> $errors </div>";
        }
      }else{
        //insert data into database
        $sql= "INSERT into `users` (name, phone, email, password, confirm_password)
        VALUES (?,?,?,?,?) ";
        $stmt = mysqli_stmt_init($con);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if($prepareStmt){
          mysqli_stmt_bind_param($stmt, 'sssss',$name, $phone, $email, $passwordHash, $confirm_password);
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'>User successfully registered </div>";

        }
        else {
          die("Connection failed: " . $con->connect_error);
        }
      }
      }
    
    ?>
<form action="register.php" method="post">

<div class=" form-group justify-content-center p-3">
 <h3>Registration</h3>
</div>

  <div class="container border border-success                                              " >
<div class="mb-4">
  <label for="formGroupExampleInput" class="form-label">Full Name</label>
  <div class="col-md-6" >
  <input type="text" class="form-control" name="name" placeholder="Enter your name" >
  </div>
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Phone</label>
  <div class="col-md-6" >
  <input type="number" class="form-control" name="phone" placeholder="Enter phone number" >
</div>
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Email</label>
  <div class="col-md-6" >
  <input type="varchar" class="form-control" name="email" placeholder="Enter email" >
</div>
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Password</label>
  <div class="col-md-6" >
  <input type="number" class="form-control" name="password" placeholder="Enter password">
</div>
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Confirm password</label>
  <div class="col-md-6" >
  <input type="number" class="form-control" name="confirm_password" placeholder="Confirm password" >
</div>
</div>

<div class="">
    <button type="submit" name="register" class="btn btn-primary">Register</button>
  </div>

  </div>
    </div>
</form>
</div>
</body>
</html>

<?php include "footer.php"; ?>