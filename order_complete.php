<?php
include('header.php');
include('function.php');
?>

<div class="container customer-section">
<div class="row">
<div class="col-md-12">
<h2>Your order is in progress, Please don't reload the page.</h2>
<?php
if(isset($_GET['payment_id']) && isset($_GET['payment_status']) && isset($_GET['payment_request_id'])){
	$payment_id=$_GET['payment_id'];
	$payment_status=$_GET['payment_status'];
	$payment_request_id=$_GET['payment_request_id'];
	
	$res=mysqli_query($con,"select * from order_master where id='".$_SESSION['ORDER_ID']."'");
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_array($res);
		$orderid=$row['id'];
		if($payment_status=='Credit'){
		mysqli_query($con,"update order_master set payment_status='complete', payment_id='$payment_id' where id='".$_SESSION['ORDER_ID']."'");
		$emailHTML=invoice($_SESSION['ORDER_ID']);
		$subject = 'Order Placed Successfully';
		$body    = $emailHTML;
		sendEmail($customer['email'],$customer['name'],$subject,$body);
			$title="Successfully";
			$message="Your order has been placed and payment received successfully";
			$icon="success";
			$page="index";	
			include "message.php";
		
		}
		else{
		mysqli_query($con,"update order_master set payment_status='fail', payment_id='$payment_id' where id='".$_SESSION['ORDER_ID']."'");
			$title="Warning";
			$message="Payment Failed";
			$icon="error";
			$page="index";	
			include "message.php";
		}
	}
	else{
		
		
	}
	
	
	
}

?>

</div>
</div>
</div>
<?php
include('footer.php');
?>



