<?php 
include "connexion.php";
function categoryTree($parent_id = 0, $sub_mark = ''){
    global $conn;
    $query = $conn->query("SELECT * FROM course WHERE id_parent = $parent_id ORDER BY libelle_c ASC");
   
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['id_c'].'">'.$sub_mark.$row['libelle_c'].'</option>';
            categoryTree($row['id_c'], $sub_mark.'-');
        }
    }
}

if(isset($_POST['envoyer'])){
    $id_parent      = $_POST['id_parent'];
    $libelle        = addslashes($_POST['libelle']);
    $description    = addslashes($_POST['description']);
    $playlist_id    = addslashes($_POST['playlist_id']);



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
    $allowedfileExtensions = array('mp4', 'avi', 'mov', 'flv', 'wmv','jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
   
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


  if (isset($_FILES['uploadedFilevideo']) && $_FILES['uploadedFilevideo']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file 
    $fileTmpPath = $_FILES['uploadedFilevideo']['tmp_name'];
    $fileName = $_FILES['uploadedFilevideo']['name'];
    $fileSize = $_FILES['uploadedFilevideo']['size'];
    $fileType = $_FILES['uploadedFilevideo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name 
    $newFileNamevideo = md5(time() . $fileName) . '.' . $fileExtension;
    // check if file has one of the following extensions 
    $allowedfileExtensions = array('mp4', 'avi', 'mov', 'flv', 'wmv');
   
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved 
      $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $newFileNamevideo;
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
  

    //3- préparation de la requête
    $sql = "INSERT INTO `course`( `libelle_c`, `desc_c`, `video_c`, `id_parent`,`image_c`, `playlist_id`) 
    VALUES ('$libelle','$description','$newFileNamevideo','$id_parent','$newFileName','$playlist_id')";
   // echo $sql;

    //4- exécution de la requête
    $exec = mysqli_query($conn,$sql);

    header('location:course-list.php');
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
            <h4 class="text-dark">New Content</h4>
          </div>
          <form class="email-compose" action="" method="POST" enctype="multipart/form-data">
          <div class="col-sm-10">
          <select class="form-control" name="id_parent">
               <option value="0">Development</option>
               <option value="1">Design</option>
               <option value="2">Business</option>
               <option value="3">Marketing</option>
               <option value="4">Science</option>
               <option value="5">Music</option>
               <option value="6">Photography</option>
               <?php categoryTree(); ?>
            </select>
         
            </div>
            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name" >Video Title: </label>
              <input type="text" class="form-control" id="exampleEmail" name="libelle" placeholder="Enter Video title">
            </div>
            <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Description: </label>
            <textarea name="description" required  id="basic-default-message"  class="form-control"  placeholder="Write description"  aria-label="Description" aria-describedby="basic-icon-default-message2" ></textarea>
              
            </div>
            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-default-name">Playlist: </label>
                                                <div class="col-sm-10">
                                                    <select name="playlist_id" class="form-control">
                                                        <?php

                                                          //3- préparation de la requête
                                                          $sql = "select * from playlist  ";
                                                          //echo $sql;

                                                          //4- exécution de la requête
                                                          $exec = mysqli_query($conn,$sql);

                                                          
                                                            
                                                            while($array      = mysqli_fetch_array($exec)){
                                                            $title 	= $array['title'];
                                                            $id_p      	= $array['id_p'];
                                                          
                                                          

                                                          ?>
                                                        <option value="<?php echo $id_p; ?>"><?php echo $title; ?> </option>

                                                        <?php } ?>

                                                    </select>

                                                </div>
                                            </div>
            
          

            <div class="row mb-3">
              <label class="col-sm-5 col-form-label" for="basic-default-name">Video: </label>
              <div class="col-sm-12">
              <input type="file"  class="form-control" id="exampleEmail" placeholder="Video" name="uploadedFilevideo" />
            </div>

            <div class="row mb-3">
              <label class="col-sm-5 col-form-label" for="basic-default-name">Thumbnail: </label>
              <div class="col-sm-12">
              <input type="file" required class="form-control" id="exampleEmail" placeholder="Image" name="uploadedFile" />
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
