<?php 
	session_start();
	if($_SERVER['REQUEST_URI'] != "/login.php" && $_SERVER['REQUEST_URI'] != "/includes/sign_in.php"){
			
			$_SESSION['pageDirect'] = $_SERVER['REQUEST_URI'];
			$_SESSION['direct-to-solutions'] = true;
			if (!isset($_SESSION['logged_in'])) {
				header("Location: /login.php");
				exit;
			}
		}
	$page = $_SERVER['REQUEST_URI'];
	$page = str_replace("/", "", $page);
	echo $page;

	

	if ($page == 'index.php') {
		header('Location: /status.php');
	}

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Solutions - <?php echo ucwords(str_replace("_", " ", substr($page, 0, strrpos($page, ".php")))); ?></title>
<link rel="shortcut icon" href="../images/imgs/favicon.ico" type="image/x-icon" />
<link href="mystyles.css" rel="stylesheet" type="text/css" />
<link href="solution_style.css" rel="stylesheet" type="text/css" />
<!--jQueryUDF-->
<script type="text/javascript" src="jqueryudf/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jqueryudf/ui.core.js"></script>
<script type="text/javascript" src="jqueryudf/jquery.ui.ufd.js"></script>
<link rel="stylesheet" type="text/css" href="jqueryudf/ufd-base.css" />
<link rel="stylesheet" type="text/css" href="jqueryudf/plain.css" />
<script type="text/javascript" src="solutions_scripts.js"></script>

<!--jQueryUDF-->
</head>
<body>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=600,width=700,scrollbars=yes');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<div style="padding:20px; min-width:960px; max-width:1111px; margin:auto;">
	<div class="twothirds"><a href="/"><img src="images/logo.gif" alt="Intuitive IT Solutions" width="250" /></a></div>
    <!--<div class="third"><input style="float:right; height:20px; width:140px;" type="text" id="search" name="search" /><label style="float:right; font-size:122%;" for="search">Search</label></div>-->

	<div style="float:right;">Signed in as  <?php echo '<a href="employee.php">'.ucwords($_SESSION['user_name']).'</a>'; ?> | <a href="../../includes/sign_out.php">Sign Out</a></div>
</div>
<div class="container" style="padding:10px;" align="center">
<div style="min-width:960px; max-width:1111px; background-color:white; border:1px black solid; clear:both; overflow:hidden; padding:10px;" class="shadow">
       <div style="width:15%; float:left;" align="left">
    	  <ul class="navi">
    	    <li><a href="/company.php">company</a><a href="/edit/company.php"><img src="/images/add.jpg" /></a></li>
			<li><a href="/problem.php">problem</a><a href="/edit/problem.php"><img src="/images/add.jpg" /></a></li>
			<hr />
			
			<a href="/transfer_sql.php">Transfer SQL</a>

    	  </ul>
      </div>
      <div style="width:85%; float:left;">
        <div style="padding-left:10px;">
        	<table style="padding-left:15px;" width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td><h1 style="margin-bottom:0px;"><?php echo ucwords(str_replace("_", " ", substr($page, 0, strrpos($page, ".php")))); ?></h1></td>
            </tr>
            <tr>
              <td align="center" style="vertical-align:middle; position:relative;">
              <?php
				  if (strrpos($page, "?")) {
					  $page = substr($page, 0, strrpos($page, "?"));
				  }
				  if ($page == "index.php") {
					  $page = "status.php";
				  }
				  include("../".$page);
			  ?>
              </td>
            </tr>
            </table>
        </div>
      </div>
      <div style="clear:both;"></div>
      <!--<div style="position:relative; left:-42%;">Signed in as  <?php echo '<a href="employee.php">'.ucwords($_SESSION['user_name']).'</a>'; ?> | <a href="../../includes/sign_out.php">Sign Out</a></div>-->
    </div>
</div>
<div style="padding:5px; color:#333; font-size:80%; text-align:center;">
	V 2.0 Solutions Center - &copy; Intuitive IT Solutions 2011
	<br />Updated 6/14/2011
</div>
<div id="search_drop_down" style="height:100px; width:100px; position:absolute; top:50%; left:50%; background-color:#0F0; display:none;">search box</div>
</body>
</html>
