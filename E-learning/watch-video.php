<?php include "connexion.php" ;

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
   <title>Watch</title>

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


<!-- watch video section starts  -->

<section class="watch-video">

<?php
    $select_content = $conn->prepare("SELECT * FROM `course` WHERE id_c = ? ");
    $select_content->bind_param("i", $get_id); // bind parameters
    $select_content->execute();
    $select_content_result = $select_content->get_result(); // get result set
    if($select_content_result->num_rows > 0){
        while($fetch_content = $select_content_result->fetch_assoc()){
            $content_id = $fetch_content['id_c'];

            $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id_u = ? and role = 'tutor' LIMIT 1");
            $select_tutor->bind_param("i", $fetch_content['id_user']); // bind parameter
            $select_tutor->execute();
            $select_tutor_result = $select_tutor->get_result(); // get result set
            $fetch_tutor = $select_tutor_result->fetch_assoc();
        
    
?>


<div class="video-details">
      <video src="Admin/uploads/<?= $fetch_content['video_c']; ?>" class="video" poster="Admin/uploads/<?= $fetch_content['image_c']; ?>" controls autoplay></video>
      <h3 class="title"><?= $fetch_content['libelle_c']; ?></h3>
      <div class="info">
         <p><i class="fas fa-calendar"></i><span>date</span></p>
         <p><i class="fas fa-heart"></i><span> likes</span></p>
      </div>
      <!--<div class="tutor">
            <img src="uploads/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['nom']; ?></h3>
               <span><?= $fetch_tutor['prenom']; ?></span>
            </div> 
         </div> -->
      <form action="" method="post" class="flex">
         <input type="hidden" name="content_id" value="<?= $content_id; ?>">
         <a href="playlist.php?get_id=<?= $fetch_content['playlist_id']; ?>" class="inline-btn">view playlist</a>
         <button type="submit" name="like_content"><i class="fas fa-heart"></i><span>liked</span></button>
         <button type="submit" name="like_content"><i class="far fa-heart"></i><span>like</span></button>
      <div class="description"><p><?= $fetch_content['desc_c']; ?></p></div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>
</section>

<!-- watch video section ends -->

<!-- comments section starts  -->

<section class="comments">

   <h1 class="heading">add a comment</h1>

   <form action="" method="post" class="add-comment">
      <input type="hidden" name="content_id" >
      <textarea name="comment_box" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
      <input type="submit" value="add comment" name="add_comment" class="inline-btn">
   </form>

   <h1 class="heading">user comments</h1>

   
   <div class="show-comments">
     
      <div class="box" >
         <div class="user">
            <img src="images/pic-2.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <span>Hello everyone</span>
            </div>
         </div>
         <p class="text"></p>
        
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" >
            <button type="submit" name="edit_comment" class="inline-option-btn">edit comment</button>
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('delete this comment?');">delete comment</button>
         </form>
       
      </div>
      
      </div>
   
</section>

<!-- comments section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>