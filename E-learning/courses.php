<?php
include "connexion.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Courses</title>

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
        <section class="courses">

<h1 class="heading">all courses</h1>

<div class="box-container">

<?php
    $select_courses = $conn->prepare("SELECT * FROM `playlist`  ORDER BY date DESC");
    $select_courses->execute();
    $select_courses_result = $select_courses->get_result(); // get result set
    if($select_courses_result->num_rows > 0){
        while($fetch_course = $select_courses_result->fetch_assoc()){
            $course_id = $fetch_course['id_p'];

            $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id_u = ? and role='tutor' ");
            $tutor_id = $fetch_course['id_user']; // get tutor_id from fetch_course
            $select_tutor->bind_param("i", $tutor_id); // bind parameter
            $select_tutor->execute();
            $select_tutor_result = $select_tutor->get_result(); // get result set
            $fetch_tutor = $select_tutor_result->fetch_assoc();
?>

   <div class="box">
      <div class="tutor">
         <img src="uploads/<?= $fetch_tutor['image']; ?>" alt="">
         <div>
            <h3><?= $fetch_tutor['nom']; ?></h3>
            <span><?= $fetch_course['date']; ?></span>
         </div>
      </div>
      <img src="Admin/uploads/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
      <h3 class="title"><?= $fetch_course['title']; ?></h3>
      <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">view playlist</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no courses added yet!</p>';
   }
   ?>

</div>

</section>





<?php include 'footer.php'; ?>
        <!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>