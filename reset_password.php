<?php
include('header.php');
$id=$_REQUEST['id'];
$message="";
if(!isset($_REQUEST['id']) && $id==''){
	header('location:index');
}
?>
<div class="container my-5">
<div class="row">
<div class="col-md-5 m-auto">
<div class="card mt-5">
<div class="card-body">
<h3 class="text-center pt-2 pb-3">Reset Password</h3>
<form method="post" class="form-group">
<div class="form-group mb-2">
<label>New Password</label>
<input type="password" name="password" required class="form-control" data-toggle="password">
</div>
<div class="form-group mb-2">
<label>Confirm Password</label>
<input type="password" name="confirmpassword" required class="form-control" data-toggle="password">
</div>
<input type="submit" name="submit" value="Change Password" class="btn btn-info btn-block mt-4 mb-3">
</form>
</div>
</div>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['submit'])){
	$password=$_POST['password'];
	$confirmpassword=$_POST['confirmpassword'];
	if($password==$confirmpassword){
		$password=md5($password);
		$sql="update customer set password='$password' where id='$id'";
		$result=mysqli_query($con,$sql);
		if($result){
			$title="Successfully";
			$message="Password changed successfully";
			$icon="success";
			$page="login";	
			include "message.php";
		}
		else{
			
			$title="Warning";
			$message="Something went wrong";
			$icon="error";
			$page="reset_password";	
			include "message.php";
		}
		
	}
	else{
		$title="Warning";
		$message="Confirm Password not match";
		$icon="warning";
		$page="forgot_password";	
		include "message.php";
		
	}
}
?>