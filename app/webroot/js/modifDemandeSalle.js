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
	alert('val');
	return false;
}

function annuleModifSalle(e)
{
	alert('sup');
	return false;
}