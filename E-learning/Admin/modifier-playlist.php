<?php 
include "connexion.php";

$id=$_GET['id'];
if(isset($_POST['envoyer'])){
    $libelle        = addslashes($_POST['title']);
    $description    = addslashes($_POST['description']);
    $iduser         = $_POST['id_user'];
    $date           = addslashes($_POST['date']);
    



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

    $sql = "UPDATE `playlist` SET  `id_user`='$iduser',`title`='$libelle',`description`='$description',`thumb`='$newFileName', `date`='$date' WHERE id_p=$id ";  
  }
  else
  {
    $sql = "UPDATE `playlist` SET  `title`='$libelle',`description`='$description',`id_user`='$iduser' WHERE id_p=$id ";
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }



    //4- exécution de la requête
    $exec = mysqli_query($conn,$sql);

    header('location:playlist.php');
}
?>
<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en" dir="ltr">
  <head>
  <?php include "head.php"; ?>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
   

    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
        <?php include "sidebar.php"; ?>
        </aside>

      

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
        
          <!-- Header -->
          <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <?php include "navbar.php"; ?>
            </nav>


          </header>

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content"><!-- Card Profile -->

          <div class="col-lg-8 col-xl-9 col-xxl-10">
        <div class="email-right-column  email-body p-4 p-xl-5">
          <div class="email-body-head mb-5 ">
            <h4 class="text-dark">Modify Playlist</h4>
          </div>
          <?php


//3- préparation de la requête
$sql = "select * from playlist  where id_p=$id ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);

 
	 
$array      = mysqli_fetch_array($exec);
	$libelle_p 	= $array['title'];
	$desc_p     = $array['description'];
    $thumb    = $array['thumb'];
    $date    = $array['date'];
    $id_p       = $array['id_p'];

 

?>
          <form class="email-compose" action="" method="POST" enctype="multipart/form-data">

            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name" >Title: </label>
              <input type="text" class="form-control" id="exampleEmail" name="libelle" placeholder="Enter title"  value="<?php echo $libelle_p; ?>">
            </div>
            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Description: </label>
            <textarea name="description" required  id="basic-default-message"  class="form-control"  placeholder="Write description"  aria-label="Description" aria-describedby="basic-icon-default-message2" ><?php echo $desc_p; ?></textarea>
              
            </div>
            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">thumb: </label>
            <input type="file"  class="box" id="basic-default-name" placeholder="Thumb" name="uploadedFile" />
            <p><img src="uploads/<?php echo $thumb; ?>" alt="<?php echo $libelle_p; ?>" style="width:200px" /></p>
      
            </div>

            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name" >Date: </label>
              <input type="text" class="form-control" id="exampleEmail" name="date" placeholder="Enter title"  value="<?php echo $date; ?>">
            </div>
           
          <button class="btn btn-primary btn-pill mb-5" type="submit" name="envoyer">Upload</button>
           
          </form>
          
        </div>
      </div>



                
</div>
          
        </div>
        
          <!-- Footer -->
          <footer class="footer mt-auto">
          <?php include "footer.php"; ?>
          </footer>

      </div>
    </div>
    
                   



    
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

                    
                    
                    <script src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                    
                    
                    
                    <script src="plugins/apexcharts/apexcharts.js"></script>
                    
                    
                    <script src="js/mono.js"></script>
                    <script src="js/chart.js"></script>
                    <script src="js/map.js"></script>
                    <script src="js/custom.js"></script>

                    


                    <!--  -->


  </body>
</html>
