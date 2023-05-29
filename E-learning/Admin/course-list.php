<?php
include "connexion.php";


if(isset($_GET['id'])){
    //1 récupération des variables
$id =   $_GET['id'];


//3- préparation de la requête
$sql = "DELETE FROM `course` WHERE id_c=$id ";
//echo $sql;

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

          <div class="col-lg-12 col-xl-12 col-xxl-12">
          <div class="container-xxl flex-grow-1 container-p-y">
          <div class="email-body-head mb-5 ">
            <h4 class="text-dark">Your Contents</h4>
          </div>

          <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Bootstrap Table -->
                        <div class="card">
                            
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Video</th>
                                            <th>Thumbnail</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php

//3- préparation de la requête
$sql = "select * from course   ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);

 
	 
	while($array      = mysqli_fetch_array($exec)){
	$libelle_c 	= $array['libelle_c'];
	$desc_c    = $array['desc_c'];
    $video_c    = $array['video_c'];
    $image_c    = $array['image_c'];
    $id_c      = $array['id_c'];
 
 

?>
                                        <tr>
                                            <td><?php echo $id_c; ?></td>
                                            <td><?php echo $libelle_c; ?></td>
                                            <td><?php echo substr($desc_c, 0, 40) ; ?> ...</td>

                                            <td>
                                                <video width="100" height="100" controls>
                                                <source src="uploads/<?php echo $video_c; ?>" type="video/mp4"> 
                                                </video> 
                                            </td>
                                            <td>
                                              <img src="uploads/<?php echo $image_c; ?>" alt="<?php echo $libelle_c; ?>" style="width:120px" />
                                            </td>
                                            <td>
                                            <a class="text-blue" href="modifier-course.php?id=<?php echo $id_c; ?>">Edit</a>
                                            </td>
                                            <td>
                                            <a class="text-blue"  href="?id=<?php echo $id_c; ?>">Delete</a>  
                                            </td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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
