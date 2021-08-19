<?php
include('header.php');
?>
<nav class="navbar bg-light">
  <div class="container">
      <ol class="breadcrumb py-3 m-0">
        <li class="breadcrumb-item"><a href="<?php echo FRONT_SITE_PATH?>" class="text-dark">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Contact</li>
      </ol>
  </div>
</nav>
<div class="container customer-section">
<div class="row">
<div class="col-lg-6">
<form method="post" class="form-group">
<label>Name</label>
<input type="text" name="name" required class="form-control mb-3">
<label>Email</label>
<input type="email" name="email" required class="form-control mb-3">
<label>Subject</label>
<input type="text" name="subject" required class="form-control mb-3">
<label>Message</label>
<textarea name="message" rows="4" required class="form-control mb-3"></textarea>
<input type="submit" name="submit" value="Send Message" class="btn btn-info btn-block mt-4">
</form>
</div>
<div class="col-lg-6">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380.8370267400874!2d72.67815051449827!3d32.073656426822495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392177bfd683f3d5%3A0xa8090086de867b9d!2sUniversity%20of%20Sargodha!5e0!3m2!1sen!2s!4v1617602623072!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	$sql="insert into contact(name, email, subject, message) values('$name','$email','$subject','$message')";
	$result=mysqli_query($con,$sql);
	if($result)
	{
		$title="Successfully";
		$message="Your message sent successfully";
		$icon="success";
		$page="contact";	
		include "message.php";
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="contact";	
		include "message.php";
	}
}
?>