<?php
class SignupTemplate {
	public static function signupForm($email, $username, $result) {

	return'
	<link href="assets/css/signup.css" rel="stylesheet">

	<form class="form-signin" method="post">
		<img class="mb-4" src="assets/img/logocampervan.png" alt="logo campervan">
		<h1 class="h3 mb-3 fw-normal">Registro</h1>

		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="'.$email.'">
			<label for="email">Email</label>
		</div>
		<div class="form-floating">
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="'.$username.'">
			<label for="username">Username</label>
		</div>
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			<label for="password">Contraseña</label>
		</div>
		<div class="form-floating">
			<input type="password" class="form-control" id="password2" name="password2" placeholder="Repetir contraseña">
			<label for="password2">Repetir contraseña</label>
		</div>
		<h3 class="error">'.$result.'</h3>
		<input class="w-100 btn btn-lg btn-secondary" type="button" value="Generar contraseña" id="rand" style="margin-bottom:10px">
		<input class="w-100 btn btn-lg btn-primary" type="submit" value="Crear cuenta" name="submitBtn">
	</form>';
	}
}