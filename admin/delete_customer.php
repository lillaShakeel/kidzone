<?php
include_once "session.php";
$id=$_REQUEST['id'];

$i=0;
$sql="select * from order_master where customer_id='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$orderid[$i]=$row['id'];
	$i++;
}

for($j=0;$j<$i;$j++){
	$sql="delete from order_detail where order_id='".$orderid[$j]."'";
	$result=mysqli_query($con,$sql);
}

$sql="delete from order_master where customer_id='$id'";
$result=mysqli_query($con,$sql);

$sql="delete from customer where id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='customer.php'
	alert('Customer account deleted successfully');</script>";
	
}
else{
	echo "<script>window.location.href='customer.php'
	alert('Sorry!');</script>";
	
}

?>