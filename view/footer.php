<?php Template::message()?>
	<!-- FOOTER -->
	  <footer>
		<div class="footer1">
			<div class="container">
			  <div class="row">
				<div class="col-md-4">
					<h3>Categorías</h3>
					<ul>
					<?php
					foreach($categories as $category) {
						echo '<li><a href="categories?cat='.$category['id'].'">'.$category['name'].'</a></li>';
					}
					?>
					</ul>						
				</div>
				<div class="col-md-4">
					<h3>Envío gratis</h3>
					<span>Si superas 1500€ en tu pedido en envío te saldrá gratis.</span>
				</div>
				<div class="col-md-4">
					<h3>Contacto</h3>
					<span>Encuéntranos en Calle Serafín Olave 35 bajo, 31500 Tudela (Navarra)</span><br>
					<span>Teléfono: 646114594</span><br>
					<span>Email: admin@uoc.edu</span><br>
				  </div>
			  </div>
			</div>
		</div>
		<div class="footer2">
			<div class="container">
				<div class="row">
					<p>&copy; 2019–<?php echo date('Y');?> Mikel Goyeneche, UOC</p>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	  <script src="assets/js/functions.js"></script>
	</body>
</html>
<?php
$db->close();
unset($db);
?>