<?php
include_once "session.php";
$id=$_REQUEST['id'];

$sql="delete from order_detail where pro_id='$id'";
$result=mysqli_query($con,$sql);


$sql="delete from product where pro_id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='product.php'
	alert('Product deleted successfully');</script>";
	
}
else{
	echo "<script>window.location.href='product.php'
	alert('Sorry!');</script>";
	
}

?>