<?php
include "navbar.php";
include "config.php";


$msg= '';
if(isset($_POST['upload'])){
    $image_path =$_FILES['image_path']['name'];
    $upload = "images/" .$image_path;

    // $sql = $con->query("INSERT INTO carousel (image_path) VALUES ($upload)");
    $stmt = $con->prepare("INSERT INTO carousel (image_path) VALUES (?)");
    $stmt->bind_param("s", $upload);
    if ($stmt->execute()) {
    // Success
    $msg = 'Image uploaded successfully!';
    } else {
    // Failure
    $msg = 'Image upload failed!';
     }
      $stmt->close();

      $result = $con->query("SELECT image_path FROM carousel");

     
    // if($sql){
    //     move_uploaded_file($_FILES['image_path']['tmp_name'], $upload);
    //     $msg = 'Image uploaded successfully !';
    // }else {
    //     $msg =' Image upload failed!';
    // }
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
<div class="container-fluid p-2" >
    <div class="row justify-content-center">
    <div class="col-lg-4 bg-dark rounded px-4">
    <h4 class="text-center text-light  p-1" > Select image to upload</h4>
    <form action="carousel.php" method="post" enctype="multipart/form-data" >

        <div class="form-group" >
             <input type="file" name="image_path" class="form-control p-1" required>
        </div>
        <br>
        <div class="form-group text-center" >
             <input type="submit" name="upload" class="btn- btn-info btn-block" value="Upload image">
        </div>
       <div class="form-group" >
        <h5 class="text-center text-light" > <?=$msg; ?> </h5>
       </div>

    </form>
    </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery.3.4.1/jquery.min.js" > </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrap.cdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>

<!-- <?php include "footer.php";  ?> -->