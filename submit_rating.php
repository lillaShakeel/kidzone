<?php
include("admin/dbc.php");
date_default_timezone_set("Asia/Karachi");
$connect = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
if(isset($_POST["rating_data"]))
{

	$data = array(
		':customer_name'		=>	$_POST["customer_name"],
		':customer_email'		=>	$_POST["customer_email"],
		':product_id'		=>	$_POST["product_id"],
		':user_rating'		=>	$_POST["rating_data"],
		':customer_review'		=>	$_POST["customer_review"],
		':date'			=>	date('Y-m-d'),
		':time'			=>	date('H:i:s')
	);

	$query = "
	INSERT INTO review 
	(pro_id, name, email, rating, review, date, time) 
	VALUES (:product_id, :customer_name, :customer_email, :user_rating, :customer_review, :date, :time)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}
if(isset($_POST["action"]))
{
	$product_id=$_POST["product_id"];
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "SELECT * from review where pro_id='$product_id' ORDER BY id DESC";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'customer_name'		=>	$row["name"],
			'customer_review'	=>	$row["review"],
			'rating'		=>	$row["rating"],
			'date'		=>	date('d, M Y',strtotime($row["date"])),
			'time'		=>	date('h:i A',strtotime($row["time"]))
		);

		if($row["rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>