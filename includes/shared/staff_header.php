<?php
	if(!isset($page_title)) { $page_title = "Staff Area"; }
?>

<!doctype html>
	<html lang="en">
		<head>
			<title><?php echo h($page_title); ?> </title>
			<meta charset="utf-8">
			<link rel="stylesheet" media="all" href="<?php echo url_for('/public/css/tether.min.css'); ?> "/>
			<link rel="stylesheet" media="all" href="<?php echo url_for('/public/css/bootstrap.min.css'); ?>" />
			<link rel="stylesheet" media="all" href="<?php echo url_for('/public/css/staff.css'); ?>" />
		</head>
		<body>
			<header>
				<h1>FitEvoMN Staff Area</h1>
			</header>
			<navigation>
				<ul>
					<li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
					<li><a href="<?php echo url_for('/private/staff/index.php'); ?>">Menu</a></li>
					<li><a href="<?php echo url_for('/private/staff/profile.php'); ?>">Profile</a></li>
					<li><a href="<?php echo url_for('/private/logout.php'); ?>">Logout</a></li>
				</ul>
			</navigation>

			<?php echo display_session_message(); ?>