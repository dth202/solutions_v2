<?php
	session_start();
	if (isset($_SESSION['css_version'])) {
		if ($_SESSION['css_version'] == 0) {
			$_SESSION['css_version'] = 1;
		} else {
			$_SESSION['css_version'] = 0;
		}
	} else {
		$_SESSION['css_version'] = 0;
	}
	header("Location: " . $_SERVER['HTTP_REFERER']);
?>