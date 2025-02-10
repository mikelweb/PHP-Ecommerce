<?php
class AdminTemplate {

	public static function orderTable($orders) {
		$res = '
<link rel="stylesheet" href="assets/css/order.css">
<div class="container px-3 my-5 clearfix">
	<div class="card">
		<div class="card-header">
			<h2 save_webp_as_jpg="true">Administración de pedidos</h2>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered m-0">
					<thead>
						<tr>
							<th class="text-center py-3 px-4">Id Usuario</th>
							<th class="text-center py-3 px-4">Id Pedido</th>
							<th class="text-right py-3 px-4">Fecha</th>
							<th class="text-center py-3 px-4">Productos</th>
							<th class="text-right py-3 px-4">Total</th>
						</tr>
					</thead>
					<tbody>';
					if(!empty($orders)) {
						foreach($orders as $order) {
							$res .= self::orderRow($order);
						}
					}
		$res .= '
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>';
		return $res;
	}	

	public static function orderRow($order) {
		$orderTotal = 0;
		$res = '
		<tr>
			<td class="text-center py-3 px-4 align-middle">'.$order['userId'].'</td>
			<td class="text-center py-3 px-4 align-middle">'.$order['id'].'</td>
			<td class="align-middle">'.$order['date'].'</td>
			<td class="">';
					if(!empty($order['products'])) {
						foreach($order['products'] as $product) {
							$row = self::orderProductsRow($product);
							$res .= $row["html"];
							$orderTotal += $row["productPrice"];
						}
					}
		$res .= '
			</td>
			<td class="text-right font-weight-semibold align-middle p-4">'.$orderTotal.' €</td>
		</tr>
		';
		return $res;
	}
	
	public static function orderProductsRow($product) {
		
		$res["html"]='
				<div class="media align-items-center text-center">
					<img src="assets/img/products/'.$product->img.'" class="d-block ui-w-40 ui-bordered mr-4" alt="">
										
					<span>'.$product->quantity.' x '.$product->name.'</span>
					<span style="text-align:right">'.$product->price.' €</span>
				</div>
		';
		$res["productPrice"] = $product->price * $product->quantity;
		return $res;
	}
}
?>