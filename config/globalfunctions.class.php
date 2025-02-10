<?php

class GlobalFunctions {

	public static function pageTitle($url) {
		/**
		 * Devuelve el título de cada página
		 *
		 * This method is used to retrieve the page names to use on <title> tag
		 * This is necessary because I use a common HTML header, by using an
		 * include header.php
		 *
		 * @access public
		 * @param string
		 * @return string
		 */

		$title = [
			"/index.php" => "Portada",
			"/login.php" => "Login",
			"/signup.php" => "Registro",
			"/products.php" => "Productos",
			"/categories.php" => "Categorías",
			"/cart.php" => "Carrito",
			"/profile.php" => "Mi perfil",
			"/orders.php" => "Mis pedidos",
			"/admin.php" => "Admin panel"
		];
		return $title[$url];

	}

	public static function isLogged() {
		/**
		 *  
		 *
		 *   
		 *
		 * @access public
		 * @param 
		 * @return boolean
		 */
		

		return (isset($_SESSION['username']));

	}
	
	public static function isAdmin() {
		/**
		 *  
		 *
		 *   
		 *
		 * @access public
		 * @param 
		 * @return boolean
		 */
		
		return (isset($_SESSION['admin']));

	}

}


?>