<?php
include "navbar.php";
include "config.php";

// session_start();
// if (!isset($_SESSION["user"])){
//     header("Location: login.php");
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
    <div class="container">
    <?php  
    if(isset($_POST['publish'])){
        $post_id= $_POST['post_id'];
     $title = $_POST['title'];
     $title = filter_var($title, FILTER_SANITIZE_STRING);
     $content = $_POST['content'];
     $content = filter_var($content, FILTER_SANITIZE_STRING);
     $status ="active";

     $image =$_FILES['image'];
    //  $image = filter_var($image,FILTER_SANITIZE_STRING );
     $image_size =$_FILES['image']['size'];
     $image_tmp_name =$_FILES['image']['tmp_name'];
     $image_folder ='../uploads/'.$image;

     $select_image = $con->prepare("SELECT * FROM `posters` WHERE image = ? AND post_id =? ");

     $select_image->execute($image);

     if(isset($image_folder)){
        if($select_image-> rowCount()>0 AND $image !=  ''){
            $message[] = 'image name is repeated';
        }elseif ($image_size >2000000 ){
           $message[] = 'image size is too big';
        }else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
     }else{
        $image =('');
     }

     if($select_image-> rowCount()>0 AND $image !=  ''){
        $message[]= 'please rename your image' ;

     }else{
        $sql =("INSERT * INTO `posters` ( title, content, status, image)) VALUES(?,?,?,?)");
        $stmt = mysqli_stmt_init($con);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, 'ssss', $title, $content, $status, $image);
            mysqli_stmt_execute($stmt);
            echo "Post published successfully";

        }
        else {
           
            die("Connection failed: ");
    
        }
     } 
    }
    
    ?>

    <section class="post-editor " >

        <h3 class="heading"> Admin dashboard</h3>

    <form method="POST" action="admin.php" enctype="multipart/form-data">
        <p>Post title <span>*</span> </p>
        <input type="text" name="title" required placeholder="add post title" maxlength="100" class="box" > </input>

        <p>Post content <span>*</span></p>
        <textarea name="content" class="box" required maxlength="10000" placeholder="write your content......" cols="30" rows="10"   > </textarea>        
       
        <p>Post image <span>*</span></p>
        <input type="file" name="image"  accept="image/jpeg , image/jpg, image/png, image/webp " class="box" >
    

        <div class="flex-btn" > 
            <input type="submit" value="Publish" name="posts" class="btn btn-info" >
            <input type="submit" value="Save draft" name="draft" class="btn btn-warning" >
        </div>
        
    </form>
    </section>
    </div>
</body>

<?php include "footer.php";  ?>