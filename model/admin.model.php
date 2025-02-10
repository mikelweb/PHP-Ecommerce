<?php
class AdminModel {

	private $db;
	
	function __construct($db) {
		$this->db = $db;
	}

	function getOrders() {
		return $this->db->query('
		SELECT * FROM `Order`
		JOIN Product_Order ON Order.id=Product_Order.orderId
		JOIN Product ON Product_Order.productId=Product.id
		')->fetchAll();
	}
}
?>