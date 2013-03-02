<table>
  <tr>
  	<td><strong>Case</strong></td>
    <td><strong>Date</strong></td>
    <td><strong>Company</strong></td>
    <td><strong>Ticket Name</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Technician</strong></td>
  </tr>
<?php
	require_once("php scripts/sql_tool.php");
	$sqlTool = new SqlTool();
	$tickets = $sqlTool->getOpenTickets();
	//echo print_r($tickets);
	foreach($tickets as $key => $ticket) {
		echo '<tr>';
		echo '<td>' . $ticket['case'] . '</td>';
		echo '<td>' . $sqlTool->convertDate2String($ticket['date']) . '</td>';
		echo '<td>' . $ticket['company'] . '</td><td>' . $ticket['ticket_name'] . '</td>';
		echo '<td>' . $ticket['status'] . '</td><td>' . $ticket['tech'] . '</td>';
		echo '</tr>';
	}
?>
</table>