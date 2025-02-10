<?php
class Template {

	public static function logo() {
		echo '
			<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
			  <img src="assets/img/logocampervan.png" height="40">
			</a>';
	}

	public static function navigationMenu($categories) {
		echo '
			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
			  <li><a href="products" class="nav-link px-2 text-white">Productos</a></li>
			  <li class="dropdown">
				<a class="nav-link px-2 text-white dropdown-toggle" href="categories"" id="categories" data-bs-toggle="dropdown">Categorías</a>
				  <ul class="dropdown-menu" aria-labelledby="categories" >';
				  foreach($categories as $category) {
					echo '<li><a class="dropdown-item" href="categories?cat='.$category['id'].'">'.$category['name'].'</a></li>';
				  }
				echo '</ul></li>
			</ul>';
	}

	public static function searchForm($products) {
		echo '
			<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
			  <input type="text" class="form-control search" placeholder="&#xF002" style="font-family:Arial, FontAwesome" />
			  <div id="resultscontainer">';
			  foreach($products as $product) {
				echo '<div class="finder">
						<a class="" href="products?prod='.$product['id'].'">'.$product['name'].'</a>
					  </div>';
			  }
		echo '</div>
			</form>';
	}

	public static function loginRegisterButtons() {
		echo '
			<div class="text-end">
			  <a class="btn btn-outline-light me-2" href="login">Login</a>
			  <a class="btn btn-warning" href="signup">Registrarse</a>
			</div>';
	}

	public static function myAccountButton() {
		$res = '
			<div class="dropdown text-end">
			  <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle white" data-bs-toggle="dropdown" aria-expanded="false">
				Hola '.$_SESSION['username'].'
			  </a>
			  <ul class="dropdown-menu text-small">';
		if(GlobalFunctions::isAdmin()) {
			$res .= '<li><a class="dropdown-item" href="admin">Administrador</a></li>';
		}
		$res .= '
				<li><a class="dropdown-item" href="profile">Mi perfil</a></li>
				<li><a class="dropdown-item" href="orders">Mis pedidos</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="logout.php?redirect='.$_SERVER['PHP_SELF'].'">Logout</a></li>
			  </ul>
			</div>';
		return $res;
	}
	
	public static function message() {
		echo '
		<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
			<div class="toast-header">
				<strong class="me-auto"></strong>
			  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
			  
			</div>
		  </div>
		</div>';
		}
}
?>