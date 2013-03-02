<?php
session_start();
if (!isset($_SESSION['css_version'])) {
	$_SESSION['css_version'] = 0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Intuitive IT Solutions</title>
<link rel="shortcut icon" href="./../images/imgs/favicon.ico" type="image/x-icon" />
<link href="<?php if (isset($_SESSION['css_version'])) { if ($_SESSION['css_version'] == 0) { echo './../mystyles.css'; } else { echo './../mystyles2.css'; } } ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
}
</style>
</head>
<body id="top">
<div id="container">
      <?php include('./includes/header.php'); ?>
  	  <div id="navbar">
      	<?php include('./includes/navigation.php'); ?>
      	   <div id="content" <?php if(!$fireFox) { echo 'style="margin:0px 2px 0px 0px;"'; } ?>>
		      <div align="center">
				The page you are looking for can not be found. Please try again or email us at <a href="mailto:support@intuitiveits.com">support@intuitiveits.com</a>
			  </div>
      	 </div>
      	 <?php include('./includes/footer.php'); ?>
  	</div>
</div>
</body>
</html>