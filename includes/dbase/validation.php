<?php

	function validate($table_name, $record) {
		switch ($table_name) {
			case 'employees' :
				return validate_employees($record);
			default:
				return;
		}
	}

	function validate_day_range($mon,$day,$year) {
		switch ($mon) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				if ((int)$day < 1 || (int)$day > 31) {
					return ER_DAY_RANGE_31;
				}
				return true;
			case 4:
			case 6:
			case 9:
			case 10:
				if ((int)$day < 1 || (int)$day > 30) {
					return ER_DAY_RANGE_30;
				}
				return true;
			case 2:
				if ((int)$year % 4 != 0 || ((int)$year % 100 == 0 && (int)$year % 400 != 0)) {
					if ((int)$day < 1 || (int)$day > 28) {
						return ER_DAY_RANGE_28;
					}
				}
				if ((int)$day < 1 || (int)$day > 29) {
					return ER_DAY_RANGE_29;
				}
				return true;
		}
	}

	function validate_date($date, $field) {
		$errors = [];
		
		if(is_blank($date)) {
			$index = $field . "_date_blank";
			$errors[$index] = ER_DATE_BLANK;
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
			$index = $field . "_year_blank";
			$errors[$index] = ER_YR_BLANK;
		} else {
			if (has_special_characters($year) || has_letters($year)) {
				$index = $field . "_year_special";
				$errors[$index] = ER_YR_SPECIAL;
				$valid_year = false;
			}
			if ((int)$year < 1900 || (int)$year > 2200) {
				$index = $field . "_year_range";
				$errors[$index] = "Year must be between 1900 and 2200.";
				//keep year valid to remind people about the day range.
			}
		}

		if (is_blank($mon)) {
			$index = $field . "_month_blank";
			$errors[$index] = ER_MON_BLANK;
			$valid_month = false;
		} else {
			if (has_special_characters($mon) || has_letters($mon)) {
				$index = $field . "_month_special";
				$errors[$index] = ER_MON_SPECIAL;
				$valid_month = false;
			}

			if ((int)$mon < 1 || (int)$mon > 12) {
				$index = $field . "_month_range";
				$errors[$index] = ER_MON_RANGE;
				$valid_month = false;
			}
		}

		if (is_blank($day)) {
			$index = $field . "_day_blank";
			$errors[$index] = ER_DAY_BLANK;
		} else {
			if (has_special_characters($day) || has_letters($day)) {
				$index = $field . "_day_special";
				$errors[$index] = ER_DAY_SPECIAL;
			}
			if($valid_month && $valid_year) {
				$result = validate_day_range($mon, $day, $year);
				if($result !== true) {
					$index = $field . "_day_range";
					$errors[$index] = $result;
				}
			}
		}
		return $errors;
	}
	
	function validate_employees($record) {
		$errors = [];

		if(is_blank($record['first_name'])) {
			$errors['fn_blank'] = ER_FN_BLANK;
		}
		if(has_length_greater_than($record['first_name'], 254)) {
			$errors['fn_long'] = ER_FN_LONG;
		}
		if(has_numbers($record['first_name']) || has_special_characters($record['first_name'])) {
			$errors['fn_special'] = ER_FN_SPECIAL;
		}
		if(is_blank($record['middle_name'])) {
			$errors['mn_blank'] = ER_MN_BLANK;
		}
		if(has_length_greater_than($record['middle_name'], 254)) {
			$errors['mn_long'] = ER_MN_LONG;
		}
		if(has_numbers($record['middle_name']) || has_special_characters($record['middle_name'])) {
			$errors['mn_special'] = ER_MN_SPECIAL;
		}
		if(is_blank($record['last_name'])) {
			$errors['mn_blank'] = ER_LN_BLANK;
		}
		if(has_length_greater_than($record['last_name'], 254)) {
			$errors['mn_long'] = ER_LN_LONG;
		}
		if(has_numbers($record['last_name']) || has_special_characters($record['last_name'])) {
			$errors['mn_special'] = ER_LN_SPECIAL;
		}
		$dob = validate_date($record['birth_date'], "dob");
		array_merge($errors, $dob);
		
		$hired = validate_date($record['date_hired'], "dh");
		array_merge($errors, $dob);

		return $errors;
	}