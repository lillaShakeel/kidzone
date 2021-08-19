<?php
include_once "header.php";
if($item<=0){
	$title="Warning";
	$message="Your cart is empty";
	$icon="warning";
	$page="index";	
	include "message.php";
}
else{
?>

<div class="container customer-section">
<div class="row">
<div class="col-md-12">
<h5 class="pt-5 pb-3">Your Cart Items</h5>
<table class="table table-responsive-md">
<thead class="border bg-light">
<tr>
<th class="py-3 text-center">Image</th>
<th class="py-3 text-center">Product&nbsp;Name</th>
<th class="py-3 text-center">Untill&nbsp;Price</th>
<th class="py-3 text-center">Qty</th>
<th class="py-3 text-center">Subtotal</th>
<th class="py-3 text-center">Action</th>
</tr>
</thead>
<tbody class="border">
<?php
if(!empty($_SESSION['shopping_cart']))
{
	$total= 0;
	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		?>
        <tr>
        <td class="text-center mb-3"><img src="image/<?php echo $values['item_image'];?>" height="60" width="60"></td>
        <td class="text-center pt-4"><?php echo $values['item_name'];?></td>
        <td class="text-center pt-4">Rs. <?php echo number_format($values['item_price']);?></td>
        <td class="text-center pt-4"><?php echo $values['item_quantity'];?></td>
        <td class="text-center pt-4">Rs. <?php echo number_format($values['item_quantity'] * $values['item_price']);?></td>
        <td class="text-center pt-4"><a href="<?php echo FRONT_SITE_PATH?>add_to_cart?action=delete&id=<?php echo $values['item_id'];?>"><button class="btn btn-light"><i class="fa fa-trash text-danger"></i></button></a></td>
        </tr>
        <?php
		$total= $total + ($values['item_quantity'] * $values['item_price']);
		
	}
	?>
    	<tr>
        <td class="text-right pt-4" colspan="4">Total</td>
        <th class="text-left pt-4" colspan="2">Rs. <?php echo number_format($total);?></th>
        </tr>
    <?php
}

?>

</tbody>
</table>
</div>
</div>

<div class="row">
<div class="col-md-6 col-lg-8">
<a href="<?php echo FRONT_SITE_PATH?>"><button class="btn btn-outline-info my-3">CONTINUE SHOPPING</button></a>
</div>
<div class="col-md-6 col-lg-4">
<a href="<?php echo FRONT_SITE_PATH?>checkout"><button class="btn btn-outline-info my-3">CLEAR SHOPPING CART</button></a>
<a href="<?php echo FRONT_SITE_PATH?>checkout"><button class="btn btn-outline-info my-3 ml-2">CHECKOUT</button></a>
</div>

</div>
</div>
<?php
include('footer.php');
}
?>



