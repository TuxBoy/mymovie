(function($){

	$('.view').click(function(event){
		event.preventDefault();
		
		var url 	= $(this).attr('href');
		var id 		= '#'+$(this).parents('span').attr('id');
		var idView 	= '#'+$(this).attr('id');
		var val 	= $(this).text();

		$.ajax({
			type: "GET",
			url: url,
			success: function(server_response){	
				var spanView 	= $(id).attr('class');		

				if (spanView == 'label label-important') {
					val = "Pas vu";
					$(idView).html(val);
					$(id).removeClass('label label-important').addClass('label label-success');
				}else{
					val = "Vu";
					$(idView).html(val);
					$(id).removeClass('label label-success').addClass('label label-important');
				}
			}
		});		
		return false;
	});

	var alert = $('#alert');
	if (alert.length > 0){
		alert.hide().slideDown(500).delay(3000).slideUp();
		alert.find('.close').click(function(e){
			e.preventDefault();
			alert.slideUp;
		});
	}

	$('.scroll').hide();

	$(function(){

		$(window).scroll(function(){
			if ($(this).scrollTop() > 200){
				$('.scroll').fadeIn();	
			}else{
				$('.scroll').fadeOut();
			}
		});

	});

	$('.scroll a').click(function(){
		$('body,html').animate({
			scrollTop: 0
		}, 300);
		return false;
	});	

})(jQuery);