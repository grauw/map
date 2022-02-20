<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Sony HBI-55 Data Cartridge / Yamaha UDC-01 Data Memory</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Sony HBI-55 Data Cartridge / Yamaha UDC-01 Data Memory</h1>

<p>The Sony HBI-55 and the technically equivalent Yamaha UDC-01 are 4 kB SRAM
data cartridges. This SRAM, or static RAM, is very low power memory whose
contents are preserved when the computer is off by means of a CR2032 coin cell
battery.</p>

<p>Amongst others they are used by the internal firmware in Sony’s HB-55 and
HB-75 computers and by Yamaha’s CX5M music computer software. The Sony HB-55 and
HB-75’s firmware also add the ability to store a BASIC program on the HBI-55
using the <code>SAVE "CAT:"</code> and <code>LOAD "CAT:"</code> commands.</p>

<h2>Memory access</h2>

<p>The HBI-55 uses the <a href="/resources/ppi/intel_82c55a.pdf">8255 PPI
(Programmable Peripheral Interface)</a> as a controller IC to access the memory.
If this sounds familiar, that’s right; all MSX computers also contain a PPI to
deal with slot selection, keyboard I/O etc. The HBI-55 has a PPI of its own to
access the SRAM at I/O ports 0B0H-0B3H.</p>

<p>Here’s a little block diagram:</p>

<pre>     IORQ, A2-A7      A0-A1 RD/WR  D0-D7
  ┌───────────────┐    │ │   │ │  ││││││││
  │Addres decoding├─┐  │ │   │ │  ││││││││
  └───────────────┘ │  │ │   │ │  ││││││││
  ┌─────────────────┴──┴─┴───┴─┴──┴┴┴┴┴┴┴┴─┐
  │ 8255 Programmable Peripheral Interface │
  └────┬┬┬┬┬┬┬┬────┬┬┬┬┬┬┬┬────┬┬┬┬┬┬┬┬────┘
      C││││││││   B│└┴┴┤│││   A││││││││
       ││││││││    │   │││└───┐││││││││
       ││││││││    │   ││└───┐│││││││││
       ││││││││    │   │└───┐││││││││││
       ││││││││    │   └─┐  │││││││││││
     ┌─┴┴┴┴┴┴┴┴────┴─────┴──┴┴┴┴┴┴┴┴┴┴┴─┐
     │   D0-D7   WE/OE   CS    A0-A10   │
     │     2x  2048 byte static RAM     │
     └──────────────────────────────────┘</pre>

<p>Refer to the <a href="/resources/memory/sony_hbi-55_sm.pdf">Sony HBI-55
Service Manual</a> for a more detailed circuit diagram.</p>

<h3>PPI interface</h3>

<p>The PPI’s three ports and control register are set up as follows:</p>

<table>
<thead>
<tr><th>I/O Port</th><th>Register</th><th>I/O</th><th>Value</th></tr>
</thead>
<tbody>
<tr><td>0B0H</td><td>Port A</td><td>O</td><td>Address bits 0-7</td></tr>
<tr><td>0B1H</td><td>Port B</td><td>O</td><td>bit 0-3: Address bits 8-11<br />
bit 4-5: Address bits 12-13 (unused, keep 0)<br />
bit 6: Chip enable (1 = enable)<br />
bit 7: Output enable (1) or write enable (0)</td></tr>
<tr><td>0B2H</td><td>Port C</td><td>I/O</td><td>Data read / write</td></tr>
<tr><td>0B3H</td><td>Control</td><td>O</td><td>89H: Read<br />80H: Write</td></tr>
</tbody>
</table>

<p>PPI ports A-C are interfaced to two 2K SRAM chips. Address bits 0-10
(Port A, B) and the data bits (Port C) are directly connected to the address and
data lines of the SRAM chips. Port B bits 3-5 select the SRAM chip, up to eight
in theory, but only two are present. Addresses ≥ 1000H can not be read from or
written to. Bit 6 is a global chip enable. Bit 7 selects whether the SRAM chip
outputs (OE) or stores (WE) the data.</p>

<p>Care must be taken to fully set up the data and address lines before flagging
the chip enable bit. Especially if the chip is in write mode, changing the
address LSB, address MSB or data will immediately store whichever address and
data it is pointing to in-between, and likely cause unintended modifications
to the memory. Similarly, make sure to clear the chip enable after the
write.</p>

<p>The I/O direction of PPI port C is set using the control register. Output 89H
to read, or 80H to write. <em>Do not set the SRAM output enable and chip enable
while PPI port C is in output mode. Doing this causes a short circuit and can
damage the cartridge.</em></p>

<h3>Procedure for reading</h3>

<ol>
  <li>Set control register (0B3H) to 89H to configure PPI port C for input.</li>
  <li>Set port A (0B0H) to the low eight address bits.</li>
  <li>Set port B (0B1H) to 11000000b ORed with the highest four address bits.</li>
  <li>Read the data value from port C (0B2H).</li>
  <li>Set port B (0B1H) to 10000000b ORed with the high four address bits.</li>
</ol>

<p>In step 5 you can also just output 0 since we already got the value.</p>

<p>When reading multiple values, you can cycle through steps 2-4.</p>

<h3>Procedure for writing</h3>

<ol>
  <li>Set control register (0B3H) to 80H to configure PPI port C for output.</li>
  <li>Set port C (0B2H) to the data value.</li>
  <li>Set port A (0B0H) to the low eight address bits.</li>
  <li>Set port B (0B1H) to 01000000b ORed with the high four address bits.</li>
  <li>Set port B (0B1H) to 00000000b ORed with the high four address bits.</li>
</ol>

<p>When writing multiple values, you can cycle through steps 2-5.</p>

<h3>Example code</h3>

<p>Here’s an example BASIC program:</p>

<pre>100 ' HBI55.BAS by Bjorn Lammers and Grauw
110 ' Controlling the
120 ' Sony Data Cartridge
130 '
140 ' Writing
150 INPUT "Address";AD
160 INPUT "Data";DT
170 ' PPI Control: Set mode 0, port A &amp; B &amp; C output
180 OUT &amp;HB3,&amp;H80
190 ' PPI Port C: Set data
200 OUT &amp;HB2,DT
210 ' PPI Port A: Address low
220 OUT &amp;HB0,AD AND &amp;B11111111
230 ' PPI Port B: Address high, write enable, chip enable
240 OUT &amp;HB1,(AD\256) OR &amp;B01000000
250 ' PPI Port B: Address high, write enable, chip disable
260 OUT &amp;HB1,(AD\256) OR &amp;B00000000
270 ' Reading
280 INPUT "Address";AD
290 ' PPI Control: Set mode 0, port A &amp; B output, port C input
300 OUT &amp;HB3,&amp;H89
310 ' PPI Port A: Address low
320 OUT &amp;HB0,AD AND &amp;B11111111
330 ' PPI Port B: Address high, output enable, chip enable
340 OUT &amp;HB1,(AD\256) OR &amp;B11000000
350 ' PPI Port C: Read data
360 DT=INP(&amp;HB2)
370 ' PPI Port B: Address high, output enable, chip disable
380 OUT &amp;HB1,(AD\256) OR &amp;B10000000
390 PRINT "Data: &amp;H"+HEX$(DT)
400 END</pre>

<p class="signed">Grauw</p>

<?php addFooter(); ?>
</body>
</html>