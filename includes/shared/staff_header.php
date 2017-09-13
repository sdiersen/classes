<?php
	if(!isset($page_title)) { $page_title = "Staff Area"; }
?>

<!doctype html>
	<html lang="en">
		<head>
			<title><?php echo h($page_title); ?> </title>
			<meta charset="utf-8">
			<link rel="stylesheet" media="all" href="<?php echo url_for('/public/css/bootstrap.min.css'); ?>" />
			<link rel="stylesheet" media="all" href="<?php echo url_for('/public/css/staff.css'); ?>" />
		</head>
		<body>
			<header>
				<h1>FitEvoMN Staff Area</h1>
			</header>

			<?php echo display_session_message(); ?>