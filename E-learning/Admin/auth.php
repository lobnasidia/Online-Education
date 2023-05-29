<?php
//1 récupération des variables
$log 	= $_POST['email-username'];
$pass 	= $_POST['password'];
$role 	= $_POST['role'];

//2- connexion au serveur + base de donné
$conn = mysqli_connect('localhost','root','','web');

//3- préparation de la requête
$sql = "select * from users where (email='$log' or tel='$log') and motdepasse='$pass' and role ='tutor' ";
//echo $sql;

//4- exécution de la requête
$exec = mysqli_query($conn,$sql);

//5- vérification
$num = mysqli_num_rows($exec);
if($num == 1){
	session_start();
	$_SESSION['auth2']=true;
	
	$array = mysqli_fetch_array($exec);
	$nom 	= $array['nom'];
	$prenom = $array['prenom'];
	$role = $array['role'];
	
	$_SESSION['nom'] = $nom;
	$_SESSION['prenom'] = $prenom;
	$_SESSION['role'] = $role;

	header("location:dashboard.php");
	echo "bienvenu sur votre espace admin $nom $prenom";
}else{
	header("location:index.php?error=1");
	echo "merci de vérifier vos accès";
}

?>