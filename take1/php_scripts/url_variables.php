<?php
  $urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
?>