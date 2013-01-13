<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Z80/R800/Z180/Z380 MPU Comparison Chart</h1>

<table>
<tr>
<td></td>
<td>Z80</td>
<td>R800</td>
<td>Z180</td>
<td>Z380</td>
</tr>

<tr>
<td>External Data Bus Width</td>
<td>8-bit</td>
<td>8-bit</td>
<td>8-bit</td>
<td>16/32-bit</td>
</tr>

<tr>
<td>Address Space</td>
<td>64k</td>
<td>64k</td>
<td>1Mb</td>
<td>16Mb Linear</td>
</tr>

<tr>
<td>Number of register sets</td>
<td>2</td>
<td>2</td>
<td>2</td>
<td>8 16-bit</td>
</tr>

<tr>
<td>Number of register planes</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>4</td>
</tr>

<tr>
<td>Static core</td>
<td>no</td>
<td>no</td>
<td>yes</td>
<td>yes</td>
</tr>

<tr>
<td>CPU Speed</td>
<td>3.57</td>
<td>7.14</td>
<td>33</td>
<td>18</td>
</tr>

<tr>
<td>Clocks/Inst. Min</td>
<td>4</td>
<td>1</td>
<td>3</td>
<td>2</td>
</tr>

<tr>
<td>Relative Performance</td>
<td>1</td>
<td>7</td>
<td>11</td>
<td>9 <i>(33)</i></td>
</tr>
</table>

<p>Note: ZiLOG themselves rate the Z380 with a relative performance of 33 because of the 32-bits extended instruction set and all the other added features. However, although it does deserve a slightly higher rating because of that, in practice this 33 is pretty over the top. I’ll just stick with the CPU speed / min. clockticks indication :).</p>




<?php addFooter(); ?>
</body>
</html>