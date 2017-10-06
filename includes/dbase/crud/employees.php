<?php 
	require_once('../../../includes/initialize.php');


	function convert_post_to_employee($post) {
		$employee = [];
		$dob = [];
		$hired = [];

		$dob['month'] = convert_month($post['dob_month'] ?? '');
		$dob['day'] = convert_day($post['dob_day'] ?? '');
		$dob['year'] = $post['dob_year'] ?? '';

		$hired['month'] = convert_month($post['hired_month'] ?? '');
		$hired['day'] = convert_day($post['hired_day'] ?? '');
		$hired['year'] = $post['hired_year'] ?? '';

		$employee['first_name'] = $post['first'] ?? '';
		$employee['middle_name'] = $post['middle'] ?? '';
		$employee['last_name'] = $post['last'] ?? '';
		$employee['emp_id'] = $post['emp_id'] ?? null;

		$employee['birth_date'] = convert_to_date($dob);
		$employee['date_hired'] = convert_to_date($hired);
		$employee['user_id'] = $_SESSION['id'] ?? '';

		return $employee;
	}

	function create_employee($employee) {
		// $newEmp = [];
		// $dob = [];
		// $hired = [];

		// $dob['month'] = convert_month($employee['dob_month'] ?? '');
		// $dob['day'] = convert_day($employee['dob_day'] ?? '');
		// $dob['year'] = $employee['dob_year'] ?? '';

		// $hired['month'] = convert_month($employee['hired_month'] ?? '');
		// $hired['day'] = convert_day($employee['hired_day'] ?? '');
		// $hired['year'] = $employee['hired_year'] ?? '';

		// $newEmp['first_name'] = $employee['first_name'] ?? '';
		// $newEmp['middle_name'] = $employee['middle_name'] ?? '';
		// $newEmp['last_name'] = $employee['last_name'] ?? '';
		// $newEmp['emp_id'] = $employee['emp_id'] ?? null;
		

		// $newEmp['birth_date'] = convert_to_date($dob);
		// $newEmp['date_hired'] = convert_to_date($hired);
		$options['id'] = $employee['user_id'];
		$result = employees_create($employee, $options);
		if($result === true) {
			return get_new_record_id();
		} else {
			$errors = $result;
			return $errors;
		}
	}

?>