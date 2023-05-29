<?php
include "connexion.php"; 
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:home.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlist</title>

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

<!-- playlist section starts  -->

<section class="playlist">

   <h1 class="heading">playlist details</h1>

   <div class="row">

      <?php
    $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE id_p = ?  LIMIT 1");
    $select_playlist->bind_param("i", $get_id); // bind parameter
    $select_playlist->execute();
    $select_playlist_result = $select_playlist->get_result(); // get result set
    if($select_playlist_result->num_rows > 0){
        $fetch_playlist = $select_playlist_result->fetch_assoc();

        $playlist_id = $fetch_playlist['id_p'];

        $count_videos = $conn->prepare("SELECT * FROM `course` WHERE playlist_id = ?");
        $count_videos->bind_param("i", $playlist_id); // bind parameter
        $count_videos->execute();
        $count_videos_result = $count_videos->get_result(); // get result set
        $total_videos = $count_videos_result->num_rows;

        $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id_u = ? and role ='tutor' LIMIT 1");
        $select_tutor->bind_param("i", $fetch_playlist['id_user']); // bind parameter
        $select_tutor->execute();
        $select_tutor_result = $select_tutor->get_result(); // get result set
        $fetch_tutor = $select_tutor_result->fetch_assoc();
    
?>


      <div class="col">
         <form action="" method="post" class="save-list">
            <input type="hidden" name="list_id" value="<?= $playlist_id; ?>">
           
         </form>
         <div class="thumb">
            <span><?= $total_videos; ?>Videos </span>
            <img src="Admin/uploads/<?= $fetch_playlist['thumb']; ?>" alt="">
         </div>
      </div>

      <div class="col">
         <div class="tutor">
            <img src="uploads/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['nom']; ?></h3>
               <span><?= $fetch_tutor['prenom']; ?></span>
            </div>
         </div>
         <div class="details">
            <h3><?= $fetch_playlist['title']; ?></h3>
            <p><?= $fetch_playlist['description']; ?></p>
            <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
         </div>
      </div>

      <?php
         }else{
            echo '<p class="empty">this playlist was not found!</p>';
         }  
      ?>

   </div>

</section>

<!-- playlist section ends -->

<!-- videos container section starts  -->

<section class="videos-container">

   <h1 class="heading">playlist videos</h1>

   <div class="box-container">

   <?php
    $select_content = $conn->prepare("SELECT * FROM `course` WHERE playlist_id = ?  ");
    $select_content->bind_param("i", $get_id); // bind parameters
    $select_content->execute();
    $select_content_result = $select_content->get_result(); // get result set
    if($select_content_result->num_rows > 0){
        while($fetch_content = $select_content_result->fetch_assoc()){  
?>



      <a href="watch-video.php?get_id=<?= $fetch_content['id_c']; ?>" class="box">
         <i class="fas fa-play"></i>
         <img src="Admin/uploads/<?= $fetch_content['image_c']; ?>" alt="">
         <h3><?= $fetch_content['libelle_c']; ?></h3>
      </a>
      <?php
            }
         }else{
            echo '<p class="empty">no videos added yet!</p>';
         }
      ?>

   </div>

</section>

<!-- videos container section ends -->












<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>