<?php
session_start();
if (!isset($_SESSION['css_version'])) {
	$_SESSION['css_version'] = 0;
}

$page = $_SERVER['REQUEST_URI'];
	$page = str_replace("/solutions/", "", $page);

	if ($page == 'index.php' || $page == '/') 
		header('Location: /solutions/problem.php');
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
      </div>
       <div id="content" <?php if($webkit) { echo 'style="margin:0px 2px 0px 0px;"'; } ?>>
          <?php
        $page = $_SERVER['REQUEST_URI'];
        $page = str_replace("/index.php", "/", $page);
        if ($page == "/") {
              include("home.php");
        }  else {
                if (strpos($page, "support_plans") > 0) {
                    include('./includes/topbar.php');
                }
                if (strpos($page, ".php") > 0) {
                    if (!@include(substr($page, strpos($page, "/", 1) + 1))) {
                        echo '<script type="text/javascript">';
                        echo 'window.location = "/404.php"';
                        echo '</script>';
                    }
                } elseif (strpos($page, "/", 1) > 0) {
                    if (!@include(trim($page, "/") . '.php')) {
                        echo '<script type="text/javascript">';
                        echo 'window.location = "/404.php"';
                        echo '</script>';
                    }
                }
        }
            
            ?>
     </div>
     <?php include('./includes/footer.php'); ?>
</div>
</body>
</html>