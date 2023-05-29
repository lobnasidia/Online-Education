<?php
include "connexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

    
  <?php include "header.php"; ?>
    
    <!-- header section ends -->
     
    <!-- side bar section starts  -->
    
    <?php include "sidebar.php"; ?>
    
    <!-- side bar section ends -->

<!-- quick select section starts  -->

<section class="quick-select">

   <h1 class="heading">Quick Options</h1>

   <div class="box-container">

     
   <div class="box tutor">
         <h3 class="title">Become a tutor</h3>
         <p>Becoming a tutor is a rewarding way to share knowledge and support students in their learning journey.</p>
         <a href="register.php" class="inline-btn">get started</a>
      </div>
    
   
 

      <div class="box">
         <h3 class="title">top categories</h3>
         <div class="flex">
            <a href="search_course.php?"><i class="fas fa-code"></i><span>development</span></a>
            <a href="search_course.php?"><i class="fas fa-chart-simple"></i><span>business</span></a>
            <a href="search_course.php?"><i class="fas fa-pen"></i><span>design</span></a>
            <a href="search_course.php?"><i class="fas fa-chart-line"></i><span>marketing</span></a>
            <a href="search_course.php?"><i class="fas fa-music"></i><span>music</span></a>
            <a href="search_course.php?"><i class="fas fa-camera"></i><span>photography</span></a>
            <a href="search_course.php?"><i class="fas fa-cog"></i><span>software</span></a>
            <a href="search_course.php?"><i class="fas fa-vial"></i><span>science</span></a>
         </div>
      </div>

      <div class="box">
         <h3 class="title">popular topics</h3>
         <div class="flex">
            <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
            <a href="#"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
         </div>
      </div>

    

   </div>

</section>

<!-- quick select section ends -->

<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">our courses</h1>

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
    $image_c       = $array['image_c'];


    $sql_c = "select * from users where role='tutor' ";

    $exec_c = mysqli_query($conn,$sql_c);
    $array_c      = mysqli_fetch_array($exec_c);
    $nom 	= $array_c['nom'];
    $prenom 	= $array_c['prenom'];
    $image_u    = $array_c['image'];
?>
      <div class="box">
         <div class="tutor">
            <img src="uploads/<?php echo $image_u; ?>" alt="">
            <div>
               <h3><?php echo $prenom ; ?></h3>
               <span><?php echo $nom; ?></span>
            </div>
         </div>
         <img src="Admin/uploads/<?php echo $image_c; ?>"  class="thumb" alt="">
         <h3 class="title"><?php echo $libelle_c; ?></h3>
         <a href="playlist.php??get_id=<?= $id_c; ?>" class="inline-btn">view playlist</a>
      </div>
      <?php } ?>
   </div>

   <div class="more-btn">
      <a href="courses.php" class="inline-option-btn">view more</a>
   </div>

</section>

<!-- courses section ends -->












<!-- footer section starts  -->
<?php include "footer.php" ; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>