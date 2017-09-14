<?php
	require_once('../includes/initialize.php');
	require_login();

	$page_title = 'Access Denied';

	include(SHARED_PATH . DS . 'staff_header.php');

?>
<div id="content">
	<h1>You do not have the correct access level for that page!</h1>
</div>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>