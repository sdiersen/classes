<?php
	require_once('../../../includes/initialize.php');
	require_login(1);

	$employee = [];
	$phone = [];
	$address = [];

	if(is_post_request()){
		$employee['first_name'] = $_POST['first'] ?? '';
		$employee['middle_name'] = $_POST['middle'] ?? '';
		$employee['last_name'] = $_POST['last'] ?? '';
		$employee['birth_date'] = $_POST['dob'] ?? '';
		$employee['date_hired'] = $_POST['hired'] ?? '';
		$employee['emp_id'] = $_POST['emp_id'] ?? 'XXXXXXX';
	}
	else {
		$employee['first_name'] = '';
		$employee['middle_name'] = '';
		$employee['last_name'] = '';
		$employee['birth_date'] = '1971-04-21';
		$employee['date_hired'] = '2015-11-06';
		$employee['emp_id'] = 'XXXXXXX';
	}

	$page_title = 'Employee Forms';

	include(SHARED_PATH . DS . 'staff_header.php');

?>
<div id="content">
	<a class="back-link" href="<?php echo url_for('/private/crud/employees/index.php'); ?>">&laquo;Back to List</a>

	<div class="employees new">
		<?php echo display_errors($errors); ?>

		<form id="newEmployeeForm" action="<?php echo url_for('/private/crud/employees/new.php'); ?>" method="post">
			<dl>
				<dt>First Name: </dt>
				<dd><input type="text" name="first" value="<?php echo h($employee['first_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Middle Name: </dt>
				<dd><input type="text" name="middle" value="<?php echo h($employee['middle_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Last Name: </dt>
				<dd><input type="text" name="last" value="<?php echo h($employee['last_name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Date of Birth: </dt>
				<dd><input type="date" name="dob" value="<?php echo h($employee['birth_date']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Date Hired: </dt>
				<dd><input type="date" name="hired" value="<?php echo h($employee['date_hired']); ?> " /> </dd>
			</dl>
			<dl>
				<dt>Employee ID: </dt>
				<dd><input type="text" name="emp_id" maxlength="7" minlength="7" value="<?php echo h($employee['emp_id']); ?>" /></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Create Employee" />
			</div>
		</form>

</div>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>