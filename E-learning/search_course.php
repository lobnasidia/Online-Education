<?php

include "connexion.php";

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
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


<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">search results</h1>

   <div class="box-container">
   <?php
if (isset($_POST['search_course']) || isset($_POST['search_course_btn'])) {
    $search_course = $_POST['search_course'];

    // Assuming you have already established a mysqli connection
    $stmt = $conn->prepare("SELECT * FROM `playlist` WHERE title LIKE ? ");

    // Create a search term with wildcard
    $search_term = '%' . $search_course . '%';

    // Bind the parameters to the prepared statement
    $stmt->bind_param("s", $search_term);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if there are any matching courses
    if ($result->num_rows > 0) {
        while ($fetch_course = $result->fetch_assoc()) {
            $course_id = $fetch_course['id_p'];

            // Retrieve tutor information for the course
            $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE role ='tutor' AND id_u = ? ");
            
            // Bind the tutor ID parameter to the prepared statement
            $select_tutor->bind_param("i", $fetch_course['id_user']);
            
            // Execute the prepared statement
            $select_tutor->execute();
            
            // Get the result set for tutor information
            $result_tutor = $select_tutor->get_result();
            
            // Fetch the tutor details
            $fetch_tutor = $result_tutor->fetch_assoc();
        
    

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
         echo '<p class="empty">no courses found!</p>';
      }
      }else{
         echo '<p class="empty">please search something!</p>';
      }
      ?>

   </div>

</section>

<!-- courses section ends -->










<?php include "footer.php" ; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>