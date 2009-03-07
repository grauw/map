<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>MSX Assembly Page styles</h1>

<p>As the MSX Assembly Page has its content entirely separated from its layout code, it is easy to create different style sheets. Here you can find a list of the currently available <abbr title="Cascading Style Sheets">CSS</abbr> styles, and you may select a different default. For this, you need to have cookies enabled.</p>

<dl>
<dt><a href="?setstyle=classic">MAP Classic</a></dt>
<dd>This is the original and default style of the <acronym title="MSX Assembly Page">MAP</acronym>. It is nice and plain, and will work in every browser.</dd>
<dt><a href="?setstyle=modern">MAP Modern</a></dt>
<dd>Originally created as a quick 'n nasty alternative stylesheet, this style is kind of er... Well. In the future it will probably change to something making a little more sense :).</dd>
<dt><a href="?setstyle=experimental">Experimental</a></dt>
<dd>This style is a testbed for new styles. Currently it is like classic, but with a few enhancements such as highlighting table rows in supporting browsers, and aligning the footer to the bottom. It might not work in all browsers.</dd>
<dt><a href="?setstyle=none">No style</a></dt>
<dd>This disables the stylesheet.</dd>
</dl>



<?php addFooter(); ?>
</body>
</html>