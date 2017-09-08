$(document).ready(function () {
	//When someone clicks on the navigation links
	$('.nav li').click(function (e) {
		//make all navtabs inactive
		$('.nav li').removeAttr('id');
		//make the one clicked active
		$(this).attr('id', 'activetab');
		
		//hide the fieldsets
		$('fieldset').addClass('hidden').removeClass('visible');
		//get the title of the nave we clicked
		whichitem = $(this).attr('title');
		//make the class of the clicked item visible
		$("fieldset[title='" + whichitem + "']").removeClass('hidden').addClass('visible');
	});
	
//	//when someone clicks on the previous button
//	$('.prev').click(function (e) {
//		//find out which navtab is active
//		var listItem = document.getElementById('activetab');
//		//find the index of the navtab
//		var actIndex = $('li').index(listItem);
//		
//		
//		//make all the navtabs inactive
//		$('.nav li').removeAttr('id');		
//		//hide all the fieldsets
//		$('fieldset').attr('class', 'hidden');
//		
//		if (actIndex <= 1) { 
//			$('.nav li:last').attr('id', 'activetab');
//			$('fieldset:last').removeAttr('class');
//		} else {
//			// subtracting 2 works for this. 
//			// that could be due to a change in indexing between listItem and actIndex
//			// former being 1 based, latter being 0 based
//			$('.nav li').eq(actIndex - 2).attr('id', 'activetab');
//			$('fieldset').eq(actIndex - 2).removeAttr('class');
//		}
//	});
//	
	$('.prev').click(function (e) {
		var $selTab = $(".nav li#activetab").removeAttr('id');
		var tabs = $selTab.parent().children();
		tabs.eq((tabs.index($selTab) - 1) % tabs.length).attr('id', 'activetab');
		
		var $selField = $('.visible').removeClass('visible').addClass('hidden');
		var fields = $selField.parent().children();
		fields.eq((fields.index($selField) - 1) % tabs.length).removeClass('hidden').addClass('visible');
	});

	
	$('.next').click(function (e) {
		var $selTab = $(".nav li#activetab").removeAttr('id');
		var tabs = $selTab.parent().children();
		tabs.eq((tabs.index($selTab) + 1) % tabs.length).attr('id', 'activetab');
		
		var $selField = $(".visible").removeClass('visible').addClass('hidden');
		var fields = $selField.parent().children();
		fields.eq((fields.index($selField) + 1) % fields.length).removeClass('hidden').addClass('visible');
	});
});
