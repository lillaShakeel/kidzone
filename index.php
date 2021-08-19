<?php
include('header.php');
?>
<div id="banner">
<div class="container">
<div class="row">
<div class="col-lg-6">
<h1 class="banner-title">kidZone Online Toy Shop</h1>
<p class="lead">It is the first of its kind service in Pakistan, as we have brought the concept of an automated price comparison engine to the local online shopping market. Prices of all electronic, machenical and stuffed toys are updated automatically on a regular basis thanks to an intelligent software that works 24/7 to ensure our customers always get the lowest prices!</p>
</div>
</div>
</div>
</div>

<!--Banner End -->

<div class="container">
<div class="row">
<div class="col-md-12">
<h2 class="section-heading">Our Services</h2>
</div>
<div class="col-md-4">
<div class="service-box">
<span class="fa fa-stack fa-4x">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-home fa-stack-1x fa-inverse"></i>
</span>
<h3 class="service-box-heading">Free Shipping</h3>
<p class="service-box-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, provident.</p>
</div>
</div>
<div class="col-md-4">
<div class="service-box">
<span class="fa fa-stack fa-4x">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-handshake-o fa-stack-1x fa-inverse"></i>
</span>
<h3 class="service-box-heading">Customer Support</h3>
<p class="service-box-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, provident.</p>
</div>
</div>
<div class="col-md-4">
<div class="service-box">
<span class="fa fa-stack fa-4x">
<i class="fa fa-circle fa-stack-2x"></i>
<i class="fa fa-key fa-stack-1x fa-inverse"></i>
</span>
<h3 class="service-box-heading">Secure Payment</h3>
<p class="service-box-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, provident.</p>
</div>
</div>
</div>
</div>
<!--Service End -->

<div class="product-section">
<div class="container">
<div class="row">
<div class="col-md-12 mb-3">
<h2 class="section-heading">Latest Product</h2>
</div>
<div class="col-md-12 mb-5">
<div class="card-group">

<?php
$sql="select category.cat_name, age_group.age, product.pro_id, product.pro_name, product.price, product.description, product.image from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group on age_group.id=product.age_group_id  ORDER BY product.pro_id DESC LIMIT 8";
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
</div>

<!--Latest Product End-->


<div class="container">
<div class="row">
<div class="col-md-12 mt-3 mb-3">
<h2 class="section-heading">Our Product</h2>
</div>
<div class="col-md-12 mb-4">
<div class="card-group">

<?php
$limit= 8;
if(isset($_GET['page'])){
	$page= $_GET['page'];
}
else{
	$page= 1;
}
$offset=($page-1)*$limit;

$sql="select category.cat_name, age_group.age, product.pro_id, product.pro_name, product.price, product.description, product.image from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group on age_group.id=product.age_group_id LIMIT {$offset},{$limit}";
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


<div class="col-md-12 mb-4">
<nav aria-label="...">
<ul class="pagination justify-content-center">
<?php
if($page>1){
	echo '<li class="page-item"><a class="page-link" href="'.FRONT_SITE_PATH.'index?page='.($page-1).'">Previous</a></li>';
}
else{
	echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
}
$sql1="select * from product";
$result1=mysqli_query($con,$sql1);
if(mysqli_num_rows($result1)>0){
$total_records=	mysqli_num_rows($result1);
$total_page=ceil($total_records/$limit);
for($i=1;$i<=$total_page;$i++){
	if($i==$page){
		$active="active";
	}
	else{
		
		$active="";
	}
	?>
    <li class="page-item <?php echo $active;?>"><a class="page-link" href="<?php echo FRONT_SITE_PATH?>index?page=<?php echo $i;?>"><?php echo $i;?></a></li>
    <?php
}
	
}
if($total_page>$page){
	echo '<li class="page-item"><a class="page-link" href="'.FRONT_SITE_PATH.'index?page='.($page+1).'">Next</a></li>';	
	
}
else{
	echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
}
?>
  </ul>
</nav>
</div>

</div>
</div>

<?php
include('footer.php');
?>