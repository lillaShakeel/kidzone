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
Order Detail
</div>
<div class="card-body">
<?php
$id=$_REQUEST['id'];
$sql="select * from order_master where id='$id'";
$result=mysqli_query($con,$sql);
$order=mysqli_fetch_array($result);
?>
Order Date: <?php echo date('d M, Y h:i',strtotime($order['added_on']));?>
<table class="table table-responsive-md my-4">
<thead class="border bg-light">
<tr>
<th class="py-3 text-center">Product</th>
<th class="py-3 text-center">Unit Price</th>
<th class="py-3 text-center">Qty</th>
<th class="py-3 text-center">Total&nbsp;Price</th>
</tr>
</thead>
<tbody class="border">
<?php
		$total=0;
		$sql="select order_detail.qty, product.pro_name, product.price from order_master INNER JOIN order_detail ON order_master.id=order_detail.order_id INNER JOIN product ON order_detail.pro_id=product.pro_id where order_master.id='$id'";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_array($result)){
		?>
        <tr class="border">
        <td class="text-center py-4"><?php echo $row['pro_name'];?></td>
        <td class="text-center py-4">Rs. <?php echo number_format($row['price']);?></td>
        <td class="text-center py-4"><?php echo $row['qty'];?></td>
        <td class="text-center py-4">Rs. <?php echo number_format($row['price'] * $row['qty']);?></td>
        </tr>
        <?php
		$total+=$row['price'] * $row['qty'];
		}
		?>
        <tr class="border">
        <td class="text-right py-4" colspan="3"><b>Total</b></td>
        <td class="text-center py-4"><b>Rs. <?php echo number_format($total);?></b></td>
        </tr>
        <?php
		}
		else{
		?>
        
        <tr>
        <td class="text-center  py-4" colspan="6">No record available</td>
        </tr>
        <?php } ?>

</tbody>
</table>
<div class="row">
<div class="col-8">
<h5>Order Status:- <?php echo $order['order_status'];?></h5>
<div class="row">
<div class="col-md-4">
<form method="post">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<select class="form-control" name="status">
		<option value="">Update Order Status</option>
		<option value="on the way">On the Way</option>
		<option value="cancel">Cancel</option>
		<option value="delivered">Delivered</option>
		<option value="pending">Pending</option>
	</select>
	<button type="submit" name="order" class="btn btn-info btn-sm mt-3">Update</button>
</form>
</div>
</div>
</div>
<div class="col-4">
<a href="../download_invoice.php?orderid=<?php echo $order['id'];?>" title="Download Invoice">
<button class="btn btn-info float-right"><i class="fa fa-print"></i> Print</button>
</a>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['order'])){
	$id=$_POST['id'];
	$status=$_POST['status'];
	$sql="update order_master set order_status='$status' where id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='order.php'
		alert('Order Status Updated Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='order.php'
		alert('Sorry try again later')</script>";
	}

}

?>

