<?php
	require_once('../includes/initialize.php');
		
	$errors = [];
	$user = ' ';
	$pass = ' ';

	// $errors = validate_username($user);
	// $errors = array_merge($errors, validate_password($pass));

	// if(!empty($errors)) {
	// 	echo "<div class=\"errors\"><ul><li>Username/Password Combination Not Found</li></ul></div>";
	// 	return;
	// }
	if (is_post_request()) {
		if($_POST['userType'] == 'Create')
			redirect_to(url_for('/private/create_user.php'));

		$user = trim($_POST['username']) ?? '';
		$pass = trim($_POST['password']) ?? '';

		$account = find_record_by_field('users', 'username', $user);
		//echo "<br> This is the account name : " . $account['username'] . " access : " . $account['access_level'];
		if($account) {
			if(password_verify($pass, $account['hashed_password'])) {
				log_in_user($account);
				redirect_to(url_for('/private/staff/index.php'));
			}
		}
		$errors[] = "Username/Password combination was not found";
	}
	// echo "<div class=\"errors\"><ul><li>Username/Password Combination Not Found</li></ul></div>";
	// return;

	$page_title = 'FitEvoMN - Staff Area';
	include(SHARED_PATH . DS . 'staff_header.php');

?>

	<div id="content">
		<h1>Log In</h1>
		<?php echo display_errors($errors); ?>

		<form action="login.php" method="post">
			<table class="table">
				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" value="<?php echo $user; ?>" /></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td><input type="submit" class="btn btn-success" name="userType" value="Login" /></td>
				</tr>
				<tr>
					<td><input type="submit" class="btn btn-primary" name="userType" value="Create" /></td>
			</table>
		</form>
	</div>

<?php include(SHARED_PATH . DS . 'staff_footer.php'); ?>
