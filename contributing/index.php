<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="description" content="The MSX Assembly Page is a central source for MSX programming information in various languages, though mainly assembly. It contains articles on several topics, programming resources, sources, software downloads and links to some other good MSX programming sites." />
  <meta name="keywords" content="MSX, Assembly, Basic, programming, byte, bit, word, ld, jp, fast loop, keyboard, samples, multiplication, division, RAM, ROM, BIOS, SUBROM, MSX-DOS, I/O, Port, Z80, R800, VDP, TMS9918, V9938, V9958, V9990, Graphics9000, Gfx9000, PSG, AY-3-8910, SCC, MSX-Music, FM-PAC, OPLL, YM2413, MSX-Audio, Music Module, OPL1, Y8950, Moonsound, OPL4, MSX Engine, S3527, S1985, S1990, Sunrise, IDE, Novaxis, SCSI, PPI, RTC, MemMan" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>Contributing to the MAP</h1>

<p>If you want to contribute more directly to the MAP like write articles about a certain subject, or digitize some documents, or making editorial changes yourself (which usually expedites the process of getting it online :)), we’d really appreciate it.</p>

<p>The <a href="https://bitbucket.org/grauw/map">MAP source code</a> is stored in a <a href="http://www.selenic.com/mercurial/">Mercurial</a> repository. There is <a href="/contributing/repository.php">a tutorial</a> explaining how to get the sources and start making changes.</p>

<p>Additionally, there is <a href="/contributing/documents.php">a tutorial</a> on the document format and conventions used on the MAP. Note that on most browsers, the pages are served as XML, so be sure to verify your changes pages in a browser that is not Internet Explorer.</p>

<h2>Tutorials</h2>

<ul>
	<li><a href="/contributing/repository.php">The MAP Mercurial repository</a></li>
	<li><a href="/contributing/documents.php">Document structure and syntax</a></li>
</ul>


<?php addFooter(); ?>
</body>
</html>
