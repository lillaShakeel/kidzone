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
View Customer
</div>
<div class="card-body">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Customer&nbsp;Name</th>
<th>Email</th>
<th>Contact</th>
<th>Verifaction&nbsp;Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from customer";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['contact'];?></td>
<td><?php 
	if($row['email_verify']==1){
		echo "<span class='badge badge-success'>Verified</span>";
	}
	else{
		echo "<span class='badge badge-warning'>Pending</span>";
	}
;?></td>
<td><a href="delete_customer.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash"></i></button></a></td>
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
