<?php
	require_once('../initialize.php');
	if(is_post_request()) {
		$user = $_POST['username'] ?? '';
		$pass = $_POST['password'] ?? '';
		$acc = (int)$_POST['access'] ?? '';

		$hash_pass = password_hash($pass, PASSWORD_BCRYPT); //use password_verify($pass, $hash_pass); to test for correct password
		$rec = find_record_by_field('users', 'username', $user);

		if (is_null($rec)) {
			//username is not used, create user and put in db
			$new_user = [];
			$new_user['username'] = h($user);
			$new_user['hashed_password'] = $hash_pass;
			$new_user['access_level'] = $acc;
			insert_record('users', $new_user, USERS_FIELDS);
		} else {
			//username is in the database, inform and ask for new username
			
		}
	} elseif (is_get_request()) {
		//get request-- the only way to get in the page is to match a random tag and value
		if(isset($_GET['superman']) && $_GET['superman'] == 'steved') {
			//let the person in
		}
		else {
			error_404();
		}
	} else {
		error_404();
	}

?>
<html>
	<head>
	</head>
	<body>
		<div class="here is where the new form starts for the username and password">
		<form action="make_user.php" id="newUser" method="POST">
			<dl>
				<dt>Username: </dt>
				<dd><input type="text" name=username /></dd>
			</dl>
			<dl>
				<dt>Password: </dt>
				<dd><input type="password" name=password /></dd>
			</dl>
			<dl>
				<dt>Access Level: </dt>
				<dd>
					<select name="access">
						<option value=0 selected="selected">Guest</option>
						<option value=1>Instructor</option>
						<option value=2>GX Co-ordinator</option>
						<option value=3>Administrator</option>
					</select>
				</dd>
			</dl>
			<div>
				<input type=submit id=submit value="Create New User" />
			</div>

		</form>
		</div>
	</body>
</html>