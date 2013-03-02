<?php
	require_once("php scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$resolvedTickets = $sqlTool->getResolvedTickets();
	//echo print_r($resolvedTickets);
	foreach($resolvedTickets as $key => $ticket) {
		echo '<p>' . $ticket[0] . ' ' . $ticket[1] . ' ' . $ticket[14] . '</p>';
	}
?>