$(document).ready(function() {

	var estActif = false;
	$('.grille-edit').on('click',function(){
		if(!estActif){
			estActif = true;
			$contenu = $(this).parent().parent();
			$cible = $contenu.addClass('cible');

			$.get('/CakePHP/projet-web/index.php/admin/rooms/edit/' + $cible.attr('roomId'), function(data){
				$('.cible').after(data);
				$('.cible').remove();
				
			});
		}else{
			alert('Vous éditez déjà une ligne');
		}

		return false;

	});

});