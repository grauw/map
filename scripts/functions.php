<?php

include $_SERVER['DOCUMENT_ROOT'].'/scripts/content.php';
//include $_SERVER['DOCUMENT_ROOT'].'/scripts/logger.php';

// Tell PHP to use escaped ampersants if it happens to insert one.
ini_set('arg_separator.input','&amp;');
ini_set('arg_separator.output','&amp;');

// Set globals
$xhtml = strpos($_SERVER['HTTP_ACCEPT'],'application/xhtml+xml') ? true : false;

// gzip pages...
ob_start("ob_gzhandler");







?>