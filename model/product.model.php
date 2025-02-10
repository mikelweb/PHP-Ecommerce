<?php
class Product {
	public $db;
	public $id;
    public $name;
	public $description;
	public $img;
    public $price;

    public function __construct($db, $id = null, $name = null, $description = null, $img = null, $price = null) {
        $this->db = $db;
		$this->id=$id;
		$this->name = $name;
		$this->description = $description;
		$this->img = $img;
		$this->price = $price;
    }
	
	public function getProduct($prodId) {
		$prod = $this->db->query('SELECT * FROM Product WHERE id = ?', $prodId)->fetchArray();
		return new Product(null, $prod['id'], $prod['name'], $prod['description'], $prod['img'], $prod['price']);
	}
	
	public function getAllProducts() {
		$productObjsArray = [];
		$products = $this->db->query('SELECT * FROM Product')->fetchAll();
		foreach($products as $prod) {
			$productObj = new Product(null, $prod['id'], $prod['name'], $prod['description'], $prod['img'], $prod['price']);
			array_push($productObjsArray, $productObj);
		}
		return $productObjsArray;
	}

	public function getProductsByCat($catId) {
		$productObjsArray = [];
		$products = $this->db->query('SELECT * FROM Product WHERE cat = ?', $catId)->fetchAll();
		foreach($products as $prod) {
			$productObj = new Product(null, $prod['id'], $prod['name'], $prod['description'], $prod['img'], $prod['price']);
			array_push($productObjsArray, $productObj);
		}
		return $productObjsArray;
	}	
}

?>