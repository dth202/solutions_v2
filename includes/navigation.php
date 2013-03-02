<?php
$int = 0;
echo '<ul id="nav">';
foreach($pages as $page => $sub_pages) {
  $page_position = 'navleft"';
  if ($int > 0 and $int !== count($pages) - 1) {
	  $page_position = 'navmiddle" id="' . str_replace(" ", "_", strtolower($page)) . '"';
  } elseif ($int == count($pages) - 1) {
	 $page_position = 'navright"';
  }
  echo '<li class="' . $page_position .'"><a class="shadow" href="/' . str_replace(" ", "_", strtolower($page)) . '/">' . $page . '</a>';
  if ($sub_pages !== '') {
	echo '<ul id="' . strtolower($page) . '">';
	foreach($sub_pages as $key => $sub_page) {
		echo '<li><a href="/' . str_replace(" ", "_", strtolower($page)) . '/' . str_replace(" ", "_", strtolower($key)) . '.php">' . $key . '</a></li>';
	}
	echo '</ul>';
  }
  echo '</li>';
  $int = $int + 1;
}
echo '</ul>';
  ?>