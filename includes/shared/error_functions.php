<?php
	
		function check_first_name($errors) {
			foreach(FIRST_NAME_ERRORS as $field) {
				if (isset($errors[$field])){
					return "class=\"errorsTitle\"";
				}
			}
		}
?>