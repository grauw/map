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
contents are preserved when the computer is off by means of a little
battery.</p>

<p>Amongst others they are used by the internal firmware in Sony’s HB-55 and
HB-75 computers and by Yamaha’s CX5M music computer software. The Sony HB-55 and
HB-75’s firmware also add the ability to store a BASIC program on the HBI-55
using the <code>SAVE "CAT:"</code> and <code>LOAD "CAT:"</code> commands.</p>

<h2>Memory access</h2>

<p>The HBI-55 uses the 8255 PPI (Programmable Peripheral Interface) as a
controller IC to access the memory. If this sounds familiar, that’s right; all
MSX computers also contain a PPI to deal with slot selection, keyboard I/O etc.
The HBI-55 has a PPI of its own to access the SRAM at I/O ports 0B0H-0B3H.</p>

<p>Here’s a little block diagram:</p>

<pre>   IRQ and A2-A7    A0-A1 RD/WR  D0-D7
  ┌─────────────┐    │ │   │ │  ││││││││
  │Adresdecoding├─┐  │ │   │ │  ││││││││
  └─────────────┘ │  │ │   │ │  ││││││││
  ┌───────────────┴──┴─┴───┴─┴──┴┴┴┴┴┴┴┴─┐
  │8255 Programmable Peripheral Interface│
  └───┬┬┬┬┬┬┬┬────┬┬┬┬┬┬┬┬────┬┬┬┬┬┬┬┬───┘
     C││││││││   B││  ││││   A││││││││
      ││││││││    ││  │││└───┐││││││││
      ││││││││    ││  ││└───┐│││││││││
      ││││││││    ││  │└───┐││││││││││
      ││││││││    ││  └───┐│││││││││││
    ┌─┴┴┴┴┴┴┴┴────┴┴──────┴┴┴┴┴┴┴┴┴┴┴┴─┐
    │  D0-D7   W/R  EN        A0-A11   │
    │       4 Kilobyte static RAM      │
    └──────────────────────────────────┘</pre>

<p>The PPI’s three ports and control register are set up as follows:</p>

<table>
<thead>
<tr><th>Port</th><th>Register</th><th>Value</th></tr>
</thead>
<tbody>
<tr><td>0B0H</td><td>Port A</td><td>Address bits 0-7</td></tr>
<tr><td>0B1H</td><td>Port B</td><td>bit 0-3: Address bits 8-11<br />
bit 6: Set to 1<br />bit 7: Read (1) or write (0)</td></tr>
<tr><td>0B2H</td><td>Port C</td><td>Data read / write</td></tr>
<tr><td>0B3H</td><td>Control</td><td>89H: Read<br />80H: Write</td></tr>
</tbody>
</table>

<p>First, configure the PPI for reading or for writing using the control
register (0B3H). Output 89H to read, or 80H to write. For more details about
these values, consult the <a href="/resources/#ppi">PPI documentation</a>.</p>

<p>Next, set the 12-bit address. Write the lowest eight address bits to port
A (0B0H), and the highest four address bits to bits 0-3 of port B (0B1H).
Additionally, set bit 6 of port B to 1, and set bit 7 to indicate whether to
read (1) or to write (0). That’s right, you need to indicate whether to read or
write again, this time you’re instructing the SRAM itself.</p>

<p>Finally, read or write the value through port C (0B2H).</p>

<p>Here’s some example BASIC code:</p>

<pre>10 ' HBI55.BAS by Bjorn Lammers
20 ' Controlling the
30 ' Sony Data Cartridge
40 '
50 ' Writing
60 INPUT "Adress";AD
70 INPUT "Data";DT
80 ' Control register
90 OUT &amp;HB3,&amp;H80
100 ' Adress low
110 OUT &amp;HB0,AD AND &amp;B11111111
120 ' Adress high
130 OUT &amp;HB1,(AD\256) OR &amp;B01000000
140 ' Data
150 OUT &amp;HB2,DT
160 ' Reading
170 INPUT "Adress";AD
180 ' Control register
190 OUT &amp;HB3,&amp;H89
200 ' Adress low
210 OUT &amp;HB0,AD AND &amp;B11111111
220 ' Adress high
230 OUT &amp;HB1,(AD\256) OR &amp;B11000000
240 ' Read data
250 DT=INP(&amp;HB2)
260 PRINT "Data: &amp;H"+HEX$(DT)
270 END</pre>

<p class="signed">Grauw</p>




<?php addFooter(); ?>
</body>
</html>