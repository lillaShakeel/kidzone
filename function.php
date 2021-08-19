<?php

function sendEmail($email,$name,$subject,$body)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'mitf19e002@gmail.com';                 // SMTP username
	$mail->Password = 'Jgdyus1230@';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;    
	$mail->setFrom('mitf19e002@gmail.com', 'Shakeel Ahmad');
	$mail->addAddress($email, $name);     // Add a recipient 
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body    = $body;
	if($mail->send())
	{
		return true;
	}
	else{
		return false;
		
	}
	
}

function invoice($orderid){
	include('admin/dbc.php');
	$sql="select * from order_master where id='$orderid'";
	$result=mysqli_query($con,$sql);
	$order=mysqli_fetch_array($result);
	$html='<!doctype html>
	<head>
	<meta charset="utf-8">
	<title>Order Invoice</title>
	<style>
	@import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
	*{
		margin:0px;
		padding:0px;
		font-family: "Nunito Sans", Helvetica, Arial, sans-serif;	
	}
	.container-fluid{
		background-color:#F4F4F4;
	}
	.text-center{
		text-align:center;	
	}
	.heading{
		text-align:center;
		padding:25px 0 25px 0;
		letter-spacing:4px;	
	}
	.text-info{
		color:#17a2b8;
	}
	.center{
		margin:auto;
		width:60%;
		padding:40px 0 50px 0;
	}
	.block{
		background-color:#F4F4F4;
		margin:20px 0 50px 0;
		padding:15px 0 15px 10px;
	}
	table{
		width:100%;	
		border-collapse:collapse;
		margin-bottom:30px;
	}
	th, td{
		padding:10px;	
	}
	.pt-3{
		padding-top:20px;	
	}
	</style>
	</head>
	
	<body>
	<div class="container-fluid">
	<h1 class="heading"><span class="text-info">K</span>IDZONE</h1>
	</div>
	<div class="center">
	<h2>Hi, '.$order['name'].'</h2>
	<p>This is an invoice for your recent purchase.</p>
	<div class="block">
	<p><b>Order ID:</b> '.$order['id'].'</p>
	<p><b>Order Date:</b> '.date('d M, Y h:i',strtotime($order['added_on'])).'</p>
	</div>
	<table border="1">
	<tr>
	<th align="left">Product Name</th>
	<th align="left">Qty</th>
	<th align="right">Amount</th>
	</tr>';
	$total=0;
	$sql="select order_detail.qty, product.pro_name, product.price from order_master INNER JOIN order_detail ON order_master.id=order_detail.order_id INNER JOIN product ON order_detail.pro_id=product.pro_id where order_master.id='$orderid'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
	$total += $row['price']*$row['qty'];
	$html.='<tr>
	<td>'.$row['pro_name'].'</td>
	<td>'.$row['qty'].'</td>
	<td align="right">Rs. '.number_format($row['price']).'</td>
	</tr>';
	}
	$html.='<tr>
	<th colspan="2" align="right">Total</th>
	<th align="right">Rs. '.number_format($total).'</th>
	</tr>
	</table>
	<p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="mailto:mitf19e002@gmail.com">support team</a> for help.</p>
	<p class="pt-3">Cheers,</p>
	<p>kidZone Online Toys Shop</p>
	</div>
	</body>
	</html>';	
	return $html;
	
}
?>