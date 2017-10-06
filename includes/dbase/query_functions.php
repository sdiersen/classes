<?php
	
	//classes functions

	function find_one($sql) {
		global $db;

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$row = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $row;
	}

	function check_query($sql) {
		global $db;

		$result = mysqli_query($db, $sql);
		if($result) {
			return true;
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function show_index($table_name, $data_set, $headings, $fields) {

		echo "<div class=\"classes listing\">";
		echo "<h1>" . strtoupper(h($headings[0])) . "</h1>";
		echo "<div class=\"actions\">";
		$new = "/staff/" . h(u($table_name)) . "/new.php";
		echo "<p><a class=\"action\" href=\"" . url_for($new) . "\">Create New " . h($headings[0]) . "</a></p>";
		echo "</div>";
		echo "<table class=\"list\">";
		echo "<tr>";
		$hcount = count($headings);
		for($h = 1; $h < $hcount; $h++) {
			echo "<th>" . h($headings[$h]) . "</th>";
		}
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";
		
		$count = count($fields);
		while($data = mysqli_fetch_assoc($data_set)) {
			echo "<tr>";
			for($i = 0; $i < $count; $i++) {
				echo "<td>" . h($data[$fields[$i]]) . "</td>";
			}
			$show = "/staff/" . h(u($table_name)) . "/show.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($show) . "\">View</a></td>";
			$edit = "/staff/" . h(u($table_name)) . "/edit.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($edit) . "\">Edit</a></td>";
			$delete = "/staff/" . h(u($table_name)) . "/delete.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($delete) . "\">Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";	
	}

	function show_record($table_name, $record, $fields) {

		$index = "/staff/" . $table_name . "/index.php";
		echo "<p><a class=\"back-link\" href=\"" . url_for($index) . "\">&laquo;Back to List</a></p>"; 

		echo "<div class=\"" . $table_name . " show\">";
		$crec = count($record);
		$cfie = count($fields);
		if($crec !== $cfie) {
			echo "RECORD HAS A DIFFERENT COUNT THAN FIELDS";
			echo "<a class=\"back-link\" href=\"" . url_for($index) . "\">Back to Index</a>";
		} else {
			for ($i = 0; $i < $crec; $i++) {
				echo "<dl>";
				echo "<dt>" . $fields[$i] . ": </dt>";
				echo "<dd>" . $record[$fields[$i]] . "</dd>";
				echo "<dl>";
			}
		}
		echo "</div>";
	}

	function update_record($table_name, $record, $fields, $options=[]) {
		
		global $db;

		// $errors = validate($table_name, $record);
		// if(!empty($errors)) {
		// 	return $errors;
		// }

		$count = count($fields);

		$sql  = "UPDATE " . db_escape($db, $table_name) . " SET ";
		if ($count > 1) {
			for($i = 1; $i < ($count -1); $i++) {
				$sql .= db_escape($db, $fields[$i]) . "='" . db_escape($db, $record[$fields[$i]]) . "', ";
			}
		}
		$sql .= db_escape($db, $fields[($count-1)]) . "='" . db_escape($db, $record[$fields[($count-1)]]) . "' ";
		$sql .= "WHERE id='" . db_escape($db, $record['id']) . "' ";
		$sql .= "LIMIT 1";
		return check_query($sql);
	}

	function insert_record($table_name, $record, $fields, $options=[]) {
		global $db;

		// $errors = validate($table_name, $record);
		// if(!empty($errors)) {
		// 	return $errors;
		// }

		$cfields = count($fields);
		$crecord = count($record);

		if ($cfields == $crecord) {
			return false;
		}
		$sql  = "INSERT INTO " . db_escape($db, $table_name) . " ";
		$sql .= "(";
		if ($cfields > 1) {
			//fields includes id, which record does not (not known yet)
			for($i = 1; $i < ($cfields - 1); $i++) {
				$sql .= db_escape($db, $fields[$i]) . ", ";
			}
		}
		$sql .= db_escape($db, $fields[($cfields-1)]) . ") ";
		$sql .= "VALUES (";
		if ($crecord > 1) {
			//record will have one less field than fields because it doesn't have id yet
			for($j = 1; $j < ($crecord); $j++) {
				$sql .= "'" . db_escape($db, $record[$fields[$j]]) . "', ";
			}
		}
		$sql .= "'" . db_escape($db, $record[$fields[($cfields - 1)]]) . "')";
		return check_query($sql);
	}

	function delete_record($table_name, $id, $options=[]) {
		global $db;

		$sql  = "DELETE FROM " . db_escape($db, $table_name) . " ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
		$sql .= "LIMIT 1";

		return check_query($sql);
	}

	function find_all_records($table_name, $options=[]) {
		global $db;

		$sql = "SELECT * FROM " . db_escape($db, $table_name) . " ";

		if(isset($options['sort_by'])) {
			$sql .= $options['sort_by'];
		}

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function find_record_by_id($table_name, $id, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM " . db_escape($db, $table_name) . " ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		return find_one($sql);
	}

	function find_record_by_field($table_name, $field, $value, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM " . db_escape($db, $table_name) . " ";
		$sql .= "WHERE " . db_escape($db,$field) . "='" . db_escape($db, $value) . "'";
		return find_one($sql);
	}

	function find_class_with_levels_id($record, $options=[]) {
		global $db;

		$sql  = "SELECT id FROM class_with_levels ";
		$sql .= "WHERE class_id='" . db_escape($db, $record['class_id']) . "' ";
		$sql .= "AND level_id='" . db_escape($db, $record['level_id']) . "' ";
		$sql .= "LIMIT 1";

		return find_one($sql);
	}

	function find_class_with_types_id($record, $options=[]) {
		global $db;

		$sql  = "SELECT id FROM class_with_types ";
		$sql .= "WHERE class_id='" . db_escape($db, $record['class_id']) . "' ";
		$sql .= "AND type_id='" . db_escape($db, $record['type_id']) . "' ";
		$sql .= "LIMIT 1";

		return find_one($sql);		
	}

	function user_is_employee(){
		global $db;

		$sql  = "SELECT * FROM employees ";
		$sql .= "WHERE user_id='" . db_escape($db, $_SESSION['id']) . "' ";
		$sql .= "LIMIT 	1";

		return (find_one($sql) != null);
	}

	function get_new_record_id() {
		global $db;
		return mysqli_insert_id($db);
	}

?>