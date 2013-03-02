<?php
	session_start();
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['ip_date'] = date("m-d-y");
	//echo print_r($_POST);
	//exit;
  
$success_sent_msg='<script type="text/javascript">window.location = "/contact_us/success_send_form.php";</script>';
$mobNumber = '8018548910@vtext.com';

$email = "jsavage@intuitiveits.com";
$client = "Client";
$phone = "801-969-3319";
$company = "Company";
$city = "City";
$state = "State";
$problem = "Problem";
$messageContent = "Message Content";

$mobSubject = "ITS-R";




$mobMessage =   '<br><br>'.$client.'
                <br>'.$phone.'<br>
	              '.$company.'<br>
                '.$city.', '.$state.'<br>
                Subject: '.$problem.'<br>
                '.$messageContent;
 /* */
mail($mobNumber,
     $mobSubject,
     $mobMessage, 
     "From: $email\nReply-To: $email\nContent-type: text/html; charset=iso-8859-1\n",
     "-f $email");
     
echo $success_sent_msg;

?>