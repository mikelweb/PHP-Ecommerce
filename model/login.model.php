<?php
class Login {

	private $db;
	
	function __construct() {
		$this->db = new Db;
  	}
	
	function sessionStart($user) {
		$_SESSION['username'] = $user['username'];
	}

	function sessionAdminStart() {
		$_SESSION['admin'] = 2;
	}

	function logUser($postArray) {
		if(isset($postArray['login'])) {

			if(isset($postArray['email']) && isset($postArray['password'])) {
				$email = $postArray['email'];
				$password = sha1($postArray['password']);

				$user = $this->db->query('SELECT * FROM User WHERE email = ? AND password = ?', $email, $password)->fetchArray();

				if(empty($user)) {
					header('Location: '.$_SERVER['REQUEST_URI'].'?error=1');
				} else {
					$this->sessionStart($user);
					if($user['role'] > 1) {
						$this->sessionAdminStart();
					}
					$this->trackLastLogin($user['id']);
					header('Location: index.php');
				}
			}
		}
	}
	
	// Save DATETIME when login
	function trackLastLogin($userId) {
		$result = $this->db->query('UPDATE User SET lastlogin = "'. date("Y-m-d H:i:s") .'" WHERE id = ?', $userId);
	}
}
?>