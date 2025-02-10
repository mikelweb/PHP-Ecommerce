<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('cart.template.php');
include('model/product.model.php');
include('config/globalfunctions.class.php');
include('template.class.php');
include('config/db.class.php');
$db = new Db;
$categories = $db->query('SELECT * FROM Category')->fetchAll();
$products = $db->query('SELECT * FROM Product')->fetchAll();
?>


<!doctype html>
<!--
Desarrollado por Mikel Goyeneche (4º Ingeniría Informática - UOC)
;)
-->
<html lang="es" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mikel Goyeneche">
    <meta name="generator" content="mikel uoc">
    <title><?php echo GlobalFunctions::pageTitle($_SERVER['PHP_SELF'])?> - Productos Camper</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<meta name="theme-color" content="#712cf9">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
	  <!--<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">-->
	  <header class="p-3 text-bg-dark">
		<div class="container">
		  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

			<?php Template::logo()?>

			<?php Template::NavigationMenu($categories)?>

			<?php Template::SearchForm($products)?>

			<?php
			if(!GlobalFunctions::isLogged()) {
				Template::loginRegisterButtons();
			} else {
				echo Template::myAccountButton();
			}
			?>			

			<?php CartTemplate::shoppingCart()?>

		  </div>
		</div>
	  </header>