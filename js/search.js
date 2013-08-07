(function($){

	$('#result').hide();

	$('#search-field').keyup(function(){
		var search 	= $(this).val();
		var data 	= 'r=' + search;

		if (search.length > 2){
			
			$.ajax({
				type: "GET",
				url: "result.php",
				data: data,
				success: function(server_response){
					$('#result').html(server_response).slideDown(500);	
				}
			});
		}else{
			$('#result').slideUp(500);

		}
	});

})(jQuery);