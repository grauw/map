<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>JVC MSX MIDI interface</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>JVC MSX MIDI interface</h1>

<p>The JVC MSX MIDI interface is based on the <a href="motorola_mc68b50.pdf">Motorola MC6850 ACIA</a>
with a 2 MHz clock crystal. It also provides a <a href="https://en.wikipedia.org/wiki/DIN_sync">DIN sync</a> input.
Electro Music Research also manufactured this interface for several other platforms,
like the <a href="https://www.worldofspectrum.org/infoseekid.cgi?id=1000830">ZX Spectrum</a>,
<a href="http://www.cpcwiki.eu/index.php/EMR_MIDI_Interface">Amstrad CPC</a> and
<a href="http://mdfs.net/Info/Comp/BBC/MIDI/">BBC Micro</a>.</p>

<table>
<tr>
  <th>Port</th>
  <th>Description</th>
</tr>
<tr>
  <td>#00</td>
  <td>DIN sync input. Bit 0: stop / start, bit 1: clock pulse.</td>
</tr>
<tr>
  <td>#02</td>
  <td>MC6850 ACIA command / status. Note: use /64 divider.</td>
</tr>
<tr>
  <td>#03</td>
  <td>MC6850 ACIA data</td>
</tr>
</table>

<p>The I/O ports are mirrored at #08-#0B.</p>

<p>Thanks go to gflorez for
<a href="https://www.msx.org/forum/msx-talk/hardware/jvc-msx-midi-interface?page=1#comment-377145">providing</a>
port and divider information.</p>

<p class="signed">Grauw</p>

<?php addFooter(); ?>
</body>
</html>
