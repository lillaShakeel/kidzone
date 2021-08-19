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
<div class="col-4 my-3">
<div class="card">
<div class="card-header">
Update Category
</div>
<div class="card-body">
<form method="post">
<?php
$id=$_REQUEST['id'];
$sql="select * from category where id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
?>
<label>Category Name</label>
<input type="text" name="category" value="<?php echo $row['cat_name'];?>" required class="form-control mb-2">
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8 my-3">
<div class="card">
<div class="card-header">
View Category
</div>
<div class="card-body">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Category Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from category order by id DESC";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['cat_name'];?></td>
<td><a href="update_category.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a><a href="delete_category.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash"></i></button></a></td>
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
if(isset($_POST['submit'])){
	$category=$_POST['category'];
	$sql="update category set admin_id='".$admin['id']."', cat_name='$category' where id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='category.php'
		alert('Category Updated Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='category.php'
		alert('Sorry try again later')</script>";
	}
}
?>