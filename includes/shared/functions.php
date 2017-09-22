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
		if(isset($_SESSION['last_page'])) { unset($_SESSION['last_page']); }
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

	//Session functions
	function log_in_user($user) {
		session_regenerate_id();
		$_SESSION['id'] = $user['id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['access_level'] = (int)$user['access_level'];
		//eventually add the employee id and person's name
		return true;
	}

	function is_logged_in(){
		return isset($_SESSION['id']);
	}

	function require_login($req="0", $options=[]) {
		$r = (int)$req;
		$l = (int)$_SESSION['access_level'] ?? 0;
		if(!is_logged_in()) {
			redirect_to(url_for('/private/login.php'));
		} elseif ($r > $l) {
			redirect_to(url_for('/private/access_denied.php'));
		} else {

		}
	}
	
	function logout_user() {
		unset($_SESSION['id']);
		unset($_SESSION['username']);
		unset($_SESSION['access_level']);
		return true;
	}

	//php html functions
	function value_or_placeholder($value, $place) {
		if(has_presence($value)) { 
			return "value=\"" . $value . "\""; 
		} else { 
			return "placeholder=\"" . $place . "\"";	
		}
	}

	//DATE Functions
	//date format is MM-DD-YYYY coming in
	function convert_date($date) {
		$len = strlen($date);
		$month = '';
		$day = '';
		$year = '';

		if ($len == 8) {
			$month = substr($date, 0, 2);
			$day = substr($date, 2, 2);
			$year = substr($date, 4, 4);
		} else {
			$month = substr($date, 0, 2);
			$day = substr($date, 3, 2);
			$year = substr($date, 6, 4);
		}

		return $year . '-' . $month . '-' . $day;
	}
	//date format is MM-DD-YYYY coming in
	function get_month($date) {
		return substr($date, 0, 2);
	}
	//date is assumed to be in sql format YYYY-MM-DD
	function get_month_sql($date) {
		return substr($date, 5, 2);
	}
	//date format is MM-DD-YYYY coming in
	function get_day($date) {
		$len = strlen($date);
		if($len == 8) {
			return substr($date,2,2);
		} else {
			return substr($date,3,2);
		}
	}
	//date is assumed to be in sql format YYYY-MM-DD
	function get_day_sql($date) {
		return substr($date,8,2);
	}
	//date format is MM-DD-YYYY coming in
	function get_year($date) {
		$len = strlen($date);
		if($len == 8) {
			return substr($date, 4, 4);
		} else {
			return substr($date, 6, 4);
		}
	}
	//date is assumed to be in sql format YYYY-MM-DD
	function get_year_sql($date) {
		return substr($date, 0, 4);
	}
	//converts a single digit day into a 0 left padded day
	function convert_day($day) {
		if (strlen($day) == 1) { 
			$day = str_pad($day, 2, "0", STR_PAD_LEFT); 
		}
		return $day;
	}
	//converts a single digit month into a 0 left padded month
	function convert_month($mon) {
		if (strlen($mon) == 1) { 
			$mon = str_pad($mon,2, "0", STR_PAD_LEFT); 
		}
		return $mon;
	}
	//converts an array of type $date - ('day', 'month', 'year') into a string of
	//YYYY-MM-DD or NULL if any are blank
	function convert_to_date($date) {
		if(is_blank($date['month']) || is_blank($date['day']) || is_blank($date['year'])) {
			return null;
		}		
		$day = convert_day($date['day']);
		$mon = convert_month($date['month']);
		return $date['year'] . '-' . $mon . '-' . $day;
	}
