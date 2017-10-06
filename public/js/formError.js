$(document).ready(function () {
	var dob_month = errorCheckDatePart('#dob_title', '#dob_month_input', $('#dob_month_input').val(), false, true);
	var dob_day = errorCheckDatePart('#dob_title', '#dob_day_input', $('#dob_day_input').val());
	var dob_year = dob_year = errorCheckDatePart('#dob_title', '#dob_year_input', $('#dob_year_input').val(), true);
	var hire_month = errorCheckDatePart('#hire_title', '#hire_month_input', $('#hire_month_input').val(), false, true);
	var hire_day = errorCheckDatePart('#hire_title', '#hire_day_input', $('#hire_day_input').val());
	var hire_year = errorCheckDatePart('#hire_title', '#hire_year_input', $('#hire_year_input').val(), true);
	
	//start up error checking for after a post that didn't work
	errorCheckDate(hire_month, hire_day, hire_year, "#hire_title");
	errorCheckDate(dob_month, dob_day, dob_year, "#dob_title");
	errorCheckNamePart('#first_name_title', '#first_name_input', $('#first_name_input').val());
	errorCheckNamePart('#middle_name_title', '#middle_name_input', $("#middle_name_input").val());
	errorCheckNamePart('#last_name_title', '#last_name_input', $('#last_name_input').val());

	$("#middle_name_input").on('input', function() {
		errorCheckNamePart('#middle_name_title', '#middle_name_input', $(this).val());
	});
	
	$("#first_name_input").on('input', function() {	
		errorCheckNamePart('#first_name_title', '#first_name_input', $(this).val());
	});

	$("#last_name_input").on('input', function() {
		errorCheckNamePart('#last_name_title', '#last_name_input', $(this).val());
	});

	$("#dob_month_input").on('input', function() {
		dob_month = errorCheckDatePart('#dob_title', '#dob_month_input', $(this).val(), false, true);
		errorCheckDate(dob_month, dob_day, dob_year, "#dob_title");
	});

	$("#dob_day_input").on('input', function() {
		dob_day = errorCheckDatePart('#dob_title', '#dob_day_input', $(this).val());
		errorCheckDate(dob_month, dob_day, dob_year, "#dob_title");
	});
	
	$("#dob_year_input").on('input', function() {
		dob_year = errorCheckDatePart('#dob_title', '#dob_year_input', $(this).val(), true);
		errorCheckDate(dob_month, dob_day, dob_year, "#dob_title");
	});

	$("#hire_month_input").on('input', function() {
		hire_month = errorCheckDatePart('#hire_title', '#hire_month_input', $(this).val(), false, true);
		errorCheckDate(hire_month, hire_day, hire_year, "#hire_title");
	});

	$("#hire_day_input").on('input', function() {
		hire_day = errorCheckDatePart('#hire_title', '#hire_day_input', $(this).val());
		errorCheckDate(hire_month, hire_day, hire_year, "#hire_title");
	});
	
	$("#hire_year_input").on('input', function() {
		hire_year = errorCheckDatePart('#hire_title', '#hire_year_input', $(this).val(), true);
		errorCheckDate(hire_month, hire_day, hire_year, "#hire_title");
	});
});

function validate_day_range(month, day, year) {
	switch (month) {
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			if ( day < 1 ||  day > 31) {
				return false;
			}
			return true;
		case 4:
		case 6:
		case 9:
		case 11:
			if ( day < 1 ||  day > 30) {
				return false;
			}
			return true;
		case 2:
			if ( year % 4 != 0 || ( year % 100 == 0 &&  year % 400 != 0)) {
				if ( day < 1 ||  day > 28) {
					return false;
				}
			}
			if ( day < 1 ||  day > 29) {
				return false;
			}
			return true;
	}
}

function errorCheckDatePart(titleID, inputID, input, year=false, month=false) {
	var special_chars = new RegExp("[^a-zA-Z0-9\s]");
	var letters = new RegExp("[a-zA-Z]");
	var errorString = "";
	var hasError = false;
	
	if (special_chars.test(input)) {
		hasError = true;
		errorString += "Cannot have special chaaracters. ";
	}
	if (letters.test(input)) {
		hasError = true;
		errorString += "Cannot have letters. ";
	}
	if (input.length < 1) {
		hasError = true;
		errorString += "Cannot be blank. ";
	}
	if (year && (input.length > 4 || input.length < 4)) {
		hasError = true;
		errorString += "Year must have 4 digits. ";
	} else if (!year && input.length > 2) {
		hasError = true;
		errorString += "Cannot have length greater than 2. ";
	}
	if (month && (parseInt(input,10) < 1 || parseInt(input,10) > 12 )) {
		hasError = true;
		errorString += "Month must be between 1 and 12. ";
	}
	if (hasError) {
		$(inputID).addClass("errorsInput");
		$(inputID).attr("title", errorString);
		$(titleID).addClass("errorsTitle");
		return 0;
	} else { 
		$(inputID).removeClass("errorsInput");
		$(inputID).removeAttr("title");
		return parseInt(input,10);;
	}
}

function errorCheckDate(month, day, year, titleID) {
	var val = month * day * year;
	if (val > 0 ) {
		if(validate_day_range(month, day, year)){
			$(titleID).removeClass("errorsTitle");
			$(titleID).removeAttr('title');
		}
		else {
			$(titleID).addClass("errorsTitle");
			$(titleID).attr('title',"Invalid Date");
		}
	} else {
		$(titleID).addClass("errorsTitle");
	}
}

function errorCheckNamePart(titleID, inputID, input) {
	var special_chars = new RegExp("[^a-zA-Z0-9\s]");
	var digits = new RegExp("[0-9]");

	var errorString = ""; 
	var hasError = false;
	
	if (input.length < 1) {
		hasError = true;
		errorString += "Cannot be blank. ";
	}
	if (special_chars.test(input)) {
		hasError = true;
		errorString += "Cannot have special characters. ";
	}
	if (digits.test(input)) {
		hasError = true;
		errorString += "Cannot have digits. ";
	}
	
	if (hasError) {
		$(inputID).addClass("errorsInput");
		$(inputID).attr("title", errorString);
		$(titleID).addClass("errorsTitle");
	} else {
		$(inputID).removeClass("errorsInput");
		$(inputID).removeAttr("title");
		$(titleID).removeClass("errorsTitle");
	}
}
