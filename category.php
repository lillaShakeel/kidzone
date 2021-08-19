<?php
include('header.php');
?>
<div class="container customer-section">
<div class="row">
<div class="col-md-12 mb-3">
<h2 class="section-heading">Our Product</h2>
</div>

<div class="col-md-12 mb-2">
<div class="card-group">

<?php
$id=$_REQUEST['id'];
$sql="select category.cat_name, age_group.age, product.pro_id, product.pro_name, product.price, product.description, product.image from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group on age_group.id=product.age_group_id AND product.cat_id='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
?>

<div class="col-lg-3 col-md-4 mb-4">
<a href="<?php echo FRONT_SITE_PATH?>product_single?id=<?php echo $row['pro_id'];?>">
<div class="card">
<img src="image/<?php echo $row['image'];?>" class="card-img-top">
<div class="card-body">
<div class="card-title text-dark"><b><?php echo $row['pro_name'];?></b></div>
<div class="card-text text-dark"><i>Rs. <?php echo number_format($row['price']);?></i></div>
<div class="card-text text-success"><?php echo $row['cat_name'];?></div>
<div class="card-text text-primary"><?php echo $row['age'];?></div>
<form method="post" action="<?php echo FRONT_SITE_PATH?>add_to_cart?action=add&id=<?php echo $row['pro_id'];?>">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="hidden_image" value="<?php echo $row['image'];?>">
<input type="hidden" name="hidden_name" value="<?php echo $row['pro_name'];?>">
<input type="hidden" name="hidden_price" value="<?php echo $row['price'];?>">
<button type="submit" name="add_to_cart" class="btn btn-info mt-3">Add to Cart <i class="fa fa-cart-plus"></i></button>
</form>
</div>
</div>
</a>
</div>
<?php } ?>




</div>
</div>




</div>
</div>




<?php
include('footer.php');
?>



