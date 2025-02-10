<?php
session_start();

if(isset($_POST['function'])) {

	$action = $_POST['function'];
	
	switch($action) {
		// add to cart product
		case 'addtocart':
			// if id varibale is posted
			if(isset($_POST['id'])) {
				$prodId = $_POST['id'];

				//if cart session varibale is not setted
				if(!isset($_SESSION['cart'])) {
					//declare an empty array
					$_SESSION['cart'] = [];
				}
				// if already declared this key
				if(isset($_SESSION['cart'][$prodId])) {
					// increment in one item
					$_SESSION['cart'][$prodId]++;
				} else {
					// set to one item
					$_SESSION['cart'][$prodId] = 1;
				}
				
				// echo "<pre>";
				// print_r($_SESSION['cart']);
				// echo "</pre>";
			}
			break;

		case 'deleteitem':
			// if id varibale is posted
			if(isset($_POST['id'])) {
				$prodId = $_POST['id'];

				// if already declared this key
				if(isset($_SESSION['cart'][$prodId])) {
					// delete item from array
					unset($_SESSION['cart'][$prodId]);
					echo 1;
				}
			}
			break;
	}
}
?>