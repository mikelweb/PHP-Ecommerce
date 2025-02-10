<?php include('model/user.model.php')?>

<?php
class ProfileModel extends UserModel {

	function __construct($db) {
		parent::__construct($db);
		$this->getUserData($_SESSION['username']);
	}

	function getUserData($username) {
		$userdata = $this->db->query('SELECT * FROM User WHERE username = ?', $username)->fetchArray();
		$this->id = $userdata['id'];
		$this->username = $username;
		$this->email = $userdata['email'];
	}

	function updatedata($email, $password) {
		if($password != '') {
			// actualizamos pass
			$this->db->query('UPDATE User SET password = "'. sha1($password) .'" WHERE id = ?', $this->id);
		}
		return $this->db->query('UPDATE User SET email = "'. $email .'" WHERE id = ?', $this->id);
	}
	
	function getEmail() {
		return $this->email;
	}
}
?>