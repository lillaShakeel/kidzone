<?php
include_once "session.php";
$id=$_REQUEST['id'];
$sql="delete from orderline where order_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from customer_order where id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='order.php'
	alert('Order deleted successfully');</script>";
	
}
else{
	echo "<script>window.location.href='order.php'
	alert('Sorry!');</script>";
	
}

?>