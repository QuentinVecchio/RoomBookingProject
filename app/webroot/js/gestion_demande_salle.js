$(document).ready(function() {
	$('#loan0StartTime').timepicker({ 'step': 15 , 'minTime': '07:00am', 'maxTime': '7:00pm', 'timeFormat': 'H:i'});
	$('#loan0EndTime').timepicker({ 'step': 15 , 'minTime': '07:00am', 'maxTime': '7:00pm', 'timeFormat': 'H:i'});


	$('#loan0StartTime').on('change',function(){
		var dateInit = $('#loan0StartTime').val();

		var tab = dateInit.split(':');
		if(tab[0] > 12){
var res = dateInit+'am';
		}else{
			var res = dateInit+'am';
		}

		$('#loan0EndTime').timepicker({ 'step': 15 , 'minTime': res, 'maxTime': '7:00pm', 'timeFormat': 'H:i'});
	});
});

