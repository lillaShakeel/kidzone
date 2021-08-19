<?php
include('header.php');
?>

<div class="container customer-section">
<div class="row">
<div class="col-md-12">
<h5 class="pt-5 pb-3">Order History</h5>
<table class="table table-responsive-md">
<thead class="border bg-light">
<tr>
<th class="py-3 text-center">Orer&nbsp;No</th>
<th class="py-3 text-center">Date</th>
<th class="py-3 text-center">Address</th>
<th class="py-3 text-center">Payment&nbsp;Type</th>
<th class="py-3 text-center">Order&nbsp;Status</th>
<th class="py-3 text-center">Payment&nbsp;Status</th>
</tr>
</thead>
<tbody class="border">
<?php
		$sql="select * from order_master where customer_id='".$customer['id']."' order by id DESC";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_array($result)){
		?>
        <tr class="border">
        <td class="text-center"><a href="<?php echo FRONT_SITE_PATH?>order_detail?orderid=<?php echo $row['id'];?>">
        <div class="bg-secondary text-white font-weight-bold py-2 mt-3"><?php echo $row['id'];?></div></a>
        <a href="<?php echo FRONT_SITE_PATH?>download_invoice?orderid=<?php echo $row['id'];?>" title="Download Invoice">
        <img src="image/pdf.png" height="30" width="22" class="my-3">
        </a>
        </td>
        <td class="text-center pt-5"><?php echo date('d M, Y h:i A',strtotime($row['added_on']));?></td>
        <td class="text-center pt-5"><?php echo $row['address'];?></td>
        <td class="text-center pt-5"><?php echo $row['payment_type'];?></td>
        <td class="text-center pt-5">
        <?php
		if($row['order_status']=='pending')
		{
			echo "
			<span class='badge badge-warning'>Pending</span>
			<form method='post'>
			<input type='hidden' name='orderid' value='".$row['id']."'>
			<button type='submit' name='order_cancel' class='btn btn-danger btn-sm mt-3'>Cancel</button>
			</form>
			";
		}
		else if($row['order_status']=='cancel')
			echo "<span class='badge badge-danger'>Cancel</span>";
		else if($row['order_status']=='on the way')
			echo "<span class='badge badge-primary'>On the Way</span>";
		else if($row['order_status']=='delivered')
			echo "<span class='badge badge-success'>Delivered</span>";
		?>
        </td>
        <td class="text-center pt-5">
        <?php
		if($row['payment_status']=='complete')
			echo "<span class='badge badge-success'>Completed</span>";
		else if($row['payment_status']=='pending')
			echo "<span class='badge badge-warning'>Pending</span>";
		else if($row['payment_status']=='fail')
			echo "<span class='badge badge-danger'>Failed</span>";
		?>
        </td>
        </tr>
        <?php
		}
		}
		else{
		?>
        
        <tr>
        <td class="text-center pt-4" colspan="6">No record available</td>
        </tr>
        <?php } ?>

</tbody>
</table>
</div>
</div>
</div>
<?php
include('footer.php');
if(isset($_POST['order_cancel'])){
	
	$orderid=$_POST['orderid'];
	$sql="update order_master set order_status='cancel' where id='$orderid'";
	$result=mysqli_query($con,$sql);
	if($result){
		$title="Successfully";
		$message="Order cancel successfully";
		$icon="success";
		$page="order_history";	
		include "message.php";
		
	}
	else
	{
		$title="Warning";
		$message="Something went wrong";
		$icon="error";
		$page="order_history";	
		include "message.php";
	}
	
}
?>



