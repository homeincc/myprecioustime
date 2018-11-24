<?php
	require "db.conf.php";
	
	include "user.php";
	

	function Connect() {
		global $DB_HOST, $DB_NAME, $DB_PASS, $DB_USER;
		$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
		// set the PDO error mode to exception
		if (!$con->connect_error) {
			$con->set_charset("utf8");
			return $con;
		} else {
			echo $con->connect_error;
			return false;
		}
	}
?>