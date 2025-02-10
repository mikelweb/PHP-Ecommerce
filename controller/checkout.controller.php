<?php
include('view/header.php');
include('view/checkout.template.php');
include('model/cart.model.php');
include('model/order.model.php');

$cart = new Cart($db);
$products = $cart->getCartProducts(); 
$total = 0;
$quantity = 0;
foreach($products as $product) {
	$quantity += 1 * $product['quantity']; 
	$total += $product['price'] * $product['quantity'];
}
$data = [];
// Si se ha submitido el formulario (si se ha pinchado en Pagar)
if(isset($_POST["firstName"])) {
	$data = [
		"firstName" => $_POST["firstName"],
		"lastName" => $_POST["lastName"],
		"email" => $_POST["email"],
		"account" => isset($_POST['account']) ? true : false,
		"address" => $_POST["address"],
		"ccname" => $_POST["ccname"],
		"ccname" => $_POST["ccname"],
		"ccnumber" => $_POST["ccnumber"],
		"ccname" => $_POST["ccname"],
		"ccexpiration" => $_POST["ccexpiration"],
		"cccvv" => $_POST["cccvv"],
		"error" => ""
	];
	
	// Si se va a crear cuenta
	if(isset($data["account"]) && $data["account"]) {
		$data["username"] = $_POST["username"];
		// Si las passwords no coinciden
	    if($_POST["password"] != $_POST["password2"]) {
			$data["error"] = "Las contraseñas no coinciden";
		} else {
			// Creamos cuenta nueva
			$_SESSION["username"] = $data["username"];
			$data["password"] = $_POST["password"];
			$order = new OrderModel($db);
			echo $order->createUser($data["email"], $data["username"], $data["password"]);
			echo $order->newOrder($products, $data);
			echo CheckoutTemplate::checkoutFormSuccess();
			include('view/footer.php');
			$_SESSION["cart"] = [];
			exit;
		}
	} else {
		$order = new OrderModel($db);
		echo $order->newOrder($products, $data);
		echo CheckoutTemplate::checkoutFormSuccess();
		include('view/footer.php');
		$_SESSION["cart"] = [];
		exit;
	}
}


echo (count($products) == 0) ? CheckoutTemplate::emptyCart() : CheckoutTemplate::checkoutForm($quantity, $products, $total, $data);

?>