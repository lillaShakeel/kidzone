<?php
include('admin/dbc.php');
include('constant.inc.php');
session_start();
$item=0;
if(isset($_SESSION['shopping_cart']))
{
	$item = count($_SESSION['shopping_cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo FRONT_SITE_NAME?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_SITE_PATH?>css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_SITE_PATH?>css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_SITE_PATH?>css/style.css">
  <script src="<?php echo FRONT_SITE_PATH?>js/jquery.min.js"></script>
  <script src="<?php echo FRONT_SITE_PATH?>js/popper.min.js"></script>
  <script src="<?php echo FRONT_SITE_PATH?>js/bootstrap.min.js"></script>
  <script src="<?php echo FRONT_SITE_PATH?>js/sweetalert.min.js"></script>
  <script src="<?php echo FRONT_SITE_PATH?>js/bootstrap-show-password.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-xl-9 col-lg-8 col-md-7 col-sm-6">
<h2 class="my-4 font-weight-bold title-heading"><a href="<?php echo FRONT_SITE_PATH?>"><span class="text-info">K</span><span class="text-dark">IDZONE</span></a></h2>
</div>
<div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
<div class="row">
<div class="col-2 py-4">
<i class="fa fa-user-o fa-2x"></i>
</div>
<div class="col-5 py-3 float-right">
<span><a href="<?php echo FRONT_SITE_PATH?>register" class="text-dark">Register</a></span><br>
<span>or <a href="<?php echo FRONT_SITE_PATH?>login" class="text-info font-weight-bolder">Sign in</a></span>
</div>
<div class="col-5 py-4">
<a href="<?php echo FRONT_SITE_PATH?>cart" class="text-dark float-right"><i class="fa fa-shopping-bag fa-2x"></i><i class="badge badge-info badge-pill cart-badge"><?php echo $item;?></i></a>
</div>
</div>
</div>
</div>
</div>
	<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
		<div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
   <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>index" id="link">Shop</a>
      </li> 
  <!-- Categories -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Categories
      </a>
      <div class="dropdown-menu">
      <?php
	  $sql="select * from category";
	  $result=mysqli_query($con,$sql);
	  while($row=mysqli_fetch_array($result)){
	  ?>
        <a class="dropdown-item" href="<?php echo FRONT_SITE_PATH?>category?id=<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></a>
        <?php } ?>
      </div>
    </li>
    <!-- Age Group -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Age Group
      </a>
      <div class="dropdown-menu">
      <?php
	  $sql="select * from age_group";
	  $result=mysqli_query($con,$sql);
	  while($row=mysqli_fetch_array($result)){
	  ?>
        <a class="dropdown-item" href="<?php echo FRONT_SITE_PATH?>age_group?id=<?php echo $row['id'];?>"><?php echo $row['age'];?></a>
        <?php } ?>
      </div>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>contact" id="link">Contact</a>
      </li> 
      <?php
      if(isset($_SESSION['customer'])){
		  $sql="select * from customer where email='".$_SESSION['customer']."'";
		  $result=mysqli_query($con,$sql);
		  $customer=mysqli_fetch_array($result);
	  ?>
       <!-- Customer -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo $customer['name'];?>
      </a>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo FRONT_SITE_PATH?>profile">Profile</a>
      <a class="dropdown-item" href="<?php echo FRONT_SITE_PATH?>order_history">Order History</a>
        <a class="dropdown-item" href="<?php echo FRONT_SITE_PATH?>logout">Logout</a>
      </div>
    </li>
      <?php
	  }
	  ?>     
    </ul>
    <ul class="navbar-nav ml-auto">
   <li class="nav-item">
       <form method="post" action="<?php echo FRONT_SITE_PATH?>search">
       <div class="input-group">
        <input class="form-control" type="text" name="text" required placeholder="Search here...">
    <div class="input-group-append">
    <button class="btn btn-info" type="submit" name="search">Search</button>
    </div>
    </div>
  </form>
      </li>
    </ul>
    </div>
    </div>
</nav>