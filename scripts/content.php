<?php

//
// Add http header...
// If accepting XHTML, give nice header + xml tag, etc.
//
function addHTTPHeader() {
	global $xhtml;
	if ($xhtml) {
	  header('Content-type: application/xhtml+xml; charset=UTF-8');
	} else {
	  header('Content-type: text/html; charset=UTF-8');
	}
	header('Content-Style-Type: text/css');

	procStyleCookie();

	// XML header...
	if ($xhtml) {
	  echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
	  addStylesXHTML();
	}
}




//
// Process style cookie
//
function procStyleCookie() {
	global $style;
	$style='';
	if (isset($_COOKIE['mapstyle'])) $style = $_COOKIE['mapstyle'];
	if (isset($_GET['setstyle'])) $style = $_GET['setstyle'];

	switch ($style) {
	case 'none':			// allowed styles
	case 'classic':
	case 'modern':
	case 'experimental':
		setcookie('mapstyle', $style, time()+365*24*60*60, '/'); //1yr
		break;
	default:
		$style='classic';
	}
}
//
// Add style information
//
function addStyles() {
	global $xhtml, $style;
	if (!$xhtml) {
/*
  <!-- compliance patch for microsoft browsers -->
  <!--[if lt IE 7]>
  <link rel="stylesheet" href="/IE7/ie7-html.css" type="text/css" />
  <![endif]-->
*/
?><link rel="stylesheet" href="/css/map.css" type="text/css" />
  <link rel="stylesheet" href="/css/print.css" type="text/css" media="print" />
  <link rel="<?php echo ($style=='classic' ? '' : 'alternate ') ?>stylesheet" href="/css/classic.css" type="text/css" title="MAP Classic" />
  <link rel="<?php echo ($style=='modern' ? '' : 'alternate ') ?>stylesheet" href="/css/modern.css" type="text/css" title="MAP Modern" />
  <link rel="<?php echo ($style=='experimental' ? '' :'alternate ') ?>stylesheet" href="/css/experimental.css" type="text/css" title="MAP Experimental" />
<?php
	}
}
function addStylesXHTML() {
	global $xhtml, $style;
	if ($xhtml) {
		echo '<?xml-stylesheet href="/css/map.css" type="text/css"?>'."\n";
		echo '<?xml-stylesheet href="/css/print.css" type="text/css" media="print"?>'."\n";
		echo '<?xml-stylesheet href="/css/classic.css" ' . ($style=='classic' ? '' : 'alternate="yes" ') . 'type="text/css" title="MAP Classic"?>'."\n";
		echo '<?xml-stylesheet href="/css/modern.css" ' . ($style=='modern' ? '' : 'alternate="yes" ') . 'type="text/css" title="MAP Modern"?>'."\n";
		echo '<?xml-stylesheet href="/css/experimental.css" ' . ($style=='experimental' ? '' : 'alternate="yes" ') . 'type="text/css" title="Experimental"?>'."\n";
	}
}



//
// Add site header
//
function addHeader() {
	addMenu();
?>
<div id="content">
<?php
}




//
// Adds menu code
//
function addMenu() {
?>
<h1 id="head">MSX Assembly Page</h1>

<div id="menu">
<ul>
<li><a href="/">Main</a></li>
<li><a href="/articles/">Articles</a>
  <ul>
  <li><a href="/articles/#tutorials">Tutorials</a></li>
  <li><a href="/articles/#articles">Articles</a></li>
  <li><a href="/articles/#extarticles">External articles</a></li>
  </ul>
</li>
<li><a href="/resources/">Resources</a>
  <ul>
  <li><a href="/resources/#osdocs">OS documentation</a></li>
  <li><a href="/resources/#devicedocs">Device documentation</a></li>
  <li><a href="/resources/#swdocs">Software documentation</a></li>
  </ul>
</li>
<li><a href="/sources/">Sources</a>
  <ul>
  <li><a href="/sources/#code">Code examples</a></li>
  <li><a href="/sources/#source">Source code</a></li>
  <li><a href="/sources/#extsources">External sources</a></li>
  </ul>
</li>
<li><a href="/downloads/">Downloads</a>
  <ul>
  <li><a href="/downloads/#programming">Assemblers, compilers, etc.</a></li>
  <li><a href="/downloads/#tools">Tools</a></li>
  <li><a href="/downloads/#article">Article downloads</a></li>
  </ul>
</li>
<li><a href="/links/">Links</a>
  <ul>
  <li><a href="/links/#dev-comm">Development communities</a></li>
  <li><a href="/links/#software">Software</a></li>
  <li><a href="/links/#hardware">Hardware</a></li>
  <li><a href="/links/#special">Special mention</a></li>
  </ul>
</li>
<li><a href="/contributing/">Contributing</a></li>
</ul>
</div>
<?php
}




//
// Add site footer
//
function addFooter() {
?>
</div>

<!-- tracker script -->
<div id="tracker">
<script type="text/javascript" src="/tracker.js"></script>
</div>
<noscript>
<div><img src="http://t0.extreme-dm.com/c.g?tag=msxasm&amp;j=n" height="1" width="1" alt="" /></div>
</noscript>

<div id="foot">&copy; <?php echo date("Y"); ?> MSX Assembly Page / <a href="http://www.tni.nl/">The New Image</a></div>
<?php
}










?>