<?php
class ProfileTemplate {
	
	public static function profileForm($username, $email, $updated) {
		if($updated) {
			$updated = "Guardado";
		} else {
			$updated = "";	
		}
		return '
	<link href="assets/css/profile.css" rel="stylesheet">
	<form class="form-updatedata" method="post">
		<h1 class="h3 mb-3 fw-normal">Modificar datos</h1>
		<div class="form-floating">
			<input type="text" class="form-control" id="username" placeholder="Username" readonly="readonly" value="'.$username.'">
			<label for="username">Username</label>
		</div>
		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="'.$email.'">
			<label for="email">Email</label>
		</div>
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
			<label for="password">Contraseña</label>
		</div>
		<span>(Contraseña en blanco para mantener la actual)</span><br>
		<br>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Guardar</button>
		<h3 class="error">'.$updated.'</h3>
	</form>';
	}
}