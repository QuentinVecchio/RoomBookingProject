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
	valeur = $(e).parent().parent().parent().parent().find('.formStatus').attr('value');
	$.get("answerRoom/",function(){
		$(e).parent().parent().parent().parent().find('.status').attr('value',valeur);
	});
	$(e).parent().parent().css('display','none');
	$(e).parent().parent().parent().find(".btnModif").css('display','block');
	$(e).parent().parent().parent().parent().find('.status').css('display', 'block');
	$(e).parent().parent().parent().parent().find('.formStatus').css('display', 'none');
	return true;
}

function annuleModifSalle(e)
{
	$(e).parent().parent().css('display','none');
	$(e).parent().parent().parent().find(".btnModif").css('display','block');
	$(e).parent().parent().parent().parent().find('.status').css('display', 'block');
	$(e).parent().parent().parent().parent().find('.formStatus').css('display', 'none');
	return false;
}