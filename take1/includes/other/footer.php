<div id="content-footer" <?php if ($fireFox) { echo 'style="margin-right:0px;"'; } ?>> 
    <div id="footer-left"></div> 
    <div id="footer-right"></div>
</div> 
<div id="footer">&copy; 2011 Intuitive IT Solutions</div>
<div align="center">
	<!--<a href="/login" class="small">Login</a> | -->
    <a href="/sitemap.php" class="small">Sitemap</a>
	<?php if(isset($_SESSION['css_version'])) { 
			if ($_SESSION['css_version'] == 0) { 
			  //echo ' | <a href="/includes/toggleCSS.php">New</a>';
			} else { 
			  //echo ' | <a href="/includes/toggleCSS.php">Old</a>';
			}
		  } ?>
</div>