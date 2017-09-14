<?php

	function employees_index($options=[]) {
		global $db;

		$sql  = "SELECT employees.last_name AS last, employees.first_name AS first, employees.middle_name AS middle, employees.id AS id";
		if(isset($options['access'])) {
			$sql .= db_escape($db, $options['access']);
			
			
		}
		$sql .= " FROM employees, users ";
		$sql .= "WHERE employees.user_id = users.id ";
		if (isset($options['sort'])) {
			$sql .= db_escape($db, $options['sort']);
		} else {
			$sql .= "ORDER BY employees.last_name ASC, employees.first_name ASC, employees.middle_name ASC";
		}
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}