<?php include('model/user.model.php')?>

<?php
class OrderModel extends UserModel {

	function __construct($db) {
		parent::__construct($db);
		if(isset($_SESSION['username'])) {
			$this->getUserData($_SESSION['username']);
		}
	}

	function getUserData($username) {
		if($userdata = $this->db->query('SELECT * FROM User WHERE username = ?', $username)->fetchArray()) {
			$this->id = $userdata['id'];
		}
	}

	function getUserOrders() {
		return $this->db->query('
		SELECT * FROM `Order` JOIN Product_Order ON Order.id=Product_Order.orderId
		JOIN Product ON Product_Order.productId=Product.id
		WHERE userId=?', $this->id)->fetchAll();
	}

	function newOrder($products, $orderData) {
		$data = $orderData["firstName"] . " " . $orderData["lastName"] . " - " . $orderData["address"];

		if(isset($_SESSION["username"])) {
			$orderData["username"] = $_SESSION["username"];
			$this->getUserData($orderData["username"]);
			$userId = $this->id;
		} else {
			$userId = null;
		}
		$this->db->query("INSERT INTO `Order` (userId, data) VALUES (?, ?)", $userId, $data);

		$orderId = $this->db->lastInsertID();
		// iterar sobre los productos e insertar 1 linea en Product_Order
		foreach($products as $product) {
			$this->db->query("INSERT INTO `Product_Order` (orderId, productId) VALUES (?, ?)", $orderId, $product["id"]);
		}
	}

	
}
?>