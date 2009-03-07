<?php
//
// Write to log file
//
function doLog() {
	// Do not log any traffic from the following list of IP's:
	$ignoreip = array('213.84.188.197');
	$logfile = $_SERVER['DOCUMENT_ROOT'].'/logs/log.txt';
	
	if (in_array($_SERVER['REMOTE_ADDR'],$ignoreip)) return;
	
	$entry[0] = time();
	$entry[1] = $_SERVER['REMOTE_ADDR'];
	$entry[2] = @$_SERVER['REMOTE_HOST'];
	$entry[3] = @$_SERVER['HTTP_USER_AGENT'];
	$entry[4] = $_SERVER['PHP_SELF'];
	$entry[5] = @$_SERVER['HTTP_REFERER'];
	
	$string = implode("\t",$entry)."\n";
	
	$fh = fopen($logfile, 'a');
	flock($fh, LOCK_EX);	// Lock file, other instances of script will wait
	fputs($fh, $string);
	flock($fh, LOCK_UN);	// Release lock
	fclose($fh);
}


function doUADetect($string) {
		// User Agent detection strings...
		$uads = array(
		'http://'=>'Bot','bot'=>'Bot','crawl'=>'Bot','spider'=>'Bot',
		'search'=>'Bot','jeeves'=>'Bot',	// catch bots
		'Safari'	=> 'Safari',		// before Gecko and KHTML
		'KHTML'		=> 'Konqueror',		// before Gecko
		'Opera'		=> 'Opera',			// before MSIE
		'Gecko'		=> 'Mozilla',
		'MSIE 7'	=> 'Internet Explorer 7',
		'MSIE 6'	=> 'Internet Explorer 6',
		'MSIE'		=> 'Internet Explorer');
		
		foreach ($uads as $key => $value)
			if (stristr($string,$key)) return $value;
		return 'Other';
}




?>