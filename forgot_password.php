<?php
include('header.php');
include('function.php');
?>
<div class="container my-5">
<div class="row">
<div class="col-md-5 m-auto">
<div class="card mt-5">
<div class="card-body">
<h3 class="text-center pt-2 pb-3">Forgot Password</h3>
<form method="post" class="form-group">
<label>Email</label>
<input type="email" name="email" required class="form-control">
<i>Note: Email address register with kidzone</i>
<input type="submit" name="submit" value="Send" class="btn btn-info btn-block mt-4 mb-3">
</form>
</div>
</div>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['submit'])){
	$email=$_POST['email'];
	$sql="select * from customer where email='$email'";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0){
	$row=mysqli_fetch_array($result);
	date_default_timezone_set("Asia/Karachi");
	$date=date('M d, Y');
	$time=date('h:i A');

	
	$subject = 'Password reset request';
	$body    = 'Date: '.$date.' '.$time.'<br>Dear Customer,<br>If you requested a password reset from kidZone website , click the link given below. If you did not make this request, ignore this email.<br>If the given link is not clickable, please copy and paste below given text into the address bar of your web browser.<br>'.FRONT_SITE_PATH.'reset_password?id='.$row['id'].'<br><b>kidZone Online Toy Shop</b>';
	if(sendEmail($email,$row['name'],$subject,$body))
	{
		$title="Successfully";
		$message="Password reset link sent successfully";
		$icon="success";
		$page="login";	
		include "message.php";
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="forgot_password";	
		include "message.php";
	}
	}
	else{
		
		$title="Warning";
		$message="Please enter valid email address";
		$icon="warning";
		$page="forgot_password.php";	
		include "message.php";
	}
}
?>