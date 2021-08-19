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
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
<nav class="navbar bg-light">
  <div class="container">
      <ol class="breadcrumb py-3 m-0">
        <li class="breadcrumb-item"><a href="<?php echo FRONT_SITE_PATH?>" class="text-dark">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Shop</li>
      </ol>
  </div>
</nav>
  
<div class="container">
<div class="row">
<?php
$id=$_REQUEST['id'];
$sql="select * from product where pro_id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
?>
<div class="col-md-6 my-5 preview-img-block">
<img src="image/<?php echo $row['image'];?>" class="preview-img">
</div>
<div class="col-md-6 my-5">
<h2><?php echo $row['pro_name'];?></h2>
<div class="mb-4">
<i class="fa fa-star text-secondary mr-1 main_star"></i>
<i class="fa fa-star text-secondary mr-1 main_star"></i>
<i class="fa fa-star text-secondary mr-1 main_star"></i>
<i class="fa fa-star text-secondary mr-1 main_star"></i>
<i class="fa fa-star text-secondary mr-1 main_star"></i>
<span id="total_review"> 0</span> Review
</div>
<h3 class="pb-4">Rs. <?php echo number_format($row['price']);?></h3>
<p><i class="fa fa-truck fa-2x"></i> Products are usually delivered in <b>3-5 Business Days</b></p>
<form method="post" action="<?php echo FRONT_SITE_PATH?>add_to_cart?action=add&id=<?php echo $row['pro_id'];?>">
<input type="hidden" name="hidden_image" value="<?php echo $row['image'];?>">
<input type="hidden" name="hidden_name" value="<?php echo $row['pro_name'];?>">
<input type="hidden" name="hidden_price" value="<?php echo $row['price'];?>">
<div class="row">
<div class="col-md-6">
<div class="input-group">
 <div class="input-group-prepend">
    <button type="button" class="btn btn-info" onClick="dec()">-</button>
    </div>
        <input class="text-center form-control" type="number" id="qty" name="quantity" value="1" required pattern="[0-9]" min="1" max="100" required>
    <div class="input-group-append">
    <button type="button" class="btn btn-info" onClick="inc()">+</button>
    </div>
    </div>
    </div>
    </div>
<button type="submit" name="add_to_cart" class="btn btn-info mt-3 mb-4">Add to Cart</button>
</form>
<h3>Product Description:-</h3>
<p class="text-justify"><?php echo $row['description'];?></p>
</div>


<div class="col-md-12 mb-5">
<div class="row">
<div class="col-md-12">
<h2 class="pb-4">Related Products</h2>
</div>
<div class="col-md-12">
<div class="card-group">

<?php
$sql1="select category.cat_name, age_group.age, product.pro_id, product.pro_name, product.price, product.description, product.image from product INNER JOIN category ON category.id=product.cat_id INNER JOIN age_group on age_group.id=product.age_group_id where product.cat_id='".$row['cat_id']."' OR product.age_group_id='".$row['age_group_id']."' ORDER BY product.pro_id DESC LIMIT 5";
$result1=mysqli_query($con,$sql1);
while($row1=mysqli_fetch_array($result1)){
	if($row1['pro_id']!=$row['pro_id'])
	{
?>

<div class="col-lg-3 col-md-4 mb-4">
<a href="<?php echo FRONT_SITE_PATH?>product_single?id=<?php echo $row1['pro_id'];?>">
<div class="card">
<img src="image/<?php echo $row1['image'];?>" class="card-img-top">
<div class="card-body">
<div class="card-title text-dark"><b><?php echo $row1['pro_name'];?></b></div>
<div class="card-text text-dark"><i>Rs. <?php echo number_format($row1['price']);?></i></div>
<div class="card-text text-success"><?php echo $row1['cat_name'];?></div>
<div class="card-text text-primary"><?php echo $row1['age'];?></div>
<form method="post" action="<?php echo FRONT_SITE_PATH?>add_to_cart?action=add&id=<?php echo $row1['pro_id'];?>">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="hidden_image" value="<?php echo $row1['image'];?>">
<input type="hidden" name="hidden_name" value="<?php echo $row1['pro_name'];?>">
<input type="hidden" name="hidden_price" value="<?php echo $row1['price'];?>">
<button type="submit" name="add_to_cart" class="btn btn-info mt-3">Add to Cart <i class="fa fa-cart-plus"></i></button>
</form>
</div>
</div>
</a>
</div>
<?php
	}
 } ?>


</div>
</div>
</div>



</div>


