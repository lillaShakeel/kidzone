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
Generate Report
</div>
<div class="card-body">
<form method="post">
<div class="row">
<div class="col-5">
<label>From</label>
<input type="date" name="from" max="<?php echo date('Y-m-d');?>" required class="form-control mb-2">
</div>
<div class="col-5">
<label>To</label>
<input type="date" name="to" max="<?php echo date('Y-m-d');?>" required class="form-control mb-2">
</div>
<div class="col-2 py-3">
<button type="submit" name="submit" class="btn btn-info mt-3">View Report</button>
</div>
</div>
</form>

<table id="data" class="table table-bordered table-hover mt-3">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Product&nbsp;Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$total=0;
if(isset($_POST['submit'])){
	$from=$_POST['from'];
	$to=$_POST['to'];
}
else{
	date_default_timezone_set("Asia/Karachi");
	$date=date('Y-m-d');
	$from=$date;
	$to=$date;	
}
$sql="select product.pro_name, product.price, order_detail.qty, order_master.added_on from order_master INNER JOIN order_detail ON order_master.id=order_detail.order_id INNER JOIN product on order_detail.pro_id=product.pro_id where date_format(order_master.added_on,'%Y-%m-%d') >='$from' AND date_format(order_master.added_on,'%Y-%m-%d') <='$to' AND (order_master.order_status='on the way' OR order_master.order_status='delivered')";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo date('M d, Y',strtotime($row['added_on']));?></td>
<td><?php echo $row['pro_name'];?></td>
<td><?php echo number_format($row['price']);?></td>
<td><?php echo $row['qty'];?></td>
<td><?php echo number_format($row['price']*$row['qty']);?></td>
<?php $total+=$row['price']*$row['qty'];?>
</tr>
<?php }  ?>

</tbody>
<tr>
<th colspan="5">Total Sale</th>
<td>Rs. <?php echo number_format($total);?></td>
</tr>
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