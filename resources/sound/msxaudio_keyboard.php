<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX-AUDIO music keyboard</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>MSX-AUDIO music keyboard</h1>

<p>The MSX-AUDIO Y8950 sound chip has a function for an external keyboard. All
three MSX-AUDIO modules, the Philips NMS-1205 Music Module, the Toshiba HX-MU900
MSX Music System and the Panasonic FS-CA1 MSX-Audio have a connector for these.
The Toshiba and Panasonic’s connectors are compatible; the Philips connector
differs from the others.</p>

<p>The keyboards available for the Toshiba and Panasonic modules are the 49-key
Toshiba HX-MU901, the Yamaha YK-10, YK-20 and the YK-01 (44 keys). For their
Music Module Philips offered a 61-key music keyboard, the NMS-1160. As said,
this one is not compatible with the other modules, even though the connector
fits the pins are connected differently. Modified Commodore keyboards are also
often used.</p>


<h2 id="reading">Reading the keyboard</h2>

<p>The keys can be read in a matrix structure of 8x8 bits, which is accessed
through the MSX-AUDIO registers at I/O ports 0C0H (address) and 0C1H (data).
The address port is write-only, the data port can be read or written to
depending on the selected register. A 12 cycle wait (at 3.58 Mhz) is required
after all address and data writes.</p>

<p>Note that the Panasonic module has a switch which lets it listen at 0C2H and
0C3H, allowing two modules to be connected at the same time; the Philips and
Toshiba modules can also be modified to provide such a switch. You may want to
support this, but for this article we will assume the standard ports.</p>

<table>
<thead>
<tr>
	<th>Register</th>
	<th>I/O</th>
	<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
	<td>05H</td>
	<td>Read</td>
	<td>Row bits, 0 = pressed.<br/>
	    See below for the bit/key mapping.</td>
</tr>
<tr>
	<td>06H</td>
	<td>Write</td>
	<td>Row selection, 1 = selected.<br/>
	    Set bit 0 to select row 0, bit 1 to select row 1, etc.</td>
</tr>
</tbody>
</table>

<p>Refer to the <a href="/resources/sound/yamaha_y8950.pdf">MSX-AUDIO
application manual</a> for more details on writing / reading register data.</p>

<p>The key matrix is as follows:</p>

<table>
<caption>Toshiba HX-MU901 and Yamaha YK-01/10/20 matrix</caption>
<thead>
	<tr><th>Bit</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th><th>0</th></tr>
</thead>
<tbody>
	<tr><th>Row 0</th><td>C 2</td><td>F#2</td><td>F 2</td><td>E 2</td><td>---</td><td>D#2</td><td>D 2</td><td>C#2</td></tr>
	<tr><th>Row 1</th><td>---</td><td>C 3</td><td>B 3</td><td>A#3</td><td>---</td><td>A 3</td><td>G#2</td><td>G 2</td></tr>
	<tr><th>Row 2</th><td>---</td><td>F#3</td><td>F 3</td><td>E 3</td><td>---</td><td>D#3</td><td>D 3</td><td>C#3</td></tr>
	<tr><th>Row 3</th><td>---</td><td>C 4</td><td>B 4</td><td>A#4</td><td>---</td><td>A 4</td><td>G#3</td><td>G 3</td></tr>
	<tr><th>Row 4</th><td>---</td><td>F#4</td><td>F 4</td><td>E 4</td><td>---</td><td>D#4</td><td>D 4</td><td>C#4</td></tr>
	<tr><th>Row 5</th><td>---</td><td>C 5</td><td>B 5</td><td>A#5</td><td>---</td><td>A 5</td><td>G#4</td><td>G 4</td></tr>
	<tr><th>Row 6</th><td>---</td><td>F#5</td><td>F 5</td><td>E 5</td><td>---</td><td>D#5</td><td>D 5</td><td>C#5</td></tr>
	<tr><th>Row 7</th><td>---</td><td>C 6</td><td>B 6</td><td>A#6</td><td>---</td><td>A 6</td><td>G#5</td><td>G 5</td></tr>
</tbody>
</table>

<table>
<caption>Philips NMS-1160 matrix</caption>
<thead>
	<tr><th>Bit</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th><th>0</th></tr>
