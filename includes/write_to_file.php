<?php
	session_start();
	if (!isset($_SESSION['logged_in'])) {
		header("Location: /login/");
		exit;
	}
	//echo $_POST['files'];
	//echo stripslashes($_POST['fileText']);
	$file = fopen("../" . $_POST['files'], "w");
	fwrite($file, stripslashes($_POST['fileText']));
	fclose($file);
	header("Location: /edit/");
?>