<header class="header">
    
    <section class="flex">
 
       <a href="home.html" class="logo">Online Grow</a>
 
       <form action="search_course.php" method="post" class="search-form">
          <input type="text" name="search_course" placeholder="search courses..." required maxlength="100">
          <button type="submit" class="fas fa-search" name="search_course_btn"></button>
       </form>
 
       <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="search-btn" class="fas fa-search"></div>
          <div id="user-btn" class="fas fa-user"></div>
          <div id="toggle-btn" class="fas fa-sun"></div>
       </div>

       <div class="profile">
  
          <img src="uploads/<?php echo $_SESSION['image']; ?>" alt="">
        
          <h3><?php echo $_SESSION['nom'].' '.$_SESSION['prenom']; ?></h3>
          <span><?php echo  $_SESSION['role'];  ?></span>
         
          <a href="profile.php" class="btn">view profile</a>
          <div class="flex-btn">
             <a href="index.php" class="option-btn">login</a>
             <a href="register.php" class="option-btn">register</a>
          </div>
          <a href="logout.php" onclick="" class="delete-btn">logout</a>
         
    
       
       </div>
 
    </section>
 
 </header>