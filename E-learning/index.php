<?php
include "connexion.php"; 
if(isset($_POST['signin'])){
   //1 récupération des variables
   $log 	= $_POST['email'];
   $pass 	= $_POST['password'];
   
   //3- préparation de la requête
   $sql = "select * from users where (email='$log' or tel='$log') and motdepasse='$pass'  ";
   //echo $sql;
   
   //4- exécution de la requête
   $exec = mysqli_query($conn,$sql);
   
   //5- vérification
   $num = mysqli_num_rows($exec);
   if($num == 1){
      session_start();
      $_SESSION['authfo']=true;
      
      $array = mysqli_fetch_array($exec);
      $nom 	= $array['nom'];
      $image 	= $array['image'];
      $prenom = $array['prenom'];
       $role = $array['role'];
      $id_u = $array['id_u'];
       
      $_SESSION['nom']    = $nom;
      $_SESSION['prenom'] = $prenom;
       $_SESSION['role']   = $role;
       $_SESSION['image']   = $image;
       $_SESSION['id_u']   = $id_u;

       
      header("location:home.php");
      echo "bienvenu sur votre espace admin $nom $prenom";
   }else{
      $message[] = 'incorrect email or password!';
   }
   
   }




?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log In</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="form-container">

   <form action="auth.php" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" maxlength="20" required class="box">
      <p class="link">don't have an account? <a href="register.php">register now</a></p>
      <input type="submit" name="signin" value="login now" class="btn">
   </form>

</section>












<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>