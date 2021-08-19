<?php
include('header.php');
?>
<div class="container my-5">
<div class="row">
<div class="col-md-5 m-auto">
<div class="card mt-5">
<div class="card-body">
<div class="text-center">
<img src="user.png" class="user-img mt-3">
</div>
<h3 class="text-center pt-2">Sign In</h3>
<form method="post" class="form-group">
<div class="form-group">
<label>Email</label>
<input type="email" name="email" required class="form-control mb-3">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" required class="form-control" data-toggle="password">
</div>
<input type="submit" name="login" value="Sign In" class="btn btn-info btn-block mt-4 mb-3">
<input type="checkbox" name="remember"> Remember Me
<a href="<?php echo FRONT_SITE_PATH?>forgot_password"><span class="float-right text-info">Forgot Password?</span></a>
</form>
</div>
<div class="card-footer">
<p class="text-center">Not a member? <span class="text-info"><a href="<?php echo FRONT_SITE_PATH?>register" class="text-decoration-none">Create an account</a></span></p>
</div>
</div>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql="select * from customer where email='$email' and binary password='$password'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	if(mysqli_num_rows($result)>0){
				if($row['email_verify']==1){	
					$_SESSION['customer']=$email;
					echo "<script>window.location.href='".FRONT_SITE_PATH."';</script>";
			}
				else{
					$title="Warning";
					$message="Please verify your email address before login";
					$icon="warning";
					$page="login";	
					include "message.php";
					}
			}
	else
	{
		$title="Warning";
		$message="Invalid email or password";
		$icon="warning";
		$page="login";	
		include "message.php";	
	}
}
?>