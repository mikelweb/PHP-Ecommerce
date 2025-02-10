$(document).ready(function() {

	$('.search').on('input', function() {
	  if($(this).val() == "") {
		  $('.finder').hide();
		  return;
	  }
	  $('.finder').each(function() {
		if( $(this).text().toLowerCase().search( $('.search').val().toLowerCase() ) > -1 ) {
		  $(this).show();
		} else {
			$(this).hide();
		}
	  });  
	});
	
	$('.add2cart').on('click', function() {
		var data = {
			id: $(this).data('prod'),
			function: 'addtocart'
		};
		$.ajax({
			method: 'post',
			dataType: "json",
			url: 'api.php',
			data: data,
			success: function(res) {
				console.log(res);
				console.log('Añadido al carrito OK');
			}
		});
	});

	$('.deleteitem').on('click', function() {
		console.log("presed");
		var data = {
			id: $(this).data('prod'),
			function: 'deleteitem'
		};
		$.ajax({
			method: 'post',
			dataType: "json",
			url: 'api.php',
			data: data,
			success: function(res) {
				location.reload();
			}
		});
	});

	$('.dropdown > a').on('click', function() {
   		location.href = this.href;
	});
	
	$('.liveToastBtn').on('click', function() {
		let title = $(this).data('title');
		let content = $(this).data('content');
		$('.me-auto').html(title);
		$('.toast-body').html(content);
		$("#liveToast").toast("show");
	});

	$("#account").on("click", function() {
		if($(this).is(":checked")) $(".togglePass").show(300);
		else $(".togglePass").hide(200);
	});

	$("#rand").on("click", function() {
		let result = '';
		const characters = '!@#$%&/()=+*{}[]abcdefghijklmnopqrstuvwxyz0123456789';

		// Loop to generate characters for the specified length
		for (let i = 0; i < 10; i++) {
			const randomInd = Math.floor(Math.random() * characters.length);
			result += characters.charAt(randomInd);
		}
		$('#password').val(result).prop('type', 'text');
		$('#password2').val(result).prop('type', 'text');
	});
});