<?php include('view/header.php')?>
<?php include('model/login.model.php')?>

<?php 
$login = new Login();

if(isset($_POST['login'])) {
	$login->logUser($_POST);
}
?>
<?php include('view/login.template.php')?>
<?php include('view/footer.php')?>