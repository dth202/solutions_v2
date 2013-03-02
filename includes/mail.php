<?php
$to = "";
$subject = "Test mail";
$message = print_r($_POST);
$from = "no-reply@awdoffice.com";
$headers = "From: $from";
if (mail($to,$subject,$message,$headers)) {
	echo ("<p>Message successfully sent!</p>");
} else {
	echo("<p>Message delivery failed...</p>");
}
?>