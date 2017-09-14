<?php
	//BASE TABLES
	define('ADDRESSES_FIELDS', array('id', 'name', 'street_number', 'street', 'room', 'city', 'state', 'zip_code', 'route_code', 'po_box'));
	define('ROOMS_FIELDS', array('id', 'address_id', 'name'));
	define('USERS_FIELDS', array('id', 'username', 'hashed_password', 'access_level'));

	//CLASSES FIELDS
	define('CLASS_LEVEL_FIELDS', array('id', 'name', 'description'));
	define('CLASS_TYPE_FIELDS', array('id', 'name', 'description'));
	define('CLASSES_FIELDS', array('id', 'name', 'short_desc', 'long_desc', 'duration'));
	define('CLASS_WITH_LEVELS_FIELDS', array('id', 'class_id', 'level_id'));
	define('CLASS_WITH_TYPES_FIELDS', array('id', 'class_id', 'type_id'));
	define('SCHEDULED_CLASSES_FIELDS', array('id', 'class_id', 'employee_id', 'address_id', 'room_id', 'start_date', 'end_date', 'start_time'));

	//CLASSES HEADINGS
	define('CLASS_LEVEL_HEADINGS', array('Class Level', 'ID', 'Level', 'Description'));
	define('CLASS_TYPE_HEADINGS', array('Class Type', 'ID', 'Type', 'Description'));
	define('CLASSES_HEADINGS', array('Classes', 'ID', 'Name', 'Short Description', 'Long Description', 'Duration'));
	
	//EMPLOYEES
	define('EMPLOYEES_FIELDS', array('id', 'first_name', 'middle_name', 'last_name', 'birth_date', 'date_hired', 'user_id', 'emp_id'));
	define('EMPLOYEE_ADDRESSES_FIELDS', array('id', 'employee_id', 'address_id'));
	define('EMPLOYEE_EMAILS_FIELDS', array('id', 'email', 'employee_id'));
	define('EMPLOYEE_PHONE_NUMBERS_FIELDS', array('id', 'phone_number', 'employee_id', 'type', 'primary_phone'));

	//CREDENTIAL BODIES
	define('CREDENTIAL_BODIES_FIELDS', array('id', 'name', 'abbreviation', 'website'));
	define('CREDENTIAL_BODY_EMAILS_FIELDS', array('id', 'email', 'body_id'));
	define('CREDENTIAL_BODY_PHONE_NUMBERS_FIELDS', array('id', 'phone_number', 'body_id', 'type', 'location_id'));
	define('CREDENTIAL_BODY_LOCATIONS_FIELDS', array('id', 'address_id', 'body_id', 'name'));
	define('CREDENTIALS_FIELDS', array('id', 'name', 'body_id', 'employee_id', 'expires'));



?>