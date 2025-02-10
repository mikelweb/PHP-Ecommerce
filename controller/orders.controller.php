<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('view/header.php');
if(!GlobalFunctions::isLogged()) {
	header('Location: login');
}
include('view/userorder.template.php');
include('model/order.model.php');

$orderModel = new OrderModel($db);
$orders = $orderModel->getUserOrders();

/*echo "<pre>";
print_r($orders);
echo "</pre>";*/

$filteredOrders = [];
foreach($orders as $product) {
	if(array_key_exists($product["orderId"], $filteredOrders)) {
		$existe = false;
		foreach($filteredOrders[$product["orderId"]]["products"] as $prod) {
			if($prod->id == $product["productId"]) {
				$existe = true;
				break;
			}
		}
		if($existe) {
			$prod->quantity++;
			$prod->description = "existe";
		} else {
			$productObj = new Product(null, $product["productId"], $product["name"], null, $product["img"], $product["price"]);
			$productObj->quantity = 1;
			$productObj->description = "mo existe";
			array_push($filteredOrders[$product["orderId"]]["products"], $productObj);
		}
	} else {
		$filteredOrders[$product["orderId"]]["id"] = $product["orderId"];
		$filteredOrders[$product["orderId"]]["date"] = $product["date"];
		$productObj = new Product(null, $product["productId"], $product["name"], null, $product["img"], $product["price"]);
		$productObj->quantity = 1;
		$productObj->description = "no existe orden aun";
		$filteredOrders[$product["orderId"]]["products"] = [];
		array_push($filteredOrders[$product["orderId"]]["products"], $productObj);
	}
}

/*echo "<pre>";
print_r($filteredOrders);
echo "</pre>";*/

echo UserOrderTemplate::orderTable($filteredOrders);

include('view/footer.php')?>