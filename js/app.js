(function($){

	$('.view').click(function(event){
		event.preventDefault();
		
		var url 		= $(this).attr('href');
		var id 			= '#'+$(this).parents('span').attr('id');
		var idView 	= '#'+$(this).attr('id');
		var val 		= $(this).text();

		$.ajax({
			type: "GET",
			url: url,
			success: function(server_response){	
				var spanView 	= $(id).attr('class');		

				if (spanView == 'label label-important') {
					val = "Vu";
					$(idView).html(val);
					$(id).removeClass('label label-important').addClass('label label-success');
				}else{
					val = "Pas vu";
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

	/*******************************************/ 
	/*	Système de notation via étoile    	*/
	/*******************************************/ 

	$('ul.notes-echelle').addClass('js');
	// Passe chaque note par l'état grisé par défaut
	$('ul.notes-echelle li').addClass('note-off');	
	// Au survol de la souris
	$('ul.notes-echelle li').mouseover(function(){
		// Passe les notes supérieures à l'état inactif (par défaut)
		$(this).nextAll('li').addClass('note-off');
		$(this).prevAll('li').removeClass('note-off');
		$(this).removeClass('note-off');
	});

	$('ul.notes-echelle').mouseout(function(){
		// Passe tous les notes à l'état inactif
		$(this).children('li').addClass('note-off');
		$(this).find('li input:checked').parent('li').trigger('mouseover');		
	});

	$('ul.notes-echelle input').click(function(){
		$(this).parent('ul.notes-echelle').find('li').removeClass('note-checked');
		$(this).parent('li').addClass('note-checked');
	});

	// On simule un survol souris des boutons cochés par défaut
	$("ul.notes-echelle input:checked").parent("li").trigger("mouseover");
	// On simule un click souris des boutons cochés
	$("ul.notes-echelle input:checked").trigger("click");

	$('input.radioNote').click(function(){
		/** Loading **/ 
		//$('.rating').hide();
		//$('.loading').show().delay(80000).hide();
			var note 		= $(this).attr('value');
			var idMovie = $('.id').attr('value');

			$.post('note.php', {notesA: note, id_movie: idMovie}, function(data){
				if (data.error){										
					showDialog(data.message);
				}else{
					showDialog(data.message);
					$('.moy').empty().append(data.average);
				}
			}, 'json');		
	});

	/** L'infobulle **/

	$('.infoNote').mouseover(function(){
		if ($(this).attr('title') == "") return false;

		$('.notes-echelle').append('<span class="infobulle"></span>');
		var bulle 	= $('.infobulle:last');
		bulle.append($(this).attr('title'));
		$(this).attr('title','');
		var posTop 	= $(this).offset().top-$(this).height();
		var posLeft = $(this).offset().left+$(this).width()/2-bulle.width()/2;
		bulle.css({
			left: posLeft,
			top: posTop-10,
			opacity: 0
		});

		bulle.animate({
			top: posTop,
			opacity: 0.99
		});
	});

	$('.infoNote').mouseout(function(){
		var bulle = $('.infobulle:last');
		$(this).attr('title',bulle.text());
		bulle.animate(
			{
				top: bulle.offset().top+10,
				opacity: 0
			},
			500,
			'linear', 
			function(){
				bulle.remove();
			}
		);		
	});

})(jQuery);

/**
* Permet d'afficher la boîte de dialogue de jqueryUi
* @param data array Le texte de la boîte de dialogue
**/
function showDialog(data){
	$('.rating').append('<div id="dialog" title="Erreur"><p>' + data + '</p></div>');
	$('#dialog').dialog({
		show: {
			effect: "blind",
			duration: 1000
		},
		hide: {
			effect: "explode",
			duration: 1000
		}	
	});
}