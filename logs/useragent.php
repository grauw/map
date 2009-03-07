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
	while (!feof($fh)) {
		if (($buffer = fgets($fh)) != '') {
			$entry = explode("\t",str_replace("\n",'',$buffer));
			
			@$ualist[$entry[3]]++;
		}
	}
	flock($fh, LOCK_UN);	// Release lock
	fclose($fh);

?>


<?php
	//
	// There are two cases:
	// 1. Normal top UA's display
	// 2. Specific UA display
	//
	if (isset($_GET['uastats'])) {
?>
<h2>Top '<?php echo $_GET['uastats']; ?>' user agent strings:</h2>

<table>
<tr>
	<th>User agent strings</th>
<?php } else { ?>
<h2>Top user agents:</h2>

<table>
<tr>
	<th>User agent</th>
<?php } ?>
	<th>Hits</th>
	<th>Percentage</th>
</tr>

<?php
	// Display top UA's
	if (!isset($_GET['uastats'])) {
		$logcount = 0;
		foreach ($ualist as $key => $value) {
			$blu = doUADetect($key);
			if ($blu == 'Bot') $value = 0;
			@$ua[$blu] += $value;
			$logcount += $value;
		}
		
		arsort($ua, SORT_NUMERIC);
		foreach ($ua as $key => $value) {
			echo '<tr>';
			echo '<td><a href="?uastats='.rawurlencode($key).'">'.$key.'</a></td>';
			echo '<td>'.$value.'</td>';
			echo '<td>'.sprintf('%.2f',($value / $logcount)*100).'%</td>';
			echo '</tr>';
		}
	} else {
		// Display specific UA strings
		$logcount = 0;
		foreach ($ualist as $key => $value) {
			$blu = doUADetect($key);
			if ($blu == 'Bot' && $_GET['uastats'] != 'Bot') $value = 0;
			if ($blu == $_GET['uastats'])
				@$ua[$key] += $value;
			$logcount += $value;
		}
		
		arsort($ua, SORT_NUMERIC);
		foreach ($ua as $key => $value) {
			echo '<tr>';
			echo '<td>'.htmlspecialchars($key, ENT_NOQUOTES, 'UTF-8').'</td>';
			echo '<td>'.$value.'</td>';
			echo '<td>'.sprintf('%.2f',($value / $logcount)*100).'%</td>';
			echo '</tr>';
		}
	}

?>
</table>

<?php if (@$_GET['uastats'] != 'Bot') echo "<p>Note: bots aren't counted.</p>\n"; ?>

<?php } ?>


<?php addFooter(); ?>
</body>
</html>