<?php
	require_once('../includes/initialize.php');
	require_login();

	if(is_post_request()){
		logout_user();
		redirect_to(url_for('/private/login.php'));
	}

	$page_title = 'FitEvoMN Staff - Logout';

	include(SHARED_PATH . DS . 'staff_header.php');

?>
<div id="content">
	<p>Are you sure you want to logout?</p>
	<form id=logoutForm method="POST">
		<input class="btn btn-primary" type=submit value="Logout"/>
	</form>
</div>

<?php
	include(SHARED_PATH . DS . 'staff_footer.php');
?>