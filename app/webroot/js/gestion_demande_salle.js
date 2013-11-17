function removeLine(e){
	$(e).parent().parent().parent().parent().remove();
	return false;
}