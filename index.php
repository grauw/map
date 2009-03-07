<?php
	if (isset($_REQUEST['p'])) {
		if (preg_match('/(.*)\.html/', $_REQUEST['p'], $matches)) {
			header("Location: $matches[1].php");
		} elseif (preg_match('/(.*)\.[tT][xX][tT]/', $_REQUEST['p'], $matches)) {
			header('Location: viewer.php?f='.$_REQUEST['p']);
		} else {
			header('Location: .');
		}
	} else {
		include $_SERVER['DOCUMENT_ROOT'].'/main/index.php';
	}
?>