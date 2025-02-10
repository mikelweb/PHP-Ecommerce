<?php
include('view/header.php');
if(!GlobalFunctions::isLogged()) {
	header('Location: login');
}
include('model/profile.model.php');
include('view/profile.template.php');

$profile = new ProfileModel($db);
$updated = false;
if(isset($_POST['email'])) {
	$updated = $profile->updatedata($_POST['email'], $_POST['password']);
	$email = $_POST['email'];
} else {
	$email = $profile->getEmail();
}
$username = $_SESSION['username'];

echo ProfileTemplate::profileForm($username, $email, $updated)?>

<?php include('view/footer.php')?>