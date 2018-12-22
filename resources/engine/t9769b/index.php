<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>T9769B general notes</h1>

<p><img src="t9769b.jpg" alt="T9769B IC photo" title="The T9769B as found in the Sanyo Wavy 70FD" class="floatright" />The T9769B chip is the MSX-Engine in several MSX 2+ computers. It is a relative of the T9769C chip used in the MSX turboR. Amongst others the Sanyo Wavy 70FD and 70FD2 have it inside. There is also a strong suspicion that the T9769B chip is used in the Panasonic FS-A1FX/WX/WSX computers, but confirmation is needed.</p>

<p>The chip has 144 pins and is a QFP chip. It contains the Z80 CPU, PPI, RTC, PSG and joystick ports controller.</p>



<?php addFooter(); ?>
</body>
</html>