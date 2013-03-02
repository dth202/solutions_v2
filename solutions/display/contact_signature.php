<?php
	// echo "<pre>";
		// print_r($contactSignature);
	// echo "</pre>";
	
	echo "<div class='sigPadContact signed'>
			  <div class='sigWrapper'>
				<!--<div class='typed'></div>-->
				<canvas class='pad' width='498' height='155'></canvas>
			  </div>
			  <p>$contactSignature[contact_name]<br>$contactSignature[created_date]</p>
			</div>

	<script>
		var sigContact =  $contactSignature[signature];
		
		$(document).ready(function () {
		  $('.sigPadContact').signaturePad({displayOnly:true}).regenerate(sigContact);
		});

	</script>";
	
	// //Display PNG ------------
	// $source = "../../solutions/php_scripts/sigtoimage/images/contact_$contactSignature[incident_id].png";
	// if(!file_exists($source))
	// {
		// require_once '../php_scripts/sigtoimage/signature-to-image.php';

		// $json = $contactSignature[signature];
		// $img = sigJsonToImage($json);
		// //echo $img;
		
		
		// //$source = "test";
		// imagepng($img, $source);
		// //imagepng($img, '../../solutions/php_scripts/sigtoimage/contact_signature.png');
		
		// header('Content-Type: image/png');
		// //echo "<img src='../../solutions/php_scripts/sigtoimage/contact_signature.png'>";
		// //imagepng($img);
		
		// imagedestroy($img);
	// }
	// echo "<img src='$source'>";
?>