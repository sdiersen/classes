<?php
	require_once('../../../includes/initialize.php');
	require_login(1);

	// if(user_is_employee()) {
	// 	redirect_to(url_for('/private/crud/employees/edit.php'));
	// }

	$employee = [];
	$phone = [];
	$address = [];
	$errors = [];
	$dob = [];
	$hired = [];

	if(is_post_request()){

		$dob['year'] = $_POST['dob_year'] ?? '';
		$dob['month'] = convert_month($_POST['dob_month'] ?? '');
		$dob['day'] = convert_day($_POST['dob_day'] ?? '');
		$hired['year'] = $_POST['hired_year'] ?? '';
		$hired['month'] = convert_month($_POST['hired_month'] ?? '');
		$hired['day'] = convert_day($_POST['hired_day'] ?? '');


		$employee = convert_post_to_employee($_POST);
		$result = create_employee($employee);
		if (is_int($result)) {
			$employee['id'] = $result;
		} else {
			$errors = $result;
		}



	}
	else {

		$employee['first_name'] = '';
		$employee['middle_name'] = '';
		$employee['last_name'] = '';
		$employee['emp_id'] = '';
		$dob['year'] = '';
		$dob['month'] = '';
		$dob['day'] = '';
		$hired['year'] = '';
		$hired['month'] = '';
		$hired['day'] = '';
	}

	$page_title = 'Employee Forms';

	include(SHARED_PATH . DS . 'staff_header.php');

?>
<div id="content">
	<a class="back-link" href="<?php echo url_for('/private/crud/employees/index.php'); ?>">&laquo;Back to List</a>

	<div class="employees new">
		<?php echo display_errors($errors); 
			echo "First name: " . $employee['first_name'] . " or said another way " . ($_POST['first'] ?? "");
			echo "<br>User id: " . $_SESSION['id'];
		?>
		
		<form id="newEmployeeForm" action="<?php echo url_for('/private/crud/employees/new.php'); ?>" method="post">
			<dl>
				<dt id="first_name_title">First Name:</dt>
				<dd><input id="first_name_input" type="text" name="first" <?php echo value_or_placeholder($employee['first_name'], "First Name"); ?> /></dd>
			</dl>
			<dl>
				<dt id="middle_name_title">Middle Name:</dt>
				<dd><input id="middle_name_input" type="text" name="middle" <?php echo value_or_placeholder($employee['middle_name'], "Middle Name"); ?> /></dd>
			</dl>
			<dl>
				<dt id="last_name_title">Last Name: </dt>
				<dd><input type="text" name="last" id="last_name_input" <?php echo value_or_placeholder($employee['last_name'], "Last Name"); ?> /> </dd>
			</dl>
			<dl>
				<dt id="dob_title">Date of Birth: </dt>
				<dd>
					<input id="dob_month_input" type="text" name="dob_month" pattern="\d{1,2}" size="2" maxlength="2" title="MM or M (example: 04 or 4)" 
						<?php echo value_or_placeholder($dob['month'], "MM"); ?>"/> / 
					<input id="dob_day_input" type="text" name="dob_day" pattern="\d{1,2}" size="2" maxlength="2" title="DD or D (example: 05 or 5)" 
						<?php echo value_or_placeholder($dob['day'], "DD"); ?>"/> /
					<input id="dob_year_input" type="text" name="dob_year" pattern="\d{4}" size="2" maxlength="4" title="YYYY (example: 2002)" 
						<?php echo value_or_placeholder($dob['year'], "YYYY"); ?>"/>
				</dd>
			</dl>
			<dl>
				<dt id="hire_title">Date Hired: </dt>
				<dd>
					<input id="hire_month_input" type="text" name="hired_month" pattern="\d{1,2}" size="2" maxlength="2" title="MM or M (example: 02 or 2)" 
						<?php echo value_or_placeholder($hired['month'], "MM"); ?>"/> / 
					<input id="hire_day_input" type="text" name="hired_day" pattern="\d{1,2}" size="2" maxlength="2" title="DD or D (example: 09 or 9)"
						<?php echo value_or_placeholder($hired['day'], "DD"); ?> />  /
					<input id="hire_year_input" type="text" name="hired_year" pattern="\d{4}" size="2" maxlength="4" title="YYYY (example: 1903)"
						<?php echo value_or_placeholder($hired['year'], "YYYY"); ?> />
				</dd>
			</dl>
			<dl>
				<dt>Employee ID: </dt>
				<dd><input type="text" name="emp_id" maxlength="7" minlength="7" title="XXXXXXX (example: FE-3321)" <?php echo value_or_placeholder($employee['emp_id'], "XXXXXXX"); ?> /></dd>
			</dl>
			<div id="operations">
				<input class="btn btn-primary" type="submit" value="Create Employee" />
			</div>
		</form>
	</div>
</div>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>