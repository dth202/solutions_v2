<div style="border-bottom:1px white solid; text-align:center; font-size:120%; font-weight:bold; padding-bottom:10px;">
	<a style="color:black;" href="javascript: void(showAll())">All</a> |
    <a style="color:black;" href="javascript: void(showOpen())">Open</a> |
    <a style="color:black;" href="javascript: void(showClosed())">Closed</a>
</div>
<table>
  <tr>
  	<!--<td><a class="column_title" href="tickets.php?sort=case">Case</a></td>
    <td><a class="column_title" href="#">No.</a></td>-->
    <td><a class="column_title" href="tickets.php?sort=ticket_name">Ticket</a></td>
    <td><a class="column_title" href="tickets.php?sort=date">Date</a></td>
    <td><a class="column_title" href="tickets.php?sort=company">Company</a></td>    
    <td><a class="column_title" href="tickets.php?sort=status">Status</a></td>
    <td><a class="column_title" href="tickets.php?sort=tech">Technician</a></td>
  </tr>
  <?php 
  require_once("php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
		
	$urlVariables = explode("&", substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1));
	$urlVariablestemp = explode("=", $urlVariables[0]);
	$urlVariablestemp2 = explode("=", $urlVariables[1]);
	$urlVariables = array();
	$urlVariables[$urlVariablestemp[0]] = $urlVariablestemp[1];
	$urlVariables[$urlVariablestemp2[0]] = $urlVariablestemp2[1];
	
	//echo print_r($urlVariables);
  $countTickets = $sqlTool->getTicketCount($urlVariables['status']);
  
  $ticketsPerPage = 50;
  $dividedPages = $countTickets / $ticketsPerPage;
  
  $totalPages = (int)$dividedPages + 1;
  echo 'Page ';    
  /*
  echo '<table>';
  foreach($_SERVER  as $key => $ticket) {
    echo '<tr>';
    echo  '<td>'.$key.'</td><td>'.$ticket.'</td>';
    echo '</tr>';
    }
  echo '</table>';
  */
  if($urlVariables['status'] || $urlVariables['sort'])
    $urlText = '&';
  else
    $urlText = '?';
  
  if( $urlVariables['page'] && $urlVariables['status'])
    $print = $_SERVER['SCRIPT_URL'].'?status='.$urlVariables['status'];
  else if ($urlVariables['page'] && $urlVariables['sort'])
    $print = $_SERVER['SCRIPT_URL'].'?sort='.$urlVariables['sort'];
  else if ($urlVariables['page'])
    $print = $_SERVER['SCRIPT_URL'];
  else
    $print = $_SERVER['REQUEST_URI'];
   
  for($i=1; $i <= $totalPages; $i++)
  { 
    if ($i == $urlVariables['page'])
    $style = 'font-weight:bold; font-size: large;';
    else
    $style = 'font-weight:normal; ';
    
    echo '<a style="'.$style.'" href="'.$print.$urlText.'page='.$i.'">'.$i.'</a> &nbsp;&nbsp;';
    }
    
  if($urlVariables['page'])
  {
    $pages = $urlVariables['page'] * $ticketsPerPage - $ticketsPerPage;
    $pageView = $pages.', '.$ticketsPerPage ;
    }
  else
  $pageView = '0, '.$ticketsPerPage;
  //echo $pageView;
  
    
  
	$tickets = $sqlTool->getTickets($urlVariables['sort'], $urlVariables['status'], $pageView);
	if ($urlVariables['company']) {
		$tickets = $sqlTool->getCompanyTickets(urldecode($urlVariables['company']));
	} elseif ($urlVariables['case']) {
		$tickets = $sqlTool->getCaseTickets(urldecode($urlVariables['case']));
	}
	//echo print_r($tickets);
  
  include("i/display_tickets.php"); 
  
  
  
  ?>

</table>
<script type="text/javascript">
var url = '' + document.location;

if (url.indexOf('?') == -1) {
	url = url + '?';
}

function showOpen() {
	if (url.indexOf('status=') > 0) {
		url = url.replace('closed', 'open');
	} else {
		url = url + 'status=open';
	}
	
	document.location = url;
}

function showClosed() {
	if (url.indexOf('status=') > 0) {
		url = url.replace('open', 'closed');
	} else {
		url = url + 'status=closed';
	}
	
	document.location = url;
}


function showAll() {
	if (url.indexOf('status=') > 0) {
		url = url.replace('status=closed', '');
		url = url.replace('status=open', '');
		url = url.replace('&', '');
	}
	
	document.location = url;
}
</script>