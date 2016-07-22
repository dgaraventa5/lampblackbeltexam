$(document).ready(function(){
	$("#datepicker").datepicker({ maxDate: 0 });
	$("#check-dates").click(function(){
		//set variables to input
		var DOB = $("#DOB").val();
		$('form').submit(function(){
			return false;
		});
		if (DOB == null || DOB == "") {
			alert("Please choose a date of birth.");
		}
	});
});