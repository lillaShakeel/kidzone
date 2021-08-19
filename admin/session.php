<?php
include_once "dbc.php";
session_start();
if(!isset($_SESSION['admin'])){
	header('location:index.php');
	
}
$sql="select * from admin where username='".$_SESSION['admin']."'";
$result=mysqli_query($con,$sql);
$admin=mysqli_fetch_array($result);


?>