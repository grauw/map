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
<body>
<?php addHeader(); ?>



<?php

if (!function_exists("file_get_contents")) {
	function file_get_contents($filename, $use_include_path = 0) {
		$data = ""; // just to be safe. Dunno, if this is really needed
		$file = @fopen($filename, "rb", $use_include_path);
		if ($file) {
			while (!feof($file)) $data .= fread($file, 1024);
			fclose($file);
		}
		return $data;
	}
}


if ($_REQUEST["f"]) {
	$file = $_REQUEST["f"];

	// limit allowed paths to prevent hacking stuff...
	if (preg_match('/^[\w\-\/]*\.txt$/i', $file)) {
		
		// remove preceding slashes...
		while ($file{0} == '/') {
			$file = substr($file, 1);
		}
				
		if (file_exists($file)) {
			$filecont = file_get_contents($file);

			echo '<h1>' . basename($file) . "</h1>\n\n";
			echo '<pre style="white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: pre-wrap; word-wrap: break-word;">';
			echo htmlspecialchars($filecont, ENT_NOQUOTES);
			echo '</pre>';
		} else {
			echo '<p><b>Error:</b> File not found.</p>';
			echo "<p>($file)</p>";
		}
	} else {
		echo '<p><b>Error:</b> Path contains illegal characters.</p>';
		echo "<p>($file)</p>";
	}
} else {
	echo '<p><b>Error:</b> No filename specified.</p>';
}

?>




<?php addFooter(); ?>
</body>
</html>