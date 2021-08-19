<?php
include('header.php');
if(isset($_POST['add_to_cart'])){
	if(isset($_SESSION['shopping_cart']))
	{
		$item_array_id= array_column($_SESSION['shopping_cart'], 'item_id');
		if(!in_array($_GET['id'], $item_array_id))
		{
			$count = count($_SESSION['shopping_cart']);
			$item_array = array(
			'item_id'	=> $_GET['id'],
			'item_image'	=> $_POST['hidden_image'],
			'item_name'	=> $_POST['hidden_name'],
			'item_price'	=> $_POST['hidden_price'],
			'item_quantity'	=> $_POST['quantity']
			);
			$_SESSION['shopping_cart'][$count] = $item_array;
			$title="Successfull";
			$message="Product add to cart successfully";
			$icon="success";
			$page="index";	
			include "message.php";
		}
		else
		{
			$title="Warning";
			$message="This product already added";
			$icon="warning";
			$page="index";	
			include "message.php";
		}
	}
	else
	{
		$item_array = array(
		'item_id'	=> $_GET['id'],
		'item_image'	=> $_POST['hidden_image'],
		'item_name'	=> $_POST['hidden_name'],
		'item_price'	=> $_POST['hidden_price'],
		'item_quantity'	=> $_POST['quantity']
		);
		$_SESSION['shopping_cart'][0] = $item_array;
		$title="Successfull";
		$message="Product add to cart successfully";
		$icon="success";
		$page="index";	
		include "message.php";
	}
}
if(isset($_GET['action']))
{
	if($_GET['action']== 'delete')
	{
		foreach($_SESSION['shopping_cart'] as $keys => $values)
		{
			if($values['item_id'] == $_GET['id'])
			{
				unset($_SESSION['shopping_cart'][$keys]);
				$title="Successfull";
				$message="Item deleted successfully";
				$icon="success";
				$page="cart";	
				include "message.php";
			}
		}
	}
}
?>