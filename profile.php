<?php
include('header.php');
if(!isset($_SESSION['customer'])){
	echo "<script>window.location.href='".FRONT_SITE_PATH."';</script>";
}
?>
<div class="container customer-section">
<div class="row mt-5">
<div class="col-md-9 m-auto">
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          1. EDIT YOUR ACCOUNT INFORMATION
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      My Account Information<br>
      Your Personal Details
      <hr>
      </div>
      <div class="col-md-12 mt-3">
      <form method="post">
      <div class="row">
      <div class="col-md-6">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $customer['name'];?>" class="form-control" required>
      </div>
      <div class="col-md-6">
      <label>Contact</label>
      <input type="text" name="contact" value="<?php echo $customer['contact'];?>" pattern="[0-9]{11}" title="Enter the 11 digit contact number" class="form-control" required>
      </div>
      </div>
       <div class="row">
      <div class="col-md-12 my-3">
      <label>Email Address</label>
      <input type="email" name="email" value="<?php echo $customer['email'];?>" readonly class="form-control" required>
      </div>
      </div>
      <button type="submit" name="update" class="btn btn-secondary py-2 px-4 mt-3">Save</button>
      </form>
      </div>
      </div>
      </div>
               
      </div>
    </div>
  </div>
  <div class="card mt-4">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-dark" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          2. CHANGE YOUR PASSWORD
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        
        <div class="container">
      <div class="row">
      <div class="col-md-12">
      Change Password<br>
      Your Password
      <hr>
      </div>
      <div class="col-md-12 mt-3">
      <form method="post">
      <div class="row">
      <div class="col-md-12">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
      </div>
      </div>
       <div class="row">
      <div class="col-md-12 my-3">
      <label>Password Confirm</label>
      <input type="password" name="password_confirm" class="form-control" required>
      </div>
      </div>
      <button type="submit" name="update_password" class="btn btn-secondary py-2 px-4 mt-3">Save</button>
      </form>
      </div>
      </div>
      </div>
        
      </div>
    </div>
  </div>
  
</div>
</div>

</div>
</div>
<?php
include('footer.php');
if(isset($_POST['update_password'])){
	$password=$_POST['password'];
	$password_confirm=$_POST['password_confirm'];
	if($password!=$password_confirm){
		$title="Warning";
		$message="Please enter valid confirm password";
		$icon="error";
		$page="profile";	
		include "message.php";
		
	}
	else{
	$password=md5($_POST['password']);
	$password_confirm=md5($_POST['password_confirm']);
	$sql="update customer set password='$password' where id='".$customer['id']."'";
	$result=mysqli_query($con,$sql);
	if($result){
		$title="Successfully";
		$message="Password changed successfully";
		$icon="success";
		$page="profile";	
		include "message.php";
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="profile";	
		include "message.php";
	}
	}
}
else if(isset($_POST['update'])){
	$name=$_POST['name'];
	$contact=$_POST['contact'];
	$sql="update customer set name='$name', contact='$contact' where id='".$customer['id']."'";
	$result=mysqli_query($con,$sql);
	if($result){
		$title="Successfully";
		$message="Account updated successfully";
		$icon="success";
		$page="profile";	
		include "message.php";
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="profile";	
		include "message.php";
	}
}
?>



