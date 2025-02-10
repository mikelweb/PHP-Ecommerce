<?php include('model/user.model.php')?>
<?php include('view/header.php')?>
<?php include('view/signup.template.php')?>

<?php
$username = "";
$email = "";
$result = "";
// Validate from fields
if(isset($_POST['submitBtn'])) {
	if(!isset($_POST['email']) || $_POST['email'] == "") {
		$result = "Email no rellenado";
	} else {
		$email = $_POST['email'];
		if(!isset($_POST['username']) || $_POST['username'] == "") {
			$result = "Usuario no rellenado";
		} else {
			$username = $_POST['username'];
			if(!isset($_POST['password']) || $_POST['password'] == "") {
				$result = "Contraseña no rellenada";
			} else {
				if(!isset($_POST['password2']) || $_POST['password2'] == "") {
					$result = "Repeticón de contraseña no rellenada";
				} else {
					if($_POST['password'] !== $_POST['password2']) {
						$result = "Las contraseñas no coinciden";
					} else {
						$email = $_POST['email'];
						$username = $_POST['username'];
						$password = $_POST['password'];
						$user = new UserModel($db);
						$result = $user->createUser($email, $username, $password);
					}
				}
			}
		}
	}
}

echo SignupTemplate::signupForm($email, $username, $result);

?>


<?php include('view/footer.php')?>