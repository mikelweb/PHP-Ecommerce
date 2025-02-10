<?php
include('view/header.php');
include('model/cart.model.php');

$cart = new Cart($db);
$products = $cart->getCartProducts(); 
$total = 0;
foreach($products as $product) {
	$total += $product['price'] * $product['quantity'];
}
echo (count($products) == 0) ? CartTemplate::emptyCart() : CartTemplate::cartTable($products, $total);

include('view/footer.php');
?>