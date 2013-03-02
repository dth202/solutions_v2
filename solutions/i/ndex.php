<?php 
	session_start();
	date_default_timezone_set('America/Denver');
	$_SESSION['pageDirect'] = $_SERVER['REQUEST_URI'];
	$_SESSION['direct-to-solutions'] = true;
	if (!isset($_SESSION['logged_in'])) {
		header("Location: /login.php");
		exit;
	}
	$page = $_SERVER['REQUEST_URI'];
	
	require_once("../php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();

	$page = str_replace("/solutions/", "", $page);
	
	if ($_SERVER['REQUEST_URI'] == '/solutions/') 
		header('Location: /solutions/problem.php');
	
	if($_SESSION[user_type] == 'manager')
	{
		$manager = true;
	}
	else
	{
		$manager = false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Solutions - <?php echo ucwords(str_replace("_", " ", substr($page, 0, strrpos($page, ".php")))); ?></title>
	
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
	<script src="/solutions/php_scripts/signature/build/jquery.min.js"></script>
	<script src="/solutions/php_scripts/signature/build/jquery.signaturepad.min.js"></script>
	<script src="/solutions/php_scripts/signature/build/json2.min.js"></script>
	<link rel="stylesheet" href="/solutions/php_scripts/signature/build/jquery.signaturepad.css">
	
	
	<link rel="shortcut icon" href="./../images/favicon.ico" type="image/x-icon" />
	<link href="/mystyles.css" rel="stylesheet" type="text/css" />
	<link href="/solutions/solution_style.css" rel="stylesheet" type="text/css" />
	
	<!--jQueryUDF
	<script type="text/javascript" src="/signature/php_scripts/jqueryudf/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/signature/php_scripts/jqueryudf/ui.core.js"></script>
	<script type="text/javascript" src="/signature/php_scripts/jqueryudf/jquery.ui.ufd.js"></script>
	<link rel="stylesheet" type="text/css" href="jqueryudf/ufd-base.css" />
	<link rel="stylesheet" type="text/css" href="jqueryudf/plain.css" />
	-->
	<!--jQueryUDF-->
	
	<script type="text/javascript" src="/solutions/php_scripts/solutions_scripts.js"></script>
	
	<!--Signature information-->
	<!--[if lt IE 9]><script src="/solutions/php_scripts/signature/flashcanvas.js"></script><![endif]-->
	
	
	
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
		<div class="twothirds"><a href="/solutions/"><img src="/images/logo.png" alt="Intuitive IT Solutions" width="250" /></a></div>
		
		<?php
			echo "<div style='float:right;'>Signed in as  
					<a href='employee.php'>$_SESSION[user_name] - $_SESSION[user_type]</a> | <a href='../../includes/sign_out.php'>Sign Out</a></div>";
		?>
	</div>
	<div id="searchbox">
		<label>Search</label><input />
	</div>
	<div class="container" style="padding:10px;" align="center">
		<div style="min-width:960px; max-width:1111px; background-color:white; border:1px black solid; clear:both; overflow:hidden; padding:10px;" class="shadow">
			<div style="width:15%; float:left;" align="left">
				<ul class="navi">
					<li><a href="/solutions/company.php">company</a><a href="/solutions/company.php?edit=insert"><img src="/images/add.jpg" /></a></li>
					<li><a href="/solutions/problem.php">problem</a><a href="/solutions/problem.php?edit=insert"><img src="/images/add.jpg" /></a></li>
					<li><a href="/solutions/kbn.php">Knowledge Base</a><a href="/solutions/kbn.php?edit=insert"><img src="/images/add.jpg" /></a></li>
					<li><a href="/solutions/reports.php">Reports</a></li>
					<li><hr /></li>
					<li><a href="/solutions/transfer_sql.php">Transfer SQL</a><br /></li>
					<?php
					echo "  <li>
								<ul class='navi'>";
									$technicians = $sqlTool->getEmployees();
									
									// echo "<pre>";
										// print_r($technicians);
									// echo "</pre>";
									foreach($technicians as $key => $value) 
									{
										// $firefighting = "";
										// if($value[tech_id] == $firefighter)
										// {
											// $firefighting = "<span style='color: red;'>*</span>";
										// }
										
										echo "<li><a href='/solutions/employee.php?employee_id=$value[id]'>$value[fname] $value[lname]</a></li>";
									}
									//echo "<li><span style='color: red;'>*</span>Current Firefighter</li>";
								echo "</ul>
							</li>
							<li><hr /></li>
							<!-- DELETE WHEN GOING LIVE -->
							<li>
								<ol class='navi'>";
									foreach($technicians as $key => $value) 
									{
										echo "<li><a href='/solutions/change_user.php?employee_id=$value[id]'>$value[id] - $value[fname] </a></li>";
									}
						echo 	"</ol>
							</li>
							";
					?>
					
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

		</div>
	</div>
	<div style="padding:5px; color:#333; font-size:80%; text-align:center;">
		V 2.0 Solutions Center - &copy; Intuitive IT Solutions 2011
		<br />Updated 6/14/2011
	</div>
	<span style="margin: 0 auto; display: block; width: 120px;" id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=fv9J2rEEweO4uORL3GSKNVwYyA9eUV9qSFVpva4PSjWIy1rk5Q4NBA"></script></span>
	<div id="search_drop_down" style="height:100px; width:100px; position:absolute; top:50%; left:50%; background-color:#0F0; display:none;">
		search box
	</div>
	</body>
</html>
<?php
	$_SESSION['lastPage'] = $_SERVER['REQUEST_URI'];
?>