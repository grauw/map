<?php

include $_SERVER['DOCUMENT_ROOT'].'/scripts/content.php';

// Tell PHP to use escaped ampersants if it happens to insert one.
ini_set('arg_separator.input','&amp;');
ini_set('arg_separator.output','&amp;');

// Set globals
$xhtml = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml');

// gzip pages...
ob_start("ob_gzhandler");

?>