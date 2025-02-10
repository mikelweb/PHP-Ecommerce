<?php

class Cart {

	public $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function getCartProducts() {
		$products = [];
		if(isset($_SESSION['cart'])) {
			foreach($_SESSION['cart'] as $key => $value) {
				$product = $this->db->query('SELECT * FROM Product WHERE id = ?', $key)->fetchArray();
				$product['quantity'] = $value;
				array_push($products, $product);
			}
		}
		return $products;
    }
}