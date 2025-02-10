<?php
class UserModel {

	protected $db;
	private $id;
	private $username;
	private $email;
	private $password;

	function __construct($db) {
		$this->db = $db;
	}

	function usernameExists($username) {
		return $this->db->query('SELECT id FROM User WHERE username = ?', $username)->numRows();
	}

	function createUser($email, $username, $password) {
		if(!$this->usernameExists($username)) {
			$this->db->query("INSERT INTO User (email, username, password) VALUES (?, ?, ?)", $email, $username, sha1($password));
			return "Usuario creado.";
		} else {
			return "El username ya existe. Elija otro.";
		}
	}
}
?>