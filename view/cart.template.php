<?php
class CartTemplate {

	public static function shoppingCart() {
		$numItems = 0;
		if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
			foreach($_SESSION['cart'] as $item) {
				$numItems += $item;
			}
		}
		echo '<a href="cart" class="shoppingcarticon text-white">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
		if(isset($_SESSION['cart']) && $numItems > 0) {
			echo '<span class="cartnum">'.$numItems.'</span>';
		}
		echo '</a>';
	}
	
	public static function cartRow($item) {
	
		return '
		<tr>
			<td class="p-4">
				<div class="media align-items-center">
					<img src="assets/img/products/'.$item["img"].'" class="d-block ui-w-40 ui-bordered mr-4" alt="">
					<div class="media-body"> <a href="products?prod='.$item["id"].'" class="d-block text-dark">'.$item["name"].' </a></div>
				</div>
			</td>
			<td class="text-right font-weight-semibold align-middle text-center">'.$item["price"].' €</td>
			<td class="align-middle p-4 text-center">'.$item['quantity'].'</td>
			<td class="text-right font-weight-semibold align-middle text-center">'.$item["price"] * $item['quantity'].' €</td>
			<td class="text-center align-middle px-0"><a class="deleteitem" title="Eliminar" data-prod="'.$item["id"].'">×</a></td>
		</tr>
		';
	}
	
	public static function emptyCart() {
		return '<center>No hay productos en el carrito</center>';
	}
	
	public static function cartTable($products, $total) {
		$res = '
<link rel="stylesheet" href="assets/css/cart.css">
<div class="container px-3 my-5 clearfix">
	<div class="card">
		<div class="card-header">
			<h2 save_webp_as_jpg="true">Carrito</h2>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered m-0">
					<thead>
						<tr>
							<th class="text-center py-3 px-4" style="min-width: 400px;">Productos</th>
							<th class="text-right py-3 px-4" style="width: 100px;">Precio</th>
							<th class="text-center py-3 px-4" style="width: 120px;">Cantidad</th>
							<th class="text-right py-3 px-4" style="width: 100px;">Subtotal</th>
							<th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
						</tr>
					</thead>
					<tbody>';
					if(!empty($products)) {
						foreach($products as $product) {
							$res .= CartTemplate::cartRow($product);
						}
					}
		$res .= '
					</tbody>
				</table>
			</div>
			<div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
				<div class="mt-4"></div>
				<div class="d-flex">
					<div class="text-right mt-4 mr-5">
					</div>
					<div class="text-right mt-4">
						<label class="text-muted font-weight-normal m-0">Total</label>
						<div class="text-large"><strong>'.$total.' €</strong></div>
					</div>
				</div>
			</div>
			<a href="checkout" class="btn btn-lg btn-primary mt-2">Pagar</a>
		</div>
	</div>
</div>';
		return $res;
	}	
	
}
?>