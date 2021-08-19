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
View Product
</div>
<div class="card-body">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Product&nbsp;Name</th>
<th>Category&nbsp;Name</th>
<th>Age&nbsp;Group</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select category.cat_name, age_group.age, product.pro_id, product.pro_name, product.price from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group ON age_group.id=product.age_group_id";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['pro_name'];?></td>
<td><?php echo $row['cat_name'];?></td>
<td><?php echo $row['age'];?></td>
<td><?php echo $row['price'];?></td>
<td><a href="update_product.php?id=<?php echo $row['pro_id'];?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a><a href="delete_product.php?id=<?php echo $row['pro_id'];?>"><button class="btn btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></button></a></td>
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
