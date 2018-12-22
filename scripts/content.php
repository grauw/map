<?php

function addHTTPHeader() {
	global $xhtml;
	if ($xhtml) {
	  header('Content-type: application/xhtml+xml; charset=UTF-8');
	} else {
	  header('Content-type: text/html; charset=UTF-8');
	}
	header('Content-Style-Type: text/css');

	// XML header...
	if ($xhtml) {
	  echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
	  addStylesXHTML();
	}
}

function addStyles() {
	global $xhtml, $style;
	if (!$xhtml) {
?><link rel="stylesheet" href="/css/map.css" type="text/css" />
<?php
	}
}
function addStylesXHTML() {
	global $xhtml, $style;
	if ($xhtml) {
		echo '<?xml-stylesheet href="/css/map.css" type="text/css"?>'."\n";
	}
}

function addHeader() {
	addMenu();
?>
<div id="content">
<?php
}

function addMenu() {
?>
<h1 id="head">MSX Assembly Page</h1>

<div id="menu">
<ul>
<li><a href="/">Main</a></li>
<li><a href="/articles/">Articles</a></li>
<li><a href="/resources/">Resources</a></li>
<li><a href="/sources/">Sources</a></li>
<li><a href="/links/">Links</a></li>
<li><a href="/contributing/">Contributing</a></li>
</ul>
</div>
<?php
}

function addFooter() {
?>
</div>

<div id="foot">© <?php echo date("Y"); ?> MSX Assembly Page</div>
<?php
}

?>