<?php
	echo "	<form method='post' action='/solutions/edit/complete_incident.php' class='sigPad sigPadContactForm'>
			<input type='hidden' id='contact_id' name='contact_id' value='$incidentDetails[contact_id]'>
			<input type='hidden' id='incident_id' name='incident_id' value='$incidentDetails[incident_id]'>
			<label for='name'>Print your name</label>
			<input type='text' name='contact_name' id='contact_name' class='name'>
			<!--<p class='typeItDesc'>Review your signature</p>-->
			<p class='drawItDesc'>Draw your signature</p>
			<ul class='sigNav'>
				<!--<li class='typeIt'><a href='#type-it' class='current'>Type It</a></li>-->
				<li class='drawIt'><a href='#draw-it' >Draw It</a></li>
				<li class='clearButton'><a href='#clear'>Clear</a></li>
			</ul>
			<div class='sig sigWrapper'>
				<div class='typed'></div>
				<canvas class='pad' width='498' height='155'></canvas>
				<input type='hidden' name='output' class='output'>
			</div>
			<button type='submit'>I accept the terms of this agreement.</button>
		</form>


		  <script>
			var ContactOptions = {
				defaultAction : 'drawIt'
				, drawOnly : true
			};
			
			$(document).ready(function() {
			  $('.sigPadContactForm').signaturePad(ContactOptions);
			});
		  </script>";
?>