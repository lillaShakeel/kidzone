<?php
include_once "header.php";
include('function.php');
if($item<=0){
	$title="Warning";
	$message="Your cart is empty";
	$icon="warning";
	$page="index";	
	include "message.php";
}
else{
?>
<div class="container customer-section">
<div class="row">
<div class="col-md-9 mt-5">
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-dark" data-toggle="<?php if(!isset($_SESSION['customer'])) echo "collapse";?>" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          1. CHECK METHOD
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse <?php if(!isset($_SESSION['customer'])) echo "show";?>" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      Login
      <hr>
      </div>
      <div class="col-md-12 mt-3">
      <form method="post">
      <label>Email</label>
      <input type="email" name="email" class="form-control mb-2" required>
      <label>Password</label>
      <input type="password" name="password" class="form-control mb-2" required>
      <button type="submit" name="login" class="btn btn-secondary py-2 px-4 mt-3">LOGIN</button>
      <a href="<?php echo FRONT_SITE_PATH?>register"><button type="button" class="btn btn-info py-2 px-4 mt-3 ml-2">REGISTER</button></a>
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
        <button class="btn btn-link collapsed text-dark" data-toggle="<?php if(isset($_SESSION['customer'])) echo "collapse";?>" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          2. OTHER INFORMATION
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse <?php if(isset($_SESSION['customer'])) echo "show";?>" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        
        <div class="container">
      <div class="row">
      <div class="col-md-12 mt-3">
      <form method="post">
      <div class="row">
      <div class="col-md-3">
      <label>Full Name</label>
      <input type="text" name="name" value="<?php echo $customer['name'];?>" class="form-control" required>
      </div>
      <div class="col-md-3">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $customer['email'];?>" class="form-control" required>
      </div>
      <div class="col-md-3">
      <label>Contact</label>
      <input type="text" name="contact" value="<?php echo $customer['contact'];?>" class="form-control" required>
      </div>
      <div class="col-md-3">
      <label>Zip/ Postal Code</label>
      <input type="number" name="zip" class="form-control" required>
      </div>
      </div>
      <div class="row">
      <div class="col-md-12 my-3">
      <label>Address</label>
      <input type="text" name="address" class="form-control" required>
      </div>
      </div>
      <div class="form-check">
      <label class="form-check-label">
      <input type="radio" class="form-check-input" name="payment_type" value="cod"> Cash on Delivery (COD)
      </label>
      </div>
       <div class="form-check my-2">
      <label class="form-check-label">
      <input type="radio" class="form-check-input" name="payment_type" value="instamojo"> Instamojo
      </label>
      </div>
      <button type="submit" name="place_order" class="btn btn-outline-info py-2 mt-3">PLACE YOUR ORDER</button>
      </form>
      </div>
      </div>
      </div>
        
      </div>
    </div>
  </div>
  
</div>
</div>
<div class="col-md-3">
<div class="card mt-5">
<div class="card-header">
<div class="card-title">Cart Details</div>
</div>
<div class="card-body">
<?php
	$total= 0;
	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
?>
<img src="image/<?php echo $values['item_image'];?>" class="img-rounded cart-img mt-3">
<div class="card-text"><?php echo $values['item_name'];?></div>
<div class="card-text">Qty: <?php echo $values['item_quantity'];?></div>
<div class="card-text">Rs. <?php echo number_format($values['item_price']);?></div>
<?php
	$total= $total + ($values['item_quantity'] * $values['item_price']);
	}
?>
<hr>
<div class="card-title pt-1"><p>Total: <span class="shop-total font-weight-bold text-info">Rs. <?php echo number_format($total);?></span></p></div>
</div>
</div>
</div>
</div>


</div>
<?php
include('footer.php');
if(isset($_POST['place_order'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$zip=$_POST['zip'];
	$address=$_POST['address'];
	$payment_type=$_POST['payment_type'];
	$total_price=0;
	
	
	date_default_timezone_set("Asia/Karachi");
	$added_on=date('Y-m-d h:i:s A');
	$sql="insert into order_master(customer_id, name, email, contact, address, zipcode, payment_status, payment_type, txnid, payment_id, order_status, added_on) values('".$customer['id']."','$name','$email','$contact','$address','$zip','pending','$payment_type','','','pending','$added_on')";
	mysqli_query($con,$sql);
	$insert_id=mysqli_insert_id($con);
	$_SESSION['ORDER_ID']=$insert_id;
	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		mysqli_query($con,"insert into order_detail(order_id,pro_id,qty) values('$insert_id','".$values['item_id']."','".$values['item_quantity']."')");
		$total_price += $values['item_price']*$values['item_quantity'];
	}
	unset($_SESSION['shopping_cart']);
	if($payment_type=='cod')
	{
		$emailHTML=invoice($insert_id);
		$subject = 'Order Placed Successfully';
		$body    = $emailHTML;
			if(sendEmail($customer['email'],$customer['name'],$subject,$body))
			{
			$title="Successfully";
			$message="Your order has been placed successfully";
			$icon="success";
			$page="index";	
			include "message.php";
			}
			else
			{
			$title="Warning";
			$message="Something went wrong";
			$icon="error";
			$page="index";	
			include "message.php";
			}
	}
	
	if($payment_type=='instamojo')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_3842d111573d638772660e9f045",
                  "X-Auth-Token:test_8ef96573249a7b2deb83f9d0019"));
		$payload = Array(
   				 'purpose' => 'kidZone',
   				 'amount' => $total_price,
    			'phone' => '9999999999',
    			'buyer_name' => $customer['name'],
				'redirect_url' => FRONT_SITE_PATH.'order_complete',
				'send_email' => true,
				'send_sms' => true,
				'email' => $customer['email'],
				'allow_repeated_payments' => false
				);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
				$response = curl_exec($ch);
				curl_close($ch);
				$response=json_decode($response);
				$_SESSION['TID']=$response->payment_request->id;
				mysqli_query($con,"update order_master set txnid='".$response->payment_request->id."' where id='".$insert_id."'");
				echo "<script>window.location.href='".$response->payment_request->longurl."'</script>";
				die();
		
	}
	
}
else if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql="select * from customer where email='$email' and password='$password'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	if($row){
				if($row['email_verify']==1){
					$_SESSION['customer']=$email;
					echo "<script>window.location.href='".FRONT_SITE_PATH."checkout';</script>";
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
}
?>



