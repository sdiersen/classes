<?php
	require_once('../../../includes/initialize.php');
	require_login(1);

	$level = (int)$_SESSION['access_level'];
	$options = [];
	$options['sort'] = "ORDER BY employees.last_name ASC, employees.first_name ASC, employees.middle_name ASC";
	$sort = "last";

	if(is_post_request()) {
		if($level > 1) {
			$options['access'] = ", users.username AS username";
		}
		if(isset($_POST['sortType'])) {
			if ($_POST['sortType'] == "Last") {
				$options['sort'] = "ORDER BY employees.last_name ASC, employees.first_name ASC, employees.middle_name ASC";
				$sort = "last";
			} elseif ($_POST['sortType'] == "First") {
				$options['sort'] = "ORDER BY employees.first_name ASC, employees.last_name ASC, employees.middle_name ASC";
				$sort = "first";
			} elseif ($_POST['sortType'] == "Username") {
				$options['sort'] = "ORDER BY users.username ASC";
				$sort = "user";
			}
		}
	}

	$employee_set = employees_index($options);

	$page_title = 'Employee Forms';

	function showValue($value) {
		echo "<td>" . h($value) . "</td>";
	}

	function showBtnHeader($value, $disabled=false) {
		echo "<th><input type=\"submit\" name=\"sortType\" class=\"btn btn-primary\" value=\"" . $value . "\"";
		if($disabled) { echo "disabled=\"disabled\""; }
		echo " /></th>";
	}

	function showActions($row) {
		global $level;
		echo "<td> <a class=\"action\" href=\"" . url_for('/private/crud/employees/show.php?id=' . u(h($row['id']))) . "\">View</a></td>";
		if($level >= 1){
			echo "<td> <a class=\"action\" href=\"" . url_for('/private/crud/employees/edit.php?id=' . u(h($row['id']))) . "\">Edit</a></td>";
		}
		if($level >= 2) {
			echo "<td> <a class=\"action\" href=\"" . url_for('/private/crud/employees/delete.php?id=' . u(h($row['id']))) . "\">Delete</a></td>";
		}
		echo "</tr>";
	}

	function showRow($row) {
		global $level, $sort;
		echo "<tr>";
		if ($sort == "first") {
			showValue($row['first']);
			showValue($row['last']);
			showValue($row['middle']);
			if($level > 1) {
				showValue($row['username']);
			}
		} elseif ($sort == "user" && $level > 1) {
			showValue($row['username']);
			showValue($row['last']);
			showValue($row['first']);
			showValue($row['middle']);
		} else {
			showValue($row['last']);
			showValue($row['first']);
			showValue($row['middle']);
			if($level > 1) {
				showValue($row['username']);
			}
		}
		showActions($row);
	}

	function showHead() {
		global $level, $sort;
		echo "<tr>";
		echo "<form action=\"" . url_for('private/crud/employees/index.php') . "\" method=\"post\">";
		if ($sort == "first") {
			showBtnHeader("First");
			showBtnHeader("Middle", true);
			showBtnHeader("Last");
			if($level > 1) {
				showBtnHeader("Username");
			}
		} elseif ($sort == "user" && $level > 1) {
			showBtnHeader("Username");
			showBtnHeader("Last");
			showBtnHeader("First");
			showBtnHeader("Middle", true);
		} else {
			showBtnHeader("Last");
			showBtnHeader("First");
			showBtnHeader("Middle", true);
			if($level > 1) {
				showBtnHeader("Username");
			}
		}
		echo "</form>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";
	}

	include(SHARED_PATH . DS . 'staff_header.php');

?>
<div id="content">
	<div class="employees listing">
		<h1>Employee List</h1>
		<div class="actions">
			<p><a class="action" href="<?php echo url_for('/private/crud/employees/new.php'); ?>">Create New Employee</a></p>
		</div>
		<table class="table">
			<?php
				showHead();
				while($emp = mysqli_fetch_assoc($employee_set)) {
					showRow($emp);
			} ?>
		</table>
	</div>
</div>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>