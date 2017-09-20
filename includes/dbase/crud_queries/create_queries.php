<?php
	
	function employees_create($emp, $options){
		global $db;

		$errors = validate('employees', $emp);

		$sql  = "INSERT INTO employees ";
		$sql .= "(first_name, middle_name, last_name, birth_date, date_hired, user_id) ";
		$sql .= "VALUE (";
		$sql .= "'" . db_escape($db,$emp['first_name']) . "', ";
		$sql .= "'" . db_escape($db,$emp['middle_name']) . "', ";
		$sql .= "'" . db_escape($db,$emp['last_name']) . "', ";
		$sql .= "'" . db_escape($db,$emp['birth_date']) . "', ";
		$sql .= "'" . db_escape($db,$emp['date_hired']) . "', ";
		$sql .= "'" . db_escape($db,$emp['user_id']) . "')";

		return check_query($sql);
	}

?>