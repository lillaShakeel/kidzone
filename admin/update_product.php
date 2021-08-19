<?php
include_once "header.php";
?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<div class="container-fluid">
<div class="row">
<?php
include_once "navbar.php";
?>
<div class="col-10 data-container">

<div class="row">
<div class="col-5 my-3">
<div class="card">
<div class="card-header">
Update Product
</div>
<div class="card-body">
<?php
$id=$_REQUEST['id'];
$sql="select category.cat_name, age_group.age, product.pro_id, product.cat_id, product.age_group_id, product.pro_name, product.price, product.description from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group ON age_group.id=product.age_group_id where product.pro_id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
?>
<form method="post" enctype="multipart/form-data">
<label>Product Name</label>
<input type="text" name="name" value="<?php echo $row['pro_name'];?>" required class="form-control mb-2">
<label>Category</label>
<select name="category" required class="form-control mb-2">
<option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
<?php
$sql1="select * from category";
$result1=mysqli_query($con,$sql1);
while($row1=mysqli_fetch_array($result1)){
?>
<option value="<?php echo $row1['id'];?>"><?php echo $row1['cat_name'];?></option>
<?php } ?>
</select>
<label>Age Group</label>
<select name="age" required class="form-control mb-2">
<option value="<?php echo $row['age_group_id'];?>"><?php echo $row['age'];?></option>
<?php
$sql2="select * from age_group";
$result2=mysqli_query($con,$sql2);
while($row2=mysqli_fetch_array($result2)){
?>
<option value="<?php echo $row2['id'];?>"><?php echo $row2['age'];?></option>
<?php } ?>
</select>
<label>Price</label>
<input type="number" name="price" value="<?php echo $row['price'];?>" required class="form-control mb-2">
<label>Description</label>
<textarea name="description" required class="form-control mb-2" rows="4"><?php echo $row['description'];?></textarea>
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
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
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$category=$_POST['category'];
	$age=$_POST['age'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	$sql="update product set cat_id='$category', age_group_id='$age', pro_name='$name', price='$price', description='$description' where pro_id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='product.php'
		alert('Product Updated Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='product.php'
		alert('Sorry try again later')</script>";
	}
}
?>