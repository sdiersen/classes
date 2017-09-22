<?php
	
		function check_first_name($errors) {
			foreach(FIRST_NAME_ERRORS as $field) {
				if (isset($errors[$field])){
					return "class=\"errorsTitle\"";
				}
			}
		}

		function check_middle_name($errors) {
			foreach(MIDDLE_NAME_ERRORS as $field) {
				if(isset($errors[$field])) {
					return "class=\"errorsTitle\"";
				}
			}
		}

		function check_last_name($errors) {
			foreach(LAST_NAME_ERRORS as $field) {
				if(isset($errors[$field])) {
					return "class=\"errorsTitle\"";
				}
			}
		}

		function check_for_error_class($errors, $fields, $title) {
			foreach($fields as $field) {
				if(isset($errors[$field])){
					return "class=\"" . $title . "\"";
				}
			}
		}

		function does_class_have_errors($errors, $fields) {
			foreach($fields as $field) {
				if(isset($errors[$field])) {
					return true;
				}
			}
			return false;
		}

		function has_errors_title($errors, $fields) {
			$ret = "title=\"";
			foreach($fields as $field) {
				if(isset($errors[$field])) {
					$ret .= $errors[$field] . "&#13;";
				}
			}
			$ret .= "\"";
			echo $ret;
			return $ret;
		}
?>