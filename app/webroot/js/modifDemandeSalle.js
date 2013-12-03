function modifSalle(e)
{
	$(e).parent().parent().find('.status').css('display', 'none');
	$(e).parent().parent().find('.formStatus').css('display', 'block');
	$(e).css('display', 'none');
	$(e).parent().find('.button-group').css('display', 'block');
	return false;
}

function valideModifSalle(e)
{
	$options = $(e).parent().parent().parent().parent().find('#LoanStatusId option:selected');
	valeur = $options.attr('value');
	libelle = $options.html();
	url = $(e).attr('href')+'?status_id='+valeur;

	$.get(url,function(data){
		$('#container').prepend(data);
		init();
		$(e).parent().parent().parent().parent().find('.status').html(libelle);
	});
	$(e).parent().parent().css('display','none');
	$(e).parent().parent().parent().find(".btnModif").css('display','block');
	$(e).parent().parent().parent().parent().find('.status').css('display', 'block');
	$(e).parent().parent().parent().parent().find('.formStatus').css('display', 'none');
	return false;
}

function annuleModifSalle(e)
{
	$(e).parent().parent().css('display','none');
	$(e).parent().parent().parent().find(".btnModif").css('display','block');
	$(e).parent().parent().parent().parent().find('.status').css('display', 'block');
	$(e).parent().parent().parent().parent().find('.formStatus').css('display', 'none');
	return false;
}