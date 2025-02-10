<?php
class CheckoutTemplate {

	public static function emptyCart() {
		return "No hay producto en el carrito";
	}
	public static function checkoutFormSuccess() {
		return '<br><br><br><br><br><br><br>
		<center>Gracias por tu compra... Recibirás un email con el resumen de tu pedido... bla bla bla</center>';
	}
	
	public static function checkoutCartRow($product) {
		return '
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">'.$product["quantity"].' x</h6>
              <small class="text-muted">'.$product["name"].'</small>
            </div>
            <span class="text-muted">'.$product["price"] * $product["quantity"].' €</span>
          </li>';
	}

	public static function checkoutForm($quantity, $products, $total, $data) {
		if(empty($data)) {
			$data = [
				"firstName" => "",
				"lastName" => "",
				"email" => "",
				"address" => "",
				"account" => "",
				"username" => "",
				"ccname" => "",
				"ccname" => "",
				"ccnumber" => "",
				"ccname" => "",
				"ccexpiration" => "",
				"cccvv" => "",
				"error" => ""
			];
		}
		$res = '
<div class="container">
    <main>
		<div class="py-5 text-center">
			<h2>Checkout</h2>
		</div>
		<div class="row g-5">
			<div class="col-md-5 col-lg-4 order-md-last">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-primary">Carrito</span>
					<span class="badge bg-primary rounded-pill">'.$quantity.'</span>
				</h4>
				<ul class="list-group mb-3">
					';
					foreach($products as $product) {
					$res .= CheckoutTemplate::checkoutCartRow($product);
					}
					$res .= '
					<li class="list-group-item d-flex justify-content-between">
						<span>Total</span>
						<strong>'.$total.' €</strong>
					</li>
				</ul>
			</div>
			<div class="col-md-7 col-lg-8">
				<form class="needs-validation" method="post">
					<h4 class="mb-3">Datos personales</h4>
					<div class="row g-3">
						<div class="col-sm-6 form-group">
							<label for="firstName" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="firstName" name="firstName" value="'.$data["firstName"].'" required>
						</div>
						<div class="col-sm-6 form-group">
							<label for="lastName" class="form-label">Apellido</label>
							<input type="text" class="form-control" id="lastName" name="lastName" value="'.$data["lastName"].'" required>
						</div>
					</div>
					<div class="row g-3">
						<div class="col-12 form-group">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="'.$data["email"].'" required>
						</div>
					</div>
					<div class="row g-3">
						<div class="col-12 form-group">
							<label for="address" class="form-label">Dirección completa</label>
							<input type="text" class="form-control" id="address" name="address" value="'.$data["address"].'" required>
						</div>
					</div>
					<br>';
			
			if(!isset($_SESSION["username"])) {
				$res .= '
					<div class="row g-3">
						<div class="col-12 form-group">
							<input type="checkbox" class="form-check-input" id="account" name="account" checked>
							<label class="form-check-label" for="account">Crear cuenta</label>
						</div>
					</div>
					<div class="row g-3 togglePass">
						<div class="col-sm-4 form-group">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" value="'.$data["username"].'">
						</div>
						<div class="col-sm-4 form-group">
							<label for="password" class="form-label">Contraseña</label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
						<div class="col-sm-4 form-group">
							<label for="password2" class="form-label">Repetir contraseña</label>
							<input type="password" class="form-control" id="password2" name="password2">
						</div>
					</div>';
			}
			$res .= '
					<br>
					<h4 class="mb-3">Pago</h4>
					<div class="row gy-3">
						<div class="col-md-6">
							<label for="ccname" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="ccname" name="ccname" value="'.$data["ccname"].'" required>
							<small class="text-muted">Nombre completo tal y como se muestra en la tarjeta</small>
						</div>
						<div class="col-md-6">
							<label for="ccnumber" class="form-label">Número de tarjeta</label>
							<input type="text" class="form-control" id="ccnumber" name="ccnumber" value="'.$data["ccnumber"].'" required>
						</div>
						<div class="col-md-3">
							<label for="ccexpiration" class="form-label">Caducidad</label>
							<input type="text" class="form-control" id="ccexpiration" name="ccexpiration" value="'.$data["ccexpiration"].'" required>
						</div>
						<div class="col-md-3">
							<label for="cccvv" class="form-label">CVV</label>
							<input type="text" class="form-control" id="cccvv" name="cccvv" value="'.$data["cccvv"].'" required>
						</div>
					</div>
					<br><br>
					<button class="btn btn-primary btn-lg" type="submit">Realizar compra</button>
				</form>
			</div>
		</div>
	</main>
</div>
<br><br>';
	return $res;
	}
}
?>
