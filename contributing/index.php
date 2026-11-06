<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Contributing to the MAP - MSX Assembly Page</title>
  <?php addStyles(); ?>
  <script type="module" src="/js/email.js"></script>
</head>
<body>
<?php addHeader(); ?>

<h1>Contributing to the MAP</h1>

<p>If you would like to see something added to this site, or if you have any
comments about the content, feel free to email us about it! We can make
mistakes, and we don’t always know what’s best either, so any feedback is
appreciated. If you want to submit something for publication on this
site, you can email it to us as well. Our contact address is
<span class="email" data-domain="grauw.nl" data-local-part="map">(enable
JavaScript for email link)</span>.</p>

<p>If you want to contribute more directly to the MAP like write articles about
a certain subject, or digitize some documents, or making editorial changes
yourself, we’d really appreciate it. Submitting changes to the MAP’s source code
usually expedites the process of getting things online :).</p>

<p>The <a href="https://github.com/grauw/map">MAP source code</a> is stored
in a <a href="https://git-scm.com/">Git</a> repository. There
is <a href="/contributing/repository.php">a tutorial</a> explaining how to get
the sources and start making changes.</p>

<p>Additionally, there is <a href="/contributing/documents.php">a tutorial</a>
on the document format and conventions used on the MAP. Note that on most
browsers, the pages are served as XML, so be sure to verify your changes pages
in a browser that is not Internet Explorer.</p>

<h2>Tutorials</h2>

<ul>
	<li><a href="/contributing/repository.php">The MAP Git repository</a></li>
	<li><a href="/contributing/documents.php">Document structure and syntax</a></li>
</ul>


<?php addFooter(); ?>
</body>
</html>
