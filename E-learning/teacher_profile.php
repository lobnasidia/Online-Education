<?php
include "connexion.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- teachers profile section starts  -->

<section class="tutor-profile">
<?php
//3- préparation de la requête
$sql = "select * from users where role='tutor' ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);
while($array      = mysqli_fetch_array($exec)){

   $prenom 	= $array['prenom'];
   $role 	= $array['role'];
   $image    = $array['image'];
    ?>
   <h1 class="heading">Profile Details</h1>

   <div class="details">
      <div class="tutor">
         <img src="uploads/<?php echo $image; ?>" alt="">
         <h3><?php echo $prenom ; ?></h3>
         <span><?php echo $role ; ?></span>
      </div>
      <div class="flex">
         <p>total playlists : ------------</span></p>
         <p>total videos : --------------</span></p>
         <p>total likes : --------------</span></p>
         <p>total comments : <span>--------------</span></p>
      </div>
   </div>
   <?php } ?>
</section>

<!-- teachers profile section ends -->

<section class="courses">

<h1 class="heading">Latest courses</h1>

<div class="box-container">
<?php

//3- préparation de la requête
$sql = "select * from course  ORDER BY RAND() LIMIT 4 ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);
while($array      = mysqli_fetch_array($exec)){
$libelle_c 	= $array['libelle_c'];
 $id_c       = $array['id_c'];


 $sql_c = "select * from users where role='tutor' ";

 $exec_c = mysqli_query($conn,$sql_c);
 $array_c      = mysqli_fetch_array($exec_c);
 $nom 	= $array_c['nom'];
 $prenom 	= $array_c['prenom'];
 $image    = $array_c['image'];
?>
   <div class="box">
      <div class="tutor">
         <img src="uploads/<?php echo $image; ?>" alt="">
         <div>
            <h3><?php echo $prenom ; ?></h3>
            <span><?php echo $nom; ?></span>
         </div>
      </div>
      <img src="images/pic-3.jpg" class="thumb" alt="">
      <h3 class="title"><?php echo $libelle_c; ?></h3>
      <a href="playlist.php" class="inline-btn">view playlist</a>
   </div>
   <?php } ?>
</div>

<div class="more-btn">
   <a href="courses.php" class="inline-option-btn">view more</a>
</div>

</section>

<!-- courses section ends -->










<?php include 'footer.php'; ?>    

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>