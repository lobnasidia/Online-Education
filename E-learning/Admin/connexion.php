<?php
session_start();
if($_SESSION['auth2']==false){
	header("location:index.php");
}
$conn = mysqli_connect('localhost','root','','web');

