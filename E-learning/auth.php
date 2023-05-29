<?php
 $log 	= $_POST['email'];
 $pass 	= $_POST['password'];
 

 
$conn = mysqli_connect('localhost','root','','web');
 //3- préparation de la requête
 $sql = "select * from users where (email='$log' or tel='$log') and motdepasse='$pass' ";
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
    header("location:index.php?error=1");
    echo "merci de vérifier vos accès";
 }
 
 
?>