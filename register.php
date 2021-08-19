<?php
include('header.php');
include('function.php');
?>
<div class="container my-5">
<div class="row">
<div class="col-md-7 m-auto">
<div class="card mt-5">
<div class="card-body">
<div class="text-center">
<img src="user.png" class="user-img mt-3">
</div>
<h3 class="text-center pt-2">Sign Up</h3>
<form method="post" class="form-group">
<label>Name</label>
<input type="text" name="name" pattern="[A-Za-z]+\ [A-Za-z]{3,}" required class="form-control mb-3">
<label>Email</label>
<input type="email" name="email" required class="form-control mb-3">
<label>Contact</label>
<input type="text" name="contact" pattern="[0-9]{11}" required class="form-control mb-3">
<label>Password</label>
<input type="password" name="password" pattern=".{6,}" title="Six or more character" required class="form-control mb-3">
<input type="submit" name="submit" value="Sign Up" class="btn btn-info btn-block mt-4">
</form>
</div>
<div class="card-footer">
<p class="text-center">Already have an account? <span class="text-info"><a href="<?php echo FRONT_SITE_PATH?>login" class="text-decoration-none">Sign In</a></span></p>
</div>
</div>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$contact=$_POST['contact'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
    $status = "notverified";

	$sql="select * from customer where email='$email'";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0){
		$title="Warning";
		$message="This email already exist, Please try with another one";
		$icon="warning";
		$page="register";	
		include "message.php";
	}
	else{
	$sql="insert into customer(name, email, contact, password, email_verify) values('$name','$email','$contact','$password',0)";
	$con->query($sql);
	$customer_id = $con->insert_id;
	$subject= 'Activate Your Account';
	$body= 'Thank Your for registering with <b>kidzone</b><br>Dear '.$name.' You are almost there! Please click on the following link to activate your account to access your account.<br>'.FRONT_SITE_PATH.'verify?id='.$customer_id.'<br>If the given link is not clickable, please copy and paste it into the address bar of your web browser.<br><b>Note:</b> You will not be able to place an order until you have activated it.<br><br>Best Regards,<br><b>Shakeel Ahmad<br><b>kidZone Online Toy Shop<b>';
	if(sendEmail($email,$name,$subject,$body))
	{
		$title="Successfully";
		$message="Account created successfully, email verification link has been sent";
		$icon="success";
		$page="login";	
		include "message.php";
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="register";	
		include "message.php";
	}
	}
}
?>