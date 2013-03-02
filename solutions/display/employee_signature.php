<?php


	echo "<div class='sigPad$employeeDetails[id] signed'>
			  <div class='sigWrapper'>
				<!--<div class='typed'></div>-->
				<canvas class='pad' width='498' height='155'></canvas>
			  </div>
			  <p>$employeeDetails[fname] $employeeDetails[lname]</p>
			  <p>$employeeSignatureDetails[created_date]</p>
			</div>

		<script>
			var sig$employeeDetails[id] =  $employeeSignatureDetails[signature];
			
			$(document).ready(function () {
			  $('.sigPad$employeeDetails[id]').signaturePad({displayOnly:true}).regenerate($employeeSignatureDetails[signature]);
			});

		</script>";
?>