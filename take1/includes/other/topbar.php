<style type="text/css">
#subsopportplans {
	height:40px;
}
</style>
<?php 
	$url = $_SERVER['REQUEST_URI'];
			//echo $url;
			$url = trim($url, "/");
			//echo $url;
			$url = str_replace("_", " ", $url);
			//echo $url;
			$tempArray = explode("/", $url);
			$url = $tempArray[0];
			$url = ucwords($url);
			//echo $url;
			//echo count($pages[$url]);

if (count($pages[$url]) > 0) {
  echo '<div id="subsopportplans">';
  echo '<ul id="subsupportplans">';
  foreach($pages[$url] as $key => $sub_page) {
	  echo '<li><a href="/' . str_replace(" ", "_", strtolower($url)) . '/' . str_replace(" ", "_", strtolower($key)) . '.php">' . $key . "</a></li>";
  }
  echo '</ul>';
  echo '</div>';
} else {
	echo "<div>eoeo<?php include('./includes/topbar.php'); ?>eoeo</div><a href='#'>nada</a>";
}
?>