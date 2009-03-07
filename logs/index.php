<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>MSX Assembly Page</title>
	<?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>


<h1>Statistics page</h1>

<p>You can find the following statistics here (since 2005-03-18):</p>

<ul>
<li><a href="useragent.php">User Agent statistics</a></li>
<li><a href="referrer.php">Referrer statistics</a></li>
<li><a href="visitor.php">Visitor statistics</a></li>
<li><a href="page.php">Page statistics</a></li>
</ul>

<p>More stats can be found at <a href="http://t.extreme-dm.com/?login=msxasm">eXTReMe Tracking</a>.</p>

<p>Btw: this log counts hits, not sessions. Also, on the UA stats page, bots are not counted.</p>


<?php addFooter(); ?>
</body>
</html>