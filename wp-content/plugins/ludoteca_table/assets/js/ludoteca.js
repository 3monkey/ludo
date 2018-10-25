(function( $ ) {
	$('#editLine').on('click',function(e){
	 	e.preventDefault();

	 	alert('hola');

		$.ajax({
			url : dcms_vars.ajaxurl,
			type: 'post',
			data: {
				action : 'editLine',
			},
			beforeSend: function(){
				$("#resultado").html('Loading .A..');
			},
			success: function(reponse){
				$('#resultado').val(response)
			},
			error: function(error){
				$("#resultado").html('');
			}

		});
});
})( jQuery )	
