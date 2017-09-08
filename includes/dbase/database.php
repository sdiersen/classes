<?php
	
	function db_connect($user = DB_USER, $pass = DB_PASS, $name = DB_NAME, $server = DB_SERVER) {
		$connection = mysqli_connect($server, $user, $pass, $name);
		if(mysqli_connect_errno()) {
			$msg  = "Database connection failed: ";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ")";
			exit($msg);
		}
		return $connection;
	}
	
	function db_disconnect($connection) {
		if(isset($connection)) {
			mysqli_close($connection);
		}
	}

	function db_escape($connection, $string) {
		return mysqli_real_escape_string($connection, $string);
	}

	function confirm_result_set($result_set) {
		if(!$result_set) {
			exit("Database query failed.");
		}
	}
?>