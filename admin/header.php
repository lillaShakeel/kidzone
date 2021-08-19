<?php
include_once "session.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>kidZone</title>
<meta name="viewport" content="device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../datatables/css/jquery.dataTables.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../datatables/js/jquery.dataTables.min.js"></script>
<script src="../js/bootstrap-show-password.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">

<body>
<nav class="navbar navbar-expand-sm bg-info navbar-dark">
	<div class="container-fluid">
    <a class="navbar-brand font-weight-bolder" href="home.php">kidZone Online Toy Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav ml-auto">
  	<!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white" id="link" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo $admin['name'];?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="manage_account.php"><i class="fa fa-cog"></i> Manage Account</a>
         <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>  
    </ul>

    </div>


    </div>
</nav>