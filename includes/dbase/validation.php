<?php

	function validate($table_name, $record) {
		switch ($table_name) {
			case 'employees' :
				return validate_employees($record);
			default:
				return;
		}
	}

	function validate_employees($record) {
		$errors = [];

		if(is_blank($record['first_name'])) {
			$errors[] = 'First name cannot be blank';
		}
		if(has_length_greater_than($record['first_name'], 254)) {
			$errors[] = 'First name cannot be greater than 254 characters long';
		}
		if(has_numbers($record['first_name']) || has_special_characters($record['first_name'])) {
			$errors[] = 'First name cannot not contain numbers or special characters';
		}
		if(is_blank($record['middle_name'])) {
			$errors[] = 'Middle name cannot be blank';
		}
		if(has_length_greater_than($record['middle_name'], 254)) {
			$errors[] = 'Middle name cannot be greater than 254 characters long';
		}
		if(has_numbers($record['middle_name']) || has_special_characters($record['middle_name'])) {
			$errors[] = 'Middle name cannot not contain numbers or special characters';
		}
		if(is_blank($record['last_name'])) {
			$errors[] = 'Last name cannot be blank';
		}
		if(has_length_greater_than($record['last_name'], 254)) {
			$errors[] = 'Last name cannot be greater than 254 characters long';
		}
		if(has_numbers($record['last_name']) || has_special_characters($record['last_name'])) {
			$errors[] = 'Last name cannot not contain numbers or special characters';
		}

		return $errors;
	}