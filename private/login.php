<?php
	require_once('../includes/initialize.php');
	global $errors;
	global $db;
	$error = false;
	if (!isset($_POST['username']))
	{
		return "username must be present";
	}

	if (!isset($_POST['password'])){
		return "Password is required";
	}

	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	$sql  = "SELECT * FROM users ";
	$sql .= "WHERE username='" . db_escape($db, $user) . "' ";
	$sql .= "LIMIT 1";

	$account = find_one($sql);

	if($account) {
		if(password_verify($pass, $account['hashed_password'])) {
			echo "account verified";
			return;
		}
		else
		{
			echo "password wrong";
			return;
		}
	}
	else {
		echo "account not found";
		return;
	}
	
?>