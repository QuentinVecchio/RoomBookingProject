$(document).ready(function() {

	$('.ajax').on('click', function(){
		$.get($(this).attr('href'), function(data){
			$('#gestion').empty().append(data);
		});

		return false;
	});

	init();



});

function init(){
	$('.close').on('click', function(){
		$(this).parent().slideUp();
		return false;
	});

	$('.message').on('click', function(){
		$(this).slideUp();
		return false;
	});

	setTimeout(function(){$(".message").slideUp();}, 5000);
}