<?php
include "connexion.php";
if(isset($_POST['signup'])){
   $nom 	= $_POST['nom'];
   $prenom = $_POST['prenom'];
   $tel 	= $_POST['tel'];
   $email 	= $_POST['email'];
   $pass 	= $_POST['pass'];
   $role 	= $_POST['role'];
   if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
   {
     // get details of the uploaded file 
     $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
     $fileName = $_FILES['uploadedFile']['name'];
     $fileSize = $_FILES['uploadedFile']['size'];
     $fileType = $_FILES['uploadedFile']['type'];
     $fileNameCmps = explode(".", $fileName);
     $fileExtension = strtolower(end($fileNameCmps));
     // sanitize file-name 
     $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
     // check if file has one of the following extensions 
     $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
     if (in_array($fileExtension, $allowedfileExtensions))
     {
       // directory in which the uploaded file will be moved 
       $uploadFileDir = './uploads/';
       $dest_path = $uploadFileDir . $newFileName;
       if(move_uploaded_file($fileTmpPath, $dest_path)) 
       {
         $message ='File is successfully uploaded.';
       }
       else 
       {
         $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
       }
     }
     else
     {
       $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
     }
   }
   else
   {
     $message = 'There is some error in the file upload. Please check the following error.<br>';
     $message .= 'Error:' . $_FILES['uploadedFile']['error'];
   }
 
   $query = "INSERT INTO `users`(`nom`, `prenom`, `email`, `motdepasse`, `tel`, `role`, `image`) 
   VALUES ('$nom','$prenom','$email','$pass','$tel','$role','$newFileName')";
   
   $execution = mysqli_query($conn,$query);
   
   session_start();
   $_SESSION['authfo']=true;
   
   $_SESSION['nom'] = $nom;
   $_SESSION['prenom'] = $prenom;
   $_SESSION['role'] = $role;
   
   header('location:home.php');
}  
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign up</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>


<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
            <p>First Name </p>
            <input type="text" name="nom" placeholder="enter your name" maxlength="50" required class="box">
            <p>Last Name </p>
            <input type="text" name="prenom" placeholder="enter your last name" maxlength="50" required class="box">
            <p>Email </p>
            <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
         </div>
         <div class="col">
         <p>Phone Number</p>
            <input type="text" name="tel" placeholder="enter your phone number" maxlength="50" required class="box">
            <p>Password </p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
            <p>Role</p>
         
            <select class="box" name="role">
               <option value="student">Student</option>
               <option value="tutor">Tutor</option>
            </select>
         </div>
      </div>
      <p>Select Pic </p>
      <input type="file" required class="box" id="basic-default-name" placeholder="Image" name="uploadedFile" />
    
      <p class="link">already have an account? <a href="index.php">login now</a></p>
      <input type="submit" name="signup" value="register now" class="btn">
   </form>

</section>












<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>