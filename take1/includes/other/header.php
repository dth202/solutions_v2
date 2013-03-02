<?php
$pages = array(
		'Home'  => '',
		'Request Support' => '',
		'Support Plans'   => array(
			'Compare Plans'		     => '',
			'Fully Managed'			 => '',
			'Partially Managed'	     => '',
			'Hourly Support' 		 => '',
			'On-Call Support'	  	 => ''),
		'Services'  	  => array(
			'Email and Web Hosting'	 => '',
			'Desktop and Laptop'		 => '',
			'Server'			 	 => '',
			'Network'				 => '',
			'Smartphone'		     => '',
			'Routine Maintenance'    => '',
			'On-Call Technician'=> ''),
		'Contact Us' 	  => '',
	);
?>

<?php
	$agent = '';
	// old php user agent can be found here
	if (!empty($HTTP_USER_AGENT)) {
		$agent = $HTTP_USER_AGENT;
	}
	// newer versions of php do have useragent here.
	if (empty($agent) && !empty($_SERVER["HTTP_USER_AGENT"])) {
		$agent = $_SERVER["HTTP_USER_AGENT"];
	}
	if (!empty($agent) && preg_match("/firefox/si", $agent)) {
		$fireFox = true;
		$webkit = false;
	} elseif (!empty($agent) && preg_match("/webkit/si", $agent)) {
		$fireFox = false;
		$webkit = true;
	}
?>

<div id="masthead">
  <div id="banner">
      <a href="/"><img src="../images/logo.gif" alt="Intuitive IT Solutions" width="500" /></a> 
  </div>
  <div id="contact"> 
  		  <div align="right" id="editLinks" style="padding-bottom:2px; <?php if (!isset($_SESSION['logged_in']) and !$_SESSION['logged_in']) {echo 'display:none;';} ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/edit/" class="small">Start Editing</a> | <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/solutions/" class="small">Solutions</a> | <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/sign_out.php" class="small">Log Out</a></div>
          <h3 style="font-family:Bradley Hand ITC, Lucida Handwriting, Kristen ITC, Papyrus, Verdana;" id="contactnumber">Call Today<br /><span>(801) 224-1216</span></h3>
  </div>
</div>