<?php
	session_start();
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['ip_date'] = date("m-d-y");
	//echo print_r($_POST);
	//exit;
?>

<?php
// --------------------------------------------------------------
  require_once("../solutions/php_scripts/sql_tool.php");
	$sqlTool = new SqlTool();
  
$replyemail="Support@IntuitiveITS.com";
//$replyemail="JSavage@IntuitiveITS.com";
//$replyemail="jaredpsavage@gmail.com";

$bccAdd="JSavage@IntuitiveITS.com, DFell@IntuitiveITS.com";
//$bccAdd="Test@IntuitiveITS.com";

$mobNumber = '8018548910@vtext.com';

//$replyemail="kodyman17@me.com";

//$privatekey = "6LfCVLsSAAAAAHXhn5_maEQv9--6eAqMB_gHKcGy"; //jared.site90
$privatekey = "6LdYT7sSAAAAAFQ1a6pd08BcXlh4pfid5mIFU-ws"; //IntuitiveITS
//$privatekey = "6LcBfrwSAAAAAOWl19VJ0sLIvVM0L_KOnmjkEuKF"; //IntuitiveTest

// --------------------------------------------------------------

// check invisible text field for emptyness
if ($_POST['sbblock'] != "") {
	echo '<script type="text/javascript">window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	exit;
}

// validate captcha

if ($_SESSION['use_captcha'] == 1) {
  require_once('recaptchalib.php');
  $resp = recaptcha_check_answer($privatekey,
	  $_SERVER["REMOTE_ADDR"],
	  $_POST["recaptcha_challenge_field"],
	  $_POST["recaptcha_response_field"]);
  
  if (!$resp->is_valid) {
	  $captcha_valid=false;
	  //echo print_r($captcha_valid);
	  $_SESSION['valid_captcha'] = false;
	  echo '<script type="text/javascript">window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	  exit;
  } else {
	  $captcha_valid=true;
	  //echo print_r($captcha_valid);
	  echo "valid";
	  $_SESSION['valid_captcha'] = true;
	  //exit;
  }
}

//check user input for possible header injection attempts!
function is_forbidden($str,$check_all_patterns = true)
{
/*
   $patterns[0] = '/content-type:/';
   $patterns[1] = '/mime-version/';   
   $patterns[2] = '/Content-Transfer-Encoding/';
   $patterns[3] = '/to:/';
   $patterns[4] = '/cc:/';
   $patterns[5] = '/bcc:/';
   $patterns[6] = '/multipart/';
   $forbidden = 0;
   for ($i=0; $i<count($patterns); $i++) {
	 	$forbidden = preg_match($patterns[$i], strtolower($str));
	 	if ($forbidden) break;
	}
   //check for line breaks if checking all patterns
   if ($check_all_patterns AND !$forbidden) $forbidden = preg_match("/(%0a|%0d|\\n+|\\r+)/i", $str);
   if ($forbidden)
   {
	echo "<font color=red><center><h3>STOP! Message not sent.</font></h3><br><b>
		  The text you entered is forbidden, it includes one or more of the following:
		  <br><textarea rows=9 cols=25>";
	foreach ($patterns as $key => $value) echo trim($value,"/")."\n";
		echo "\\n\n\\r</textarea><br>Click back on your browser, remove the above characters and try again.
		  	</b><br><br><br><br>Thankfully protected by phpFormMailer freely available from:";
		exit();
   }
   */
}

foreach ($_REQUEST as $key => $value) //check all input
{
 if ($key == "themessage") is_forbidden($value, false); //check input except for line breaks
 else is_forbidden($value);//check all
}



//Update Database  
$hostname='mysql50-60.wc2.dfw1.stabletransit.com';
$username='513061_intuitiv3';
$password='9teen6T9';
$dbname = '513061_intuitive_test_db';
			
$con = mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
mysql_select_db($dbname, $con);
$problem =  $_POST[company].'\n'.
            $_POST[contact_name].'\n'.
            $_POST[city].', '.$_POST[state].'\n'.
            $_POST[phone].'\n'.
            $_POST[email].'\n\n'.
            $_POST[problem];
