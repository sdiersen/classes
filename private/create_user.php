<?php
	require_once('../includes/initialize.php');

	$errors = [];
	$user = '';

	if(is_post_request()){
		$user = $_POST['username'] ?? '';
		$pass = $_POST['password'] ?? '';
		$conf = $_POST['confirm'] ?? '';

		$rec = find_record_by_field('users', 'username', $user);
		if(!is_null($rec)){
			$errors[] = "Username already in use";
		} else {
			$errors = validate_username($user);
			$errors = array_merge($errors, validate_password($pass, $conf));
		}

		$e = array_filter($errors);
		if(empty($e)){
			$hash = password_hash($pass, PASSWORD_BCRYPT);
			$new_user = [];
			$new_user['username'] = h($user);
			$new_user['hashed_password'] = $hash;
			insert_record('users', $new_user, USERS_FIELDS);
			$new_user = find_record_by_field('users', 'username', $user);
			log_in_user($new_user);
			redirect_to(url_for('/private/staff/index.php'));

			// $errors[] = "User id: " . $new_user['id'];
			// $errors[] = "username: " . $new_user['username'];
			// $errors[] = "password: " . $hash;
		}

	}



	$page_title = 'FitEvoMN - Create New Staff User';
	include(SHARED_PATH . DS. 'staff_header.php');
?>

<div id="content">

	<h1>Create User</h1>
	<?php echo display_errors($errors); ?>

	<form action="create_user.php" method="post">
		<table class="table">
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username" value="<?php echo $user; ?>" /></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td>Confirm Password: </td>
				<td><input type="password" name="confirm"/></td>
			</tr>
			<tr>
				<td><input type="submit" class="btn btn-warning" value="Create User" /></td>
			</tr>
		</table>
	</form>
</div>


<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>