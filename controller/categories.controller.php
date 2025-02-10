<?php
include('view/header.php');
include('model/category.model.php');
include('view/category.template.php');
include('view/product.template.php');

$category = new Category($db);
$product = new Product($db);

?>
<link rel="stylesheet" href="categories.css">
<main>
<div class="container">
	<?php
	// Show specffic category, and its products
	if(isset($_GET['cat'])) {
		$catId = $_GET['cat'];
		$categoryObj = $category->getCategory($catId);
		echo CategoryTemplate::showCategory($categoryObj);
		$productObjsArray = $product->getProductsByCat($catId);
		echo ProductTemplate::showProducts($productObjsArray, 4);
	} else {
		// Show list of categories
		$categoryObjsArray = $category->getCategories();
		echo CategoryTemplate::showCategories($categoryObjsArray);
	}
    ?>
</div>
</main>
<?php include('view/footer.php'); ?>