<div class="col-md-12 mb-5">
<div class="row">
<div class="col-md-12">
<h2 class="pb-3">Customer Reviews</h2>
</div>
</div>
                <div class="row">
                <div class="col-md-3">
                <div class="row">
                <div class="col-md-12">
    					<h3 class="text-warning mt-4 mb-2">
    						<b><span id="average_rating">0.0</span> / 5.0</b>
    					</h3>
    					<div class="mb-2">
    						<i class="fa fa-star text-secondary mr-1 main_star_one"></i>
                            <i class="fa fa-star text-secondary mr-1 main_star_one"></i>
                            <i class="fa fa-star text-secondary mr-1 main_star_one"></i>
                            <i class="fa fa-star text-secondary mr-1 main_star_one"></i>
                            <i class="fa fa-star text-secondary mr-1 main_star_one"></i>
	    				</div>
    					<h6>Based on <span id="total_review_one">0</span> Review</h6>
    				</div>
                    <div class="col-md-12">
    					<p>
                            <div class="float-left mr-2"><b>5</b> <i class="fa fa-star text-warning"></i></div>
                            <div class="float-right ml-2">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="float-left mr-2"><b>4</b> <i class="fa fa-star text-warning"></i></div>
                            <div class="float-right ml-2">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="float-left mr-2"><b>3</b> <i class="fa fa-star text-warning"></i></div>
                            <div class="float-right ml-2">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="float-left mr-2"><b>2</b> <i class="fa fa-star text-warning"></i></div>
                            <div class="float-right ml-2">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="float-left mr-2"><b>1</b> <i class="fa fa-star text-warning"></i></div>
                            <div class="float-right ml-2">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
                    
                    <div class="col-md-12 mt-3">
                    <button class="btn btn-info" data-toggle="collapse" data-target="#review" aria-expanded="true" aria-controls="review">Write a Review</button>
                    </div>
                </div>
                </div>
                <div class="col-md-9">
                <div id="review" class="collapse fade">
                <div class="card my-4">
                    <div class="card-body">
                    <span>Your Rating</span>
       <h4 class="mt-1 mb-2">
	        		<i class="fa fa-star text-secondary submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fa fa-star text-secondary submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fa fa-star text-secondary submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fa fa-star text-secondary submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fa fa-star text-secondary submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	    </h4>
        <input type="hidden" name="product_id" id="product_id" value="<?php echo $id;?>">
        <label>Name<i class="text-danger">*</i></label>
        <input type="text" name="customer_name" id="customer_name" class="form-control mb-2 ">
        <label>Email<i class="text-danger">*</i></label>
        <input type="email" name="customer_email" id="customer_email" class="form-control mb-2 ">
        <label>Your Review<i class="text-danger">*</i></label>
        <textarea name="customer_review" id="customer_review" class="form-control mb-2" required rows="5"></textarea>
        <button class="btn btn-info mt-3 mb-2" id="save_review">Submit</button>
                    </div>
                    </div>

</div>
<div id="review_content" class="mt-3">
 
             
</div>
                
                
</div>
</div>
</div>

</div>
</div>
<?php
include('footer.php');
?>
<script>


// Item qty button

var x=1;
var element=document.getElementById('qty').value=x;
function inc(){
document.getElementById('qty').value=++x;	
	
}
function dec(){
document.getElementById('qty').value=--x;

}


// Item qty button

var rating_data = 0;

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('text-secondary');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('text-secondary');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });
	
	
		$('#save_review').click(function(){
			
		var customer_name = $('#customer_name').val();
		
		var customer_email = $('#customer_email').val();
		
		var product_id = $('#product_id').val();

        var customer_review = $('#customer_review').val();

        if(rating_data<=0)
        {
            swal("Warning!", "Please select rating", "warning");
            return false;
        }
		else if(customer_name == '')
        {
            swal("Warning!", "Please enter your name", "warning");
            return false;
        }
		else if(customer_email == '')
        {
            swal("Warning!", "Please enter your email address", "warning");
            return false;
        }
		else if(customer_review == '')
        {
            swal("Warning!", "Please enter your review", "warning");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, customer_name:customer_name, customer_email:customer_email, product_id:product_id, customer_review:customer_review},
                success:function(data)
                {
                    
					
					swal("Successfull", data, "success");
					load_rating_data();
                }
            })
        }

    });
	load_rating_data();

     function load_rating_data()
    {
		var product_id = $('#product_id').val();
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{action:'load_data', product_id:product_id},
            dataType:"JSON",
            success:function(data)
            {
				if(data.average_rating>0.0){
					
					$('#average_rating').text(data.average_rating);
				}                
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('text-secondary');
                    }
                });
				$('#total_review_one').text(data.total_review);

                var count_star = 0;

                $('.main_star_one').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('text-secondary');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="card mb-3">';

                        html += '<div class="card-header">'+data.review_data[count].customer_name+'</div>';

                        html += '<div class="card-body">';
						for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'text-secondary';
                            }

                            html += '<i class="fa fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<p class="card-text">'+data.review_data[count].customer_review+'</p>';

                        html += '</div>';

                        html += '<div class="card-footer text-right">';
						
						html += '<span>';
						
						html += data.review_data[count].date;
						
						html += ' ';
						
						html += data.review_data[count].time;
						
						html += '</span>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }
	
	</script>
