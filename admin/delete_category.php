<?php
include_once "session.php";
$id=$_REQUEST['id'];
$i=0;

$sql="select * from product where cat_id='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$productid[$i]=$row['id'];
	$i++;
}

for($j=0;$j<$i;$j++){
	$sql="delete from order_detail where pro_id='".$productid[$j]."'";
	$result=mysqli_query($con,$sql);
}

$sql="delete from product where cat_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from category where id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='category.php'
	alert('Category deleted successfully');</script>";
	
}
else{
	echo "<script>window.location.href='category.php'
	alert('Sorry!');</script>";
	
}

?>