<?php
include('view/header.php');
include('view/product.template.php');
$product = new Product($db);
?>

<main>

  <div class="container">
	<?php
	// Show specffic product
	if(isset($_GET['prod'])) {
		$prodId = $_GET['prod'];
		$productObj = $product->getProduct($prodId);
		echo ProductTemplate::productPage($productObj);
	} else {
		// Show list of products
		$products = $product->getAllProducts();
		echo ProductTemplate::showProducts($products);
	}  
	?>
	
  </div>
</main>

<?php include('view/footer.php')?>
