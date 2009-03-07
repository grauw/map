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

<p>Sorry, statistics are disabled.</p>
<?php if (false) { ?>

<?php
	$logfile = $_SERVER['DOCUMENT_ROOT'].'/logs/log.txt';

	$fh = fopen($logfile, 'r');
	flock($fh, LOCK_SH);	// Lock file
	$logcount = 0;
	while (!feof($fh)) {
		if (($buffer = fgets($fh)) != '') {
			$entry = explode("\t",str_replace("\n",'',$buffer));
			
			@$pglist[$entry[4]]++;
			$logcount++;
		}
	}
	flock($fh, LOCK_UN);	// Release lock
	fclose($fh);
?>


<h2>Top pages viewed:</h2>

<?php
if (isset($pglist)) {
?>
<table>
<tr>
	<th>Page</th>
	<th>Hits</th>
	<th>Percentage</th>
</tr>
<?php
	arsort($pglist, SORT_NUMERIC);
	foreach ($pglist as $key => $value) {
		echo '<tr>';
		echo '<td>'.htmlspecialchars($key, ENT_NOQUOTES, 'UTF-8').'</td>';
		echo '<td>'.$value.'</td>';
		echo '<td>'.sprintf('%.2f',($value / $logcount)*100).'%</td>';
		echo '</tr>';
	}
?>
</table>
<?php
} else {
	echo '<p>None</p>';
}
?>

<?php } ?>


<?php addFooter(); ?>
</body>
</html>