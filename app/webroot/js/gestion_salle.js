$(document).ready(function() {

	var estActif = false;
	$('.grille-edit').on('click',function(){
		if(!estActif){
			estActif = true;
			$contenu = $(this).parent().parent().parent().parent();
			$contenu.addClass('cible');
			$.get($(this).attr('href'), function(data){
				$('.cible').after(data);
				$('.cible').remove();
				
			});
		}else{
			alert('Vous éditez déjà une ligne');
		}

		return false;

	});

});