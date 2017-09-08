<?php

	function url_for($path) {
		if($path[0] != '/') {
			$path = "/" . $path;
		}
		return WWW_ROOT . $path;
	}

	function u($string="") {
		return urlencode($string);
	}

	function h($string="") {
		return htmlspecialchars($string);
	}

	function raw_u($string="") {
		return rawurlencode($string);
	}

	function error_404() {
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
		exit();
	}

	function error_500() {
		header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
	}

	function redirect_to($location) {
		header("Location: " . $location);
		exit();
	}

	function is_post_request() {
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	function is_get_request() {
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	function display_errors($errors=array()) {
		$output = '';
		if(!empty($errors)) {
			$output .= "<div class=\"errors\">";
			$output .= "Please fix the following errors:";
			$output .= "<ul>";
			foreach($errors as $error) {
				$output .= "<li>";
				$output .= h($error);
				$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}

	function get_and_clear_session_message() {
		if(isset($_SESSION['status_msg']) && $_SESSION['status_msg'] != '') {
			$msg = $_SESSION['status_msg'];
			unset($_SESSION['status_msg']);
			return $msg;
		}
	}

	function display_session_message() {
		$msg = get_and_clear_session_message();
		if(!is_blank($msg)) {
			return '<div id="message">' . h($msg) . '</div>';
		}
	}