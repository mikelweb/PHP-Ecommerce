<?php
class ProductTemplate {

	public static function showProducts($products, $productsByRow = 3) {
		// Use botstrap grid system to set columns
		switch($productsByRow) {
			case 3:
				$colMd = 4;
			case 4:
				$colMd = 3;
			default:
				$colMd = 4;
		}
		$cont = 0;
		// Loop to open/close column divs
		foreach($products as $product) {
			//echo "productsByRow: ". $productsByRow ." -- cont: ".$cont;
			if($cont % $productsByRow == 0) {
				echo '<div class="row productsrow">';
			}
			echo '<div class="col-md-'.$colMd.'">';
			echo self::showProduct($product);
			echo '</div>';

			if(($cont+1) % $productsByRow == 0) {
				echo '</div>';
			}
			$cont++;
		}
	}
	
	public static function showProduct($product) {
		return '
			<a href="products?prod='.$product->id.'">
				<img src="assets/img/products/'.$product->img.'" height="" width="100%">
				<h2>'.$product->name.'</h2>
				<p>'.$product->price.' €</p>
			</a>
			<button type="button" class="btn btn-secondary add2cart liveToastBtn" data-title="Producto añadido al carrito" data-content="Has añadido '.$product->name.' al carrito" data-prod="'.$product->id.'">Añadir al carrito</button>
		  ';
	}
	
	public static function productPage($product) {
		return '
			<div class="row">
				<div class="col-md-4">
					<img src="assets/img/products/'.$product->img.'" height="" width="100%">
				</div>
				<div class="col-md-8">
					<h2>'.$product->name.'</h2>
					<p>'.$product->description.'</p>
					<p>'.$product->price.' €</p>
					<p><button type="button" class="btn btn-secondary add2cart liveToastBtn" data-title="Producto añadido al carrito" data-content="Has añadido '.$product->name.' al carrito" data-prod="'.$product->id.'">Añadir al carrito</button></p>
				</div>
			</div>
		  ';
	}

}
?>