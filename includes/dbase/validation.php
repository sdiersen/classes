<?php

	function validate($table_name, $record) {
		switch ($table_name) {
			case 'employees' :
				return validate_employees($record);
			default:
				return;
		}
	}

	function validate_day($mon,$day,$year) {
		switch ($mon) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				if ((int)$day < 1 || (int)$day > 31) {
					return "The day must be between 1 (or 01) and 31.";
				}
				return true;
			case 4:
			case 6:
			case 9:
			case 10:
				if ((int)$day < 1 || (int)$day > 30) {
					return "The day must be between 1 (or 01) and 30.";
				}
				return true;
			case 2:
				$max_day = 29;
				if ((int)$year % 4 != 0 || ((int)$year % 100 == 0 && (int)$year % 400 != 0)) {
					$max_day = 28;
				}
				if ((int)$day < 1 || (int)$day > $max_day) {
					return "The day must be between 1 (or 01) and " . $max_day . ".";
				}
				return true;
		}
	}

	function validate_date($date, $field) {
		$errors = [];
		
		if(is_blank($date)) {
			$errors[] = $field . " cannot be blank.";
			return $errors;
		} 

		$day = get_day_sql($date);
		$day = ltrim($day, "0");

		$mon = get_month_sql($date);
		$mon = ltrim($mon, "0");

		$year = get_year_sql($date);
		$year = ltrim($year, "0");
				
		$valid_month = true;
		$valid_year = true;

		if (is_blank($year)) {
			$errors[] = $field . " Year cannot be blank.";
		} else {
			if (has_special_characters($year) || has_letters($year)) {
				$errors[] = $field . " Year cannot have special charaters or letters.";
				$valid_year = false;
			}
			if ((int)$year < 1900 || (int)$year > 2200) {
				$errors[] = $field . " Year must be between 1900 and 2200.";
				$valid_year = false;
			}
		}

		if (is_blank($mon)) {
			$errors[] = $field . " Month cannot be blank.";
			$valid_month = false;
		} else {
			if (has_special_characters($mon) || has_letters($mon)) {
				$errors[] = $field . " Month cannot have special characters or letters.";
				$valid_month = false;
			}

			if ((int)$mon < 1 || (int)$mon > 12) {
				$errors[] = $field . " Month must have a value between 1 (or 01) and 12.";
				$valid_month = false;
			}
		}

		if (is_blank($day)) {
			$errors[] = $field . " Day cannot be blank.";
		} else {
			if (has_special_characters($day) || has_letters($day)) {
				$errors[] = $field . " Day cannot contain letters or special characters.";
			}
			if($valid_month && $valid_year) {
				$result = validate_day($mon, $day, $year);
				if($result !== true) {
					$errors[] = $field . " " . $result;
				}
			}
		}
		return $errors;
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

		$dob = validate_date($record['birth_date'], "Date of Birth");
		foreach ($dob as $error) {
			$errors[] = $error;
		}

		$hired = validate_date($record['date_hired'], "Date Hired");
		foreach($hired as $error) {
			$errors[] = $error;
		}

		return $errors;
	}