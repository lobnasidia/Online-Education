
<div class="side-bar">
    
       <div class="close-side-bar">
          <i class="fas fa-times"></i>
       </div>
    
       <div class="profile">
      
             <img src="uploads/<?php echo  $_SESSION['image']; ?>" alt="">
            

             <h3> <?php echo $_SESSION['nom'].' '.$_SESSION['prenom']; ?></h3>
         
             <span><?php echo  $_SESSION['role']; ?></span>
            
             <a href="profile.php" class="btn">view profile</a>
             
          
            
          </div>
        
       <nav class="navbar">
          <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
          <a href="about.php"><i class="fas fa-question"></i><span>about us</span></a>
          <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
          <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
          <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
       </nav>
     
    </div>