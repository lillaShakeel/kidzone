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
Add Age Group
</div>
<div class="card-body">
<form method="post">
<label>Age Group</label>
<input type="text" name="age" required class="form-control mb-2">
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8 my-3">
<div class="card">
<div class="card-header">
View Age Group
</div>
<div class="card-body">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Age Group</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from age_group order by id DESC";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['age'];?></td>
<td><a href="update_age.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a><a href="delete_age.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash"></i></button></a></td>
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
	$age=$_POST['age'];
	$sql="insert into age_group values('','".$admin['id']."','$age')";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='age.php'
		alert('Age Group Added Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='age.php'
		alert('Sorry try again later')</script>";
	}
}
?>