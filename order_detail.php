<?php
include('header.php');
?>

<div class="container customer-section">
<div class="row">
<div class="col-md-12">
<h5 class="pt-5 pb-3">Order Detail</h5>
<table class="table table-responsive-md">
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
		$orderid=$_REQUEST['orderid'];
		$sql="select order_detail.qty, product.pro_name, product.price from order_master INNER JOIN order_detail ON order_master.id=order_detail.order_id INNER JOIN product ON order_detail.pro_id=product.pro_id where order_master.id='$orderid'";
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
<span><a href="<?php echo FRONT_SITE_PATH?>order_history"><i class="fa fa-arrow-left"></i> Back to order</a></span>
</div>
</div>
</div>
<?php
include('footer.php');
?>



