$(document).ready(function() {

	$('.ajax').on('click', function(){
		$.get($(this).attr('href'), function(data){
			$('#gestion').empty().append(data);
		});

		return false;
	});
});