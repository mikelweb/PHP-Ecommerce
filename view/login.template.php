
<!-- Custom styles for this template --> 
<link href="assets/css/login.css" rel="stylesheet">
<form class="form-signin" method="POST">
	<img class="mb-4" src="assets/img/logocampervan.png" alt="logo campervan">
	<h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

	<div class="form-floating">
		<input type="email" class="form-control" name="email" id="email" placeholder="Email">
		<label for="email">Email</label>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
		<label for="password">Contraseña</label>
	</div>
	
	<div class="checkbox mb-3">
		<label>
			<input type="checkbox" value="remember-me"> Recordar
		</label>
	</div>
	<button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Entrar</button>
	<h3 class="error"><?php if(isset($_GET['error'])) echo "Usuario o contraseña incorrecto";?></h3>
	<p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y');?></p>
</form>
