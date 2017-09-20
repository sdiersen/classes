<?php
	require_once('../../../includes/initialize.php');
	require_login(1);

	if(user_is_employee()) {
		redirect_to(url_for('/private/crud/employees/edit.php'));
	}

	$employee = [];
	$phone = [];
	$address = [];
	$errors = [];

	if(is_post_request()){
		$dob = $_POST['dob'] ?? '';
		$employee['birth_date'] = convert_date($dob);

		$hired = $_POST['hired'] ?? '';
		$employee['date_hired'] = convert_date($hired);

		$employee['first_name'] = $_POST['first'] ?? '';
		$employee['middle_name'] = $_POST['middle'] ?? '';
		$employee['last_name'] = $_POST['last'] ?? '';
		$employee['emp_id'] = $_POST['emp_id'] ?? null;
		$employee['user_id'] = $_SESSION['id'] ?? '';

		$errors = validate('employees', $employee);

	}
	else {

		$employee['first_name'] = '';
		$employee['middle_name'] = '';
		$employee['last_name'] = '';
		$employee['birth_date'] = '1971-04-21';
		$employee['date_hired'] = '2015-11-06';
		$employee['emp_id'] = '';
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
				<dd><input type="text" name="dob" placeholder="MM-DD-YYYY" pattern="(\d{2}-\d{2}-\d{4}|\d{8}|\d{2}/\d{2}/\d{4})" title="MM-DD-YYYY or MM/DD/YYYY or MMDDYYYY" /> </dd>
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
<script>
	function browserSupportsDateInput() {
		var i = document.createElement("input");
		i.setAttribute("type", "date");
		return i.type !== "text";
	}
</script>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>