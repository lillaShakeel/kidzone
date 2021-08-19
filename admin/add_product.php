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
Add Product
</div>
<div class="card-body">
<form method="post" enctype="multipart/form-data">
<label>Product Name</label>
<input type="text" name="name" required class="form-control mb-2">
<label>Category</label>
<select name="category" required class="form-control mb-2">
<option value="">- Select -</option>
<?php
$sql="select * from category";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
?>
<option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
<?php } ?>
</select>
<label>Age Group</label>
<select name="age" required class="form-control mb-2">
<option value="">- Select -</option>
<?php
$sql="select * from age_group";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
?>
<option value="<?php echo $row['id'];?>"><?php echo $row['age'];?></option>
<?php } ?>
</select>
<label>Price</label>
<input type="number" name="price" required class="form-control mb-2">
<label>Image</label>
<input type="file" name="img" required class="form-control mb-2">
<label>Description</label>
<textarea name="description" required class="form-control mb-2" rows="4"></textarea>
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
	move_uploaded_file($_FILES['img']['tmp_name'],"../image/".$_FILES['img']['name']);
	$img=$_FILES['img']['name'];
	$description=$_POST['description'];
	$sql="insert into product(cat_id, age_group_id, pro_name, price, image, description) values('$category','$age','$name','$price','$img','$description')";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='product.php'
		alert('Product Added Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='product.php'
		alert('Sorry try again later')</script>";
	}
}
?>