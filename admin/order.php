<?php
include_once "header.php";
?>
<div class="container-fluid">
<div class="row">
<?php
include_once "navbar.php";
?>
<div class="col-10 data-container">

<div class="row">

<div class="col-12 my-3">
<div class="card">
<div class="card-header">
Order Master
</div>
<div class="card-body">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>Order&nbsp;ID</th>
<th>Date</th>
<th>Customer&nbsp;Name/ Contact</th>
<th>Address/ Zip Code</th>
<th>Payment Method</th>
<th>Payment Status</th>
<th>Order Status</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select order_master.id, customer.name, order_master.contact, customer.email, order_master.address, added_on, zipcode, payment_type, payment_status, order_status from order_master INNER JOIN customer on order_master.customer_id=customer.id ORDER BY order_master.id DESC";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><a href="order_detail.php?id=<?php echo $row['id'];?>"><div class="bg-secondary text-white font-weight-bold py-2 text-center"><?php echo $row['id'];?></div></a></td>
<td><?php echo date('d M, Y h:i', strtotime($row['added_on']))?></td>
<td><?php echo $row['name']." | ".$row['contact'];?></td>
<td><?php echo $row['address']." | ".$row['zipcode'];?></td>
<td><?php echo $row['payment_type'];?></td>
<td><?php 
	if($row['payment_status']=='complete'){
		echo "<span class='badge badge-success'>Complete</span>";	
	}
	else if($row['payment_status']=='pending'){
		echo "<span class='badge badge-warning'>Pending</span>";	
	}
	else if($row['payment_status']=='fail'){
		echo "<span class='badge badge-danger'>Failed</span>";	
	}
 ;?></td>
<td><?php 
	if($row['order_status']=='delivered'){
		echo "<span class='badge badge-success'>Delivered</span>";	
	}
	else if($row['order_status']=='pending'){
		echo "<span class='badge badge-warning'>Pending</span>";	
	}
	else if($row['order_status']=='cancel'){
		echo "<span class='badge badge-danger'>Cancel</span>";	
	}
	else if($row['order_status']=='on the way'){
		echo "<span class='badge badge-primary'>On the Way</span>";	
	}
 ;?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
$('#data').DataTable();
});
</script>
<?php
if(isset($_POST['status'])){
	$id=$_POST['id'];
	$status=$_POST['status'];
	$sql="update customer_order set status='$status' where id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='order.php'
	alert('Order Status updated successfully');</script>";
		
	}
	else{
		echo "<script>window.location.href='order.php'
	alert('Sorry!');</script>";
	}

}
?>
