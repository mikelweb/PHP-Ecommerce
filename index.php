<?php
if(!isset($_GET['controller'])) {
	$controller = 'home';
} else {
	$controller = $_GET['controller'];
}
include('controller/' . $controller . '.controller.php')
?>