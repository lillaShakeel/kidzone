<?php
session_start();
if(isset($_SESSION['admin'])){
	header('location:home.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>kidZone</title>
<meta name="viewport" content="device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/sweetalert.min.js"></script>
<script src="../js/bootstrap-show-password.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
<div class="section">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2 class="text-center text-white">kidZone Online Toy Shop</h2>
</div>
<div class="col-md-5 m-auto">
<div class="card">
<div class="card-body">
<form method="post">
<label>Username</label>
<input type="text" name="username" class="form-control mb-2">
<label>Password</label>
<input type="password" name="password" class="form-control" data-toggle="password">
<button type="submit" name="submit" class="btn btn-info mt-4">Login <i class="fa fa-sign-in"></i></button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<?php
include_once "dbc.php";
if(isset($_POST['submit'])){
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$sql="select * from admin where username='$username' AND password='$password'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	if($row){
		$_SESSION['admin']=$username;
		header('location:home.php');
	}
	else{
		$title="Warning";
		$message="Invalid email or password";
		$icon="warning";
		$page="index.php";	
		include "message.php";
	}
	
	
}

?>