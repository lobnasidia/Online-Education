<?php
include "connexion.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teachers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include "header.php" ; ?>
        
        <!-- header section ends -->
         
        <!-- side bar section starts  -->
        
        <?php include "sidebar.php" ; ?>
        
        <!-- side bar section ends -->

       

<!-- teachers section starts  -->

<section class="teachers">

<h1 class="heading">Expert Tutors</h1>
   <div class="box-container">

</div>

   <form action="search_tutor.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

      <div class="box-container">
      <?php
//3- préparation de la requête
$sql = "select * from users where role='tutor' ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);
while($array      = mysqli_fetch_array($exec)){
   $nom 	= $array['nom'];
   $prenom 	= $array['prenom'];
   $email 	= $array['email'];
   $image    = $array['image'];
    ?>
      <div class="box">
         <div class="tutor">
            <img src="uploads/<?php echo $image; ?>"  alt="">
            <div>
               <h3><?php echo $prenom ; ?></h3>
               <span><?php echo $nom; ?></span>
            </div>
         </div>
         <p>playlists : -------------</span></p>
         <p>total videos : ------------</span></p>
         <p>total likes : <----------</span></p>
         <p>total comments : ---------</span></p>
         <form action="teacher_profile.php" method="post">
            <input type="hidden" name="tutor_email" value="<?php echo $email ; ?>">
            <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
         </form>
      </div>
      <?php } ?>

   </div>

</section>

<!-- teachers section ends -->






























<?php include 'footer.php'; ?>    


        <!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>