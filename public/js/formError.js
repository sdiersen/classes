$(document).ready(function () {

	$("#middle_name_input").on('input', function() {
		var input = $(this).val();
		alert(input.length);
		if (input.length < 1) {
			$(this).addClass("errorsInput");
			$(this).attr("title", "You need more letters");
			$("#middle_name_title").addClass("errorsTitle");
		} else {
			$(this).removeClass("errorsInput");
			$(this).removeAttr("title");
			$("#middle_name_title").removeClass("errorsTitle");
		}

	});

	$("#last_name_input").on('input', alert("hello"));


});