$date = date('Y-m-d H:i:s'); // get the current date and time

    $sql = "INSERT INTO tickets 
        (ticket_name, 
        status, 
        tech, 
        company_id, 
        company, 
        contactOption_id, 
        contactOption,         
        equipment_id,
        equipment,   
        date,    
        problem_description, 
        needs,
        online_request,
        OR_temp_company)
    VALUES 
        ('$_POST[affected]', 
        'Open', 
        'ITS-R', 
        83, 
        'ITS-R', 
        127, 
        'Update Ticket',
        120, 
        'ITS-R',
        '$date', 
        '$problem', 
        'Update Ticket Info',
        1,
        'ITS-R $_POST[company]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);

$newTicketId = $sqlTool->getNewTicketId();  

$client = $_POST['client'];
$company = $_POST['company'];
$city = $_POST['city'];
$state = $_POST['state'];
$phone = $_POST['phone'];
$affected = $_POST['affected'];
$problem = $_POST['problem'];

$name = $_POST["contact_name"];
$email = $_POST["email"];
$thesubject = $newTicketId[newTicket].' - '.$_POST[company].' - '.$affected;
$themessage = $_POST["themessage"];

$success_sent_msg='<script type="text/javascript">window.location = "/contact_us/success_send_form.php";</script>';



if ($_POST['formId'] == "request_support") {
	$replymessage = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Hi '.$name.',</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p>Thank you for your email. We will contact you as soon as possible.</p>
		<p>For immediate support call 801-224-1216.</p>
        <p>Below is a copy of the message you submitted:</p>
    </td>
  </tr>
  <tr>
    <td>
		<p>------------------------------------</p>
    	<p>'.$affected.'</p>
		<p>'.$problem.'</p>
		<p>'.$themessage.'</p>
		<p>------------------------------------</p>
    </td>
  </tr>
  <tr>
    <td>
    	<p>Thank You,</p>
    	<p>Intuitive IT Solutions Support<br />
      <a href="mailto:Support@IntuitiveITS.com">Support@IntuitiveITS.com</a><br />
    	   801-224-1216<br />
    	</p>
    </td>
  </tr>
</table>';
	$themessage = '<table width="40%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2"><h2>Form Submission From IntuitiveITS.com</h2></td>
  </tr>
  <tr>
    <td colspan="2"><a href="http://www.intuitiveits.com/solutions/ticket.php?ticket_id='.$newTicketId[newTicket].'">'.$newTicketId[newTicket].' - '.$_POST[company].' - '.$affected.'</a></td>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Name:</td>
    <td>'.$name.'</td>
  </tr>
  <tr>
    <td align="right">Company:</td>
    <td>'.$company.'</td>
  </tr>
  <tr>
    <td align="right">Client Status:</td>
    <td>'.$client.'</td>
  </tr>
  <tr>
    <td align="right">Location:</td>
    <td>'.$city.' ,'.$state.'</td>
  </tr>
  <tr>
    <td align="right">Phone:</td>
    <td>'.$phone.'</td>
  </tr>
  <tr>
    <td align="right">Email:</td>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <td colspan="2"> Message:<br />
    </td>
  </tr>
  <tr>
    <td colspan="2">'.$affected.'<br /><br />'.$problem.'</td>
  </tr>
</table>';

  
  $mobSubject = "ITS-R";
  
} else {
  $mobSubject = "ITS-C";
	$replymessage = '<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>Hi '.$name.',</td>
  </tr>
  <tr>
    <td>Thank you for your email. We will contact you as soon as we possible can.</td>
  </tr>
  <tr>
    <td>For immediate support call 801-224-1216.</td>
 </tr>
  <tr>
    <td>Below is a copy of the message you submitted:<br />
		- - - - - - - - - - - - -</td>
  </tr>
  <tr>
    <td>'.$problem.'</td>
  </tr>
  <tr>
    <td>- - - - - - - - - - - - -</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Thank You,</td>
  </tr>
  <tr>
    <td>Intuitive IT Solutions Support<br />
      <a href="mailto:Support@IntuitiveITS.com">Support@IntuitiveITS.com</a><br /><br />
      801-224-1216<br /></td>
  </tr>
  </table>';
	$themessage = '<table width="40%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2"><h2>Form Submission From IntuitiveITS.com</h2></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Name:</td>
    <td>'.$name.'</td>
  </tr>
  <tr>
    <td align="right">Phone:</td>
    <td>'.$phone.'</td>
  </tr>
  <tr>
    <td align="right">Email:</td>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <td colspan="2"> Message:<br />
    </td>
  </tr>
  <tr>
    <td colspan="2">'.$affected.'<br /><br />'.$problem.'</td>
  </tr>
</table>';
}

$mobMessage =   '<br><br>'.$name.'
                <br>'.$phone.'<br>
	              '.$company.'<br>
                '.$city.', '.$state.'<br>
                Sub: '.$affected.'<br>
                '.$problem;
       
$headers .= "Content-type: text/html; charset=iso-8859-1\n";


//Send message to Technicians to alert them of the request
mail("$replyemail",
     "ITSR $thesubject",
     "$themessage",
     "From: $email\nReply-To: $email\nContent-type: text/html; charset=iso-8859-1\nBcc: $bccAdd\n"); //Bcc: $bccAdd\n");

//Send Message to the Client needing a request to let them know we got the email
mail("$email",
     "ITSR $thesubject",
     "$replymessage",
     "From: $replyemail\nReply-To: $replyemail\nContent-type: text/html; charset=iso-8859-1\n");

//Text my Mobile phone to know to check my email

mail($mobNumber,
     $mobSubject,
     $mobMessage, 
     "From: $email\nReply-To: $email\nContent-type: text/html; charset=iso-8859-1\n",
     "-f $email");
  
echo $success_sent_msg;


?>