</thead>
<tbody>
	<tr><th>Row 0</th><td>G 2</td><td>F#2</td><td>F 2</td><td>E 2</td><td>D#2</td><td>D 2</td><td>C#2</td><td>C 2</td></tr>
	<tr><th>Row 1</th><td>D#3</td><td>D 3</td><td>C#3</td><td>C 3</td><td>B 3</td><td>A#3</td><td>A 3</td><td>G#2</td></tr>
	<tr><th>Row 2</th><td>B 4</td><td>A#4</td><td>A 4</td><td>G#3</td><td>G 3</td><td>F#3</td><td>F 3</td><td>E 3</td></tr>
	<tr><th>Row 3</th><td>G 4</td><td>F#4</td><td>F 4</td><td>E 4</td><td>D#4</td><td>D 4</td><td>C#4</td><td>C 4</td></tr>
	<tr><th>Row 4</th><td>D#5</td><td>D 5</td><td>C#5</td><td>C 5</td><td>B 5</td><td>A#5</td><td>A 5</td><td>G#4</td></tr>
	<tr><th>Row 5</th><td>B 6</td><td>A#6</td><td>A 6</td><td>G#5</td><td>G 5</td><td>F#5</td><td>F 5</td><td>E 5</td></tr>
	<tr><th>Row 6</th><td>G 6</td><td>F#6</td><td>F 6</td><td>E 6</td><td>D#6</td><td>D 6</td><td>C#6</td><td>C 6</td></tr>
	<tr><th>Row 7</th><td>---</td><td>---</td><td>---</td><td>C 7</td><td>B 7</td><td>A#7</td><td>A 7</td><td>G#6</td></tr>
</tbody>
</table>

<p>As you can see, unfortunately not only the connectors are different but so
are the keyboard matrices. This means that in order to support both, you have to
provide a means of selecting which keyboard to use. This can be done in a menu,
but can also be done by asking Toshiba and Yamaha keyboard users to press the
highest note on their keyboard (C6). This bit is not available on the Philips,
so if it gets flagged the software can recognise it is a Toshiba and switch
automatically.</p>

<p>Who did it right? According to MSX-Datapack volume 2 section 4.1.4
(page 281), the Toshiba matrix is the official one. The MSX-AUDIO documentation
describes yet another layout, but this is likely an editorial error.</p>

<p>As an aside, because the row selection is not exclusive, if multiple rows are
selected the pressed notes will overlap each other. This can be used to do a
quick check if any notes are pressed at all, and if not, skip the remaining
processing.</p>

<h2 id="multisensor">The Toshiba HX-MU901’s Multi Sensor</h2>

<p>Above the keybed, Toshiba also has a “Multi Sensor” with a capacitive ribbon
control and two capacitive ENTER and STOP buttons. You might have pressed these
and noticed that 8 keys will be flagged at a time. This is because these
controls are on two additional rows, which are selected by default.</p>

<p>These two rows are controlled through the MSX-AUDIO’s “general purpose
I/O ports”. These aren’t Z80 I/O ports but rather four additional I/O bits which
can be accessed through MSX-AUDIO registers 18H and 19H. Toshiba uses bits 0 and
1 to select rows 8 and 9, which can then be read from register 05H.</p>

<table>
<thead>
<tr>
	<th>Register</th>
	<th>I/O</th>
	<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
	<td>18H</td>
	<td>Write</td>
	<td>General purpose I/O port direction control. Default: 0.<br/>
	    Use 00000011B to set the direction of ports 0 and 1 to output.<br/>
	    If an output port is set to input, it will always output 1.</td>
</tr>
<tr>
	<td>19H</td>
	<td>Write</td>
	<td>General purpose I/O port data output.<br/>
	    Set bits 0 and 1 to select matrix rows 8 and 9.</td>
</tr>
<tr>
	<td>05H</td>
	<td>Read</td>
	<td>Row bits, 0 = pressed.<br/>
	    See below for the bit/key mapping.</td>
</tr>
</tbody>
</table>

<p>Whether these additional row bits are also hooked up on the Panasonic module,
I don’t know. Also, on the Philips module bits 0 and 3 are used for different
purposes (8-bit DAC enable and DAC/Y8950 output select), so you may want to
avoid setting them if a Toshiba keyboard was not detected.</p>

<p>The additional matrix rows are as follows:</p>

<table>
<caption>Toshiba HX-MU901 Multi Sensor matrix</caption>
<thead>
	<tr><th>Bit</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th><th>0</th></tr>
</thead>
<tbody>
	<tr><th>Row 8</th><td>Ribbon 1</td><td>ENTER</td><td>STOP</td><td>Ribbon 6</td><td>Ribbon 5</td><td>Ribbon 4</td><td>Ribbon 3</td><td>Ribbon 2</td></tr>
	<tr><th>Row 9</th><td>Ribbon 7</td><td>---</td><td>---</td><td>Ribbon 12</td><td>Ribbon 11</td><td>Ribbon 10</td><td>Ribbon 9</td><td>Ribbon 8</td></tr>
</tbody>
</table>

<p>The ribbon is divided into twelve sections, and each section can be pressed
individually. So if you want to use it as a linear control you will probably
want to average the values.</p>

<p>Also worth noting that there are enough unused bits in the normal key matrix,
so technically there would have been no need to introduce these two additional
rows.</p>


<p class="signed">Grauw</p>




<?php addFooter(); ?>
</body>
</html>