<?php
include('header.php');
$id=$_REQUEST['id'];
$message="";
if(isset($_REQUEST['id']) && $id!=''){
	$sql="update customer set email_verify=1 where id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		$message="Your Email ID verified Successfully";
	}
	
}
else{
	header('location:index');	
}
?>
<div class="container my-5">
<div class="row">
<div class="col-md-7 m-auto">
<div class="card mt-5">
<div class="card-body">
<p class="text-center pt-2"><?php echo $message;?></p>
<p class="text-center">Back to Login? <span class="text-info"><a href="<?php echo FRONT_SITE_PATH?>login" class="text-decoration-none">Sign In</a></span></p>
</div>
</div>
</div>
</div>
</div>

<?php
include('footer.php');
?>