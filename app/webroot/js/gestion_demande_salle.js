/*$(document).ready(function() {
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
});*/
$(function() {
	var DATEPICKER_FORMAT = 'yyyy-m-d';
	var TIMEPICKER_FORMAT = 'H:i';
	var TIMEPICKER_STEP = '15';
	var TIMEPICKER_START = '07:00am';
	var TIMEPICKER_END = '06:00pm';
	var DATE_FORMAT = 'Y-n-j'; // for this format see http://php.net/manual/function.date.php

	$('.datepair input.date').each(function(){
		var $this = $(this);
		$this.datepicker({
			'format': DATEPICKER_FORMAT,
			'autoclose': true
		});

		if ($this.hasClass('start') || $this.hasClass('end')) {
			$this.on('changeDate change', doDatepair);
		}

	});

	$('.datepair input.time').each(function() {
		var $this = $(this);
		
		$this.timepicker({
			'showDuration': false,
			'timeFormat': TIMEPICKER_FORMAT,
			'step': TIMEPICKER_STEP,
			'minTime' : TIMEPICKER_START,
			'maxTime': TIMEPICKER_END,
			'scrollDefaultNow': true
		});

		if ($this.hasClass('start') || $this.hasClass('end')) {
			$this.on('changeTime change', doDatepair);
		}
		
		if ($this.hasClass('end')) {
			$this.on('focus', function(){$('.ui-timepicker-with-duration').scrollTop(0);});
		}		

	});

	$('.datepair').each(initDatepair);

	function initDatepair()
	{
		var container = $(this);

		var startDateInput = container.find('input.start.date');
		var endDateInput = container.find('input.end.date');
		var dateDelta = 0;

		if (startDateInput.length && endDateInput.length) {
			var startDate = parseDate(startDateInput.val(), DATEPICKER_FORMAT);
			var endDate =  parseDate(endDateInput.val(), DATEPICKER_FORMAT);

			dateDelta = endDate.getTime() - startDate.getTime();
			container.data('dateDelta', dateDelta);
		}

		var startTimeInput = container.find('input.start.time');
		var endTimeInput = container.find('input.end.time');

		if (startTimeInput.length && endTimeInput.length) {
			var startInt = startTimeInput.timepicker('getSecondsFromMidnight');
			var endInt = endTimeInput.timepicker('getSecondsFromMidnight');

			container.data('timeDelta', endInt - startInt);

			if (dateDelta < 86400000) {
				endTimeInput.timepicker('option', 'minTime', startInt);
			}
		}
	}

	function doDatepair()
	{
		var target = $(this);
		if (target.val() == '') {
			return;
		}

		var container = target.closest('.datepair');

		if (target.hasClass('date')) {
			updateDatePair(target, container);

		} else if (target.hasClass('time')) {
			updateTimePair(target, container);
		}
	}

	function updateDatePair(target, container)
	{
		var start = container.find('input.start.date');
		var end = container.find('input.end.date');
		if (!start.length || !end.length) {
			return;
		}

		var startDate = parseDate(start.val(), DATEPICKER_FORMAT);
		var endDate =  parseDate(end.val(), DATEPICKER_FORMAT);

		var oldDelta = container.data('dateDelta');

		if (!isNaN(oldDelta) && oldDelta !== null && target.hasClass('start')) {
			var newEnd = new Date(startDate.getTime()+oldDelta);
			end.val(newEnd.format(DATE_FORMAT));
			end.datepicker('update');
			return;

		} else {
			var newDelta = endDate.getTime() - startDate.getTime();

			if (newDelta < 0) {
				newDelta = 0;

				if (target.hasClass('start')) {
					end.val(start.val());
					end.datepicker('update');
				} else if (target.hasClass('end')) {
					start.val(end.val());
					start.datepicker('update');
				}
			}

			if (newDelta < 86400000) {
				var startTimeVal = container.find('input.start.time').val();

				if (startTimeVal) {
					container.find('input.end.time').timepicker('option', {'minTime': startTimeVal});
				}
			} else {
				container.find('input.end.time').timepicker('option', {'minTime': null});
			}

			container.data('dateDelta', newDelta);
		}
	}

	function updateTimePair(target, container)
	{
		var start = container.find('input.start.time');
		var end = container.find('input.end.time');

		if (!start.length) {
			return;
		}

		var startInt = start.timepicker('getSecondsFromMidnight');
		var dateDelta = container.data('dateDelta');

		if (target.hasClass('start') && (!dateDelta || dateDelta < 86400000)) {
			end.timepicker('option', 'minTime', startInt);
		}

		if (!end.length) {
			return;
		}

		var endInt = end.timepicker('getSecondsFromMidnight');
		var oldDelta = container.data('timeDelta');

		var endDateAdvance = 0;
		var newDelta;

		if (oldDelta && target.hasClass('start')) {
			// lock the duration and advance the end time

			var newEnd = (startInt+oldDelta)%86400;

			if (newEnd < 0) {
				newEnd += 86400;
			}

			end.timepicker('setTime', newEnd);
			newDelta = newEnd - startInt;
		} else if (startInt !== null && endInt !== null) {
			newDelta = endInt - startInt;
		} else {
			return;
		}

		container.data('timeDelta', newDelta);

		if (newDelta < 0 && (!oldDelta || oldDelta > 0)) {
			// overnight time span. advance the end date 1 day
			endDateAdvance = 86400000;

		} else if (newDelta > 0 && oldDelta < 0) {
			// switching from overnight to same-day time span. decrease the end date 1 day
			endDateAdvance = -86400000;
		}

		var startInput = container.find('.start.date');
		var endInput = container.find('.end.date');

		if (startInput.val() && !endInput.val()) {
			endInput.val(startInput.val());
			endInput.datepicker('update');
			dateDelta = 0;
			container.data('dateDelta', 0);
		}

		if (endDateAdvance != 0) {
			if (dateDelta || dateDelta === 0) {
				var endDate =  parseDate(endInput.val(), DATEPICKER_FORMAT);
				var newEnd = new Date(endDate.getTime() + endDateAdvance);
				endInput.val(newEnd.format(DATE_FORMAT));
				endInput.datepicker('update');
				container.data('dateDelta', dateDelta + endDateAdvance);
			}
		}
	}
});

