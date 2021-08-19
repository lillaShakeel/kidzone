<?php
include_once "session.php";
$id=$_REQUEST['id'];
$i=0;

$sql="select * from product where age_group_id='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$productid[$i]=$row['id'];
	$i++;
}

for($j=0;$j<$i;$j++){
	$sql="delete from order_detail where pro_id='".$productid[$j]."'";
	$result=mysqli_query($con,$sql);
}

$sql="delete from product where age_group_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from age_group where id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='age.php'
	alert('Age Group deleted successfully');</script>";
	
}
else{
	echo "<script>window.location.href='age.php'
	alert('Sorry!');</script>";
	
}

?>