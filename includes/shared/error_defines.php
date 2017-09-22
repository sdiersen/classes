<?php
	// All error defines are superprefixed with ER_


	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++ Name Errors ++++++++++++++++++++++++++++++++++++++++++
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//First Name error messages prefixed with FN
	define('FIRST_NAME_ERRORS', array('fn_blank', 'fn_long', 'fn_special'));
	define('ER_FN_BLANK', "First name cannot be blank.");
	define('ER_FN_LONG', "First name cannot be longer than 254 characters.");
	define('ER_FN_SPECIAL', "First name cannot contain numbers or special characters.");

	//Last Name error messages prefixed with LN
	define('LAST_NAME_ERRORS', array('ln_blank', 'ln_long', 'ln_special'));
	define('ER_LN_BLANK', "Last name cannot be blank.");
	define('ER_LN_LONG', "Last name cannot be longer than 254 characters.");
	define('ER_LN_SPECIAL', "Last name cannot contain numbers or special characters.");

	//Middle Name error messages prefixed with MN
	define('MIDDLE_NAME_ERRORS', array('mn_blank', 'mn_long', 'mn_special'));
	define('ER_MN_BLANK', "Middle name cannot be blank.");
	define('ER_MN_LONG', "Middle name cannot be longer than 254 characters.");
	define('ER_MN_SPECIAL', "Middle name cannot contain numbers or special characters.");

	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//+++++++++++++++++++++++++ Date Errors ++++++++++++++++++++++++++++++++++++++++++
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//Date error messages prefixed with DATE
	define('ER_DATE_BLANK', "Date cannot be blank.");

	//Year error messages prefixed with YR
	define('ER_YR_BLANK', "Year cannot be blank.");
	define('ER_YR_SPECIAL', "Year cannot contain letters or special characters.");

	//Month error messages prefixed with MON
	define('ER_MON_BLANK', "Month cannot be blank.");
	define('ER_MON_SPECIAL', "Month cannot contain letters or special characters.");
	define('ER_MON_RANGE', "Month must have a value between 1 (or 01) and 12.");

	//Day error messages prefixed with DAY
	define('ER_DAY_BLANK', "Day cannot be blank.");
	define('ER_DAY_SPECIAL', "Day cannot contain letters or special characters.");
	define('ER_DAY_RANGE_28', "Day must be between 1 (or 01) and 28");
	define('ER_DAY_RANGE_29', "Day must be between 1 (or 01) and 29");
	define('ER_DAY_RANGE_30', "Day must be between 1 (or 01) and 30");
	define('ER_DAY_RANGE_31', "Day must be between 1 (or 01) and 31");
?>