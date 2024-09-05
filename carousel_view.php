
<?php 
 include "config.php";

 


 // Assuming you want to select the image_path from the carousel table
$sql = "SELECT image_path FROM carousel";
$result = $con->query($sql);

// Check if the query executed successfully before using $result in the loop
if (!$result) {
    // Handle the error
    die("Error fetching data from the database: " . $con->error);
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
      <!-- //carousel  -->
      <div class="container-fluid p-3">
        <section class="card" >
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <ul class="carousel-indicators" >
             <?php  
               $i =0;
               foreach($result as $row ){
                $actives = '';
                if($i ==0){
                  $actives = 'active';
                }
              
             ?>
             <li data-target="#demo" data-slide-to="<?= $i; ?>"class="<?=$actives ?>" ></li>
             <?php  $i++;  }?>
        </ul>

        <div class="carousel-inner">
    <?php
    $i = 0;
    foreach ($result as $row) {
        $actives = ($i == 0) ? 'active' : '';
    ?>
        <div class="carousel-item <?= $actives ?>">
            <img src="<?= $row['image_path'] ?>" width="100%" height="400">
        </div>
    <?php
        $i++;
    }
    ?>
</div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>

</div>
    </section>
</body>