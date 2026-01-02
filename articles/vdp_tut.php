<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>VDP programming tutorial</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>VDP programming tutorial</h1>

<p>This article is a tutorial for beginner assembly programmers who want to
access the <abbr title="Machines with Software eXchangability">MSX</abbr>
<abbr title="Video Display Processor">VDP</abbr>. Knowledge of Z80 assembly is
assumed. It starts out describing the four main components of the VDP, then
goes into more detail on how to use them accompanied by some sample code.
Next it gives some information on the palette, and lastly there is a small
example using all addressing methods.</p>

<p>Table of contents:</p>

<ul>
<li><a href="#basics">The VDP basics</a></li>
<li><a href="#registers">Writing and reading VDP registers</a>
<ul>
  <li><a href="#direct">Direct register access</a></li>
  <li><a href="#indirect">Indirect register access</a></li>
  <li><a href="#status">Status register access</a></li>
</ul>
</li>
<li><a href="#vram">Writing and reading the VRAM</a>
<ul>
  <li><a href="#vramtiming">VRAM access timing</a></li>
</ul>
</li>
<li><a href="#commands">Executing VDP commands</a></li>
<li><a href="#palette">Setting the palette</a></li>
<li><a href="#example">Programming example</a></li>
</ul>


<h2 id="basics">The VDP basics</h2>

<p>There are essentially three VDPs to consider for MSX computers; the Texas
Instruments TMS9918A (MSX1), the Yamaha V9938 (MSX2), and the Yamaha V9958
(MSX2+ and turboR). The TMS9918 provides text and pattern-modes, the V9938 is a
major upgrade which adds high-resolution and high-colour bitmap modes, palettes
and scrolling capabilities, and the V9958 is a minor improvement on that, adding
a couple of screen modes with higher colour depth and improved scrolling.
This document is primarily a guide to programming the V9938, but everything
here applies to the V9958 as well.</p>

<p>The MSX V9938 VDP has four main components:</p>

<ul>
<li>It has <em><abbr title="Video RAM">VRAM</abbr></em>. This is a special 128 kB
<abbr title="Random Access Memory">RAM</abbr> area dedicated to the VDP, where it
stores its image data. The MSX <abbr title="Central Processing Unit">CPU</abbr>
can only access it indirectly through the VDP.</li>
<li>It has <em>registers</em>. With these registers you can control the VDP’s
behaviour, like which screen mode to use, the refresh frequency, and much more.
In total there are 39 write-only registers, and 10 read-only (status) registers.
The V9958 VDP has 3 additional write-only registers.</li>
<li>It has a <em>palette</em>. This is used to pick 16 indexed colours from
a total palette of 512 shades.</li>
<li>It has a <em>command unit</em>. With this the VDP can perform drawing
operations. These operations can vary from copying a specified area of an image,
to filling boxes and drawing lines. This is one of the most advanced features of
the MSX VDP, because it can perform these operations independently of the CPU.
Just submit a 15-byte command to the VDP and let it do the hard work.</li>
</ul>

<p>The CPU communicates with the VDP through 4 I/O ports, normally located at
#98-#9B. They are referred to as VDP ports 0-3, but in this article I’ll often
refer to them using their I/O port number.</p>

<p>The base VDP base port can be read from addresses #0006 (for reading) and
#0007 (for writing) in the <abbr title="Basic Input Output System">BIOS</abbr>.
The BIOS provides these addresses to allow MSX-to-MSX2 upgrade cartridges such
as the Neos MA-20 to make their new VDP available at a different I/O port.
However those cartridges are rare and you would be forgiven to just hard-code
the standard ports in your program.</p>


<h2 id="registers">Writing and reading VDP registers</h2>

<p>The VDP registers control the VDP’s behaviour. You can use them to set the
screen mode, border colour, sprite size, scroll offset, and many other display
properties. For a complete reference of their functions, see the Register
Functions section in the <a href="/resources/video/yamaha_v9938.pdf">V9938
application manual</a> (page 4 onwards).</p>

<p>The TMS9918 has 8 registers (0-7), which the MSX2’s V9938 expands to 39
(8-23 and 32-46). The V9958 adds three additional registers (25-27), oddly
register 24 was skipped and does not exist. As for status registers, the
TMS9918 has one and the V9938 and V9958 have 10.</p>

<p>The VDP registers are generally referred to as r#&lt;number&gt;, for example
r#23 is the display offset (vertical scroll) register. If you have programmed in
MSX-BASIC before, note that its register numbers 8 and above are off-by-one, that
is, r#23 is <code>VDP(24)</code>. Because the TMS9918 VDP had only 8 registers,
<code>VDP(8)</code> was used to read status register 0. When the MSX2 introduced
the V9938 VDP with many more registers, MSX-BASIC had to offset register numbers
8 and beyond by one.</p>

<p>Many of these registers can also be changed on the fly on specific lines
during active display, which makes different parts of the screen operate in
different modes, allowing you to further expand the capabilities in creative
ways. This advanced and timing-sensitive technique is commonly referred to as
screensplits.</p>

<p>As is usual on MSX, the BIOS provides functionality to access the VDP
registers. There is the <a href="/resources/msxbios.php#WRTVDP">WRTVDP</a>
routine to set registers, and <a href="/resources/msxbios.php#RDVDP">RDVDP</a>
to read the first status register. In the MSX2 SUBROM BIOS there is a
<a href="/resources/subrom.php#VDPSTA">VDPSTA</a> routine to
read the other status registers. The non-status registers can’t be read, so
the BIOS mirrors them in the system RAM area, at the following locations:</p>

<table>
<caption>BIOS VDP register mirrors</caption>
<thead>
    <tr><th>Name</th><th>Address</th><th>Description</th></tr>
</thead>
<tbody>
    <tr><td><a href="/resources/msxsystemvars.php#RG0SAV">RG0SAV - RG7SAV</a></td><td>#F3DF - #F3E6</td><td>Register 0-7 mirrors</td></tr>
    <tr><td><a href="/resources/msxsystemvars.php#RG8SAV">RG8SAV - RG23SA</a></td><td>#FFE7 - #FFF6</td><td>Register 8-23 mirrors (MSX2 and up)</td></tr>
    <tr><td><a href="/resources/msxsystemvars.php#RG25SA">RG25SA - RG27SA</a></td><td>#FFFA - #FFFC</td><td>Register 25-27 mirrors (MSX2+ and up)</td></tr>
</tbody>
</table>

<p>It is also possible to directly access the VDP I/O ports to modify the
registers, which we will describe below. When you do this, it is recommended to
also update their mirrors in RAM.</p>


<h3 id="direct">Direct register access</h3>

<p>The VDP registers can be addressed in two ways, direct and indirect. Usually
the direct way is used, but the indirect method is also practical in some
situations. For direct register access, you have to write the value to I/O port
#99 first, and then write the register number with bit 7 set (in other words,
add 128). Here is the method definition from the V9938 application manual:</p>

<pre>                     MSB  7   6   5   4   3   2   1   0  LSB
                        ┌───┬───┬───┬───┬───┬───┬───┬───┐
   Port #1 First byte   │D7 │D6 │D5 │D4 │D3 │D2 │D1 │D0 │ DATA
                        ╞═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╡
           Second byte  │ 1 │ 0 │R5 │R4 │R3 │R2 │R1 │R0 │ REGISTER #
                        └───┴───┴───┴───┴───┴───┴───┴───┘
</pre>

<p>So the code to change a register’s value will look something like this:</p>

<pre>    ld a,value
    di
    out (#99),a
    ld a,regnr + 128
    ei
    out (#99),a
</pre>

<p>Note the <code>DI</code> and the <code>EI</code> instructions in-between.
It is <em>very</em> important that you disable the interrupts during the two
<code>OUT</code>s. This is because the interrupt handler reads the status
register, which resets the value latch. Meaning that if an interrupt were to
occur between the value and register number <code>OUT</code>, it forgets the
incomplete value that was written. The <code>EI</code> can come before the
<code>OUT</code> since on Z80, <code>EI</code> has a delay of 1 instruction
before it re-enables the interrupts. Doing this will minimise the time that
interrupts are disabled, which is generally good practice because it improves
interrupt response time (particularly important for line interrupts).</p>

<p>There is no speed limit on reading and writing VDP registers, so feel free
to have just a <code>XOR A</code> between two <code>OUT</code> instructions, or
to use consecutive <code>OUTI</code> or <code>OUT (C),r</code> instructions.</p>


<h3 id="indirect">Indirect register access</h3>

<p>The other method of addressing the registers is the indirect method. This
means that you can specify the register to write to once, and then repeatedly
write values, which is potentially twice as fast. However the register needs to
be either the same for all values, or a successive range of registers (using the
auto increment function). Indirect register writing is done by setting the
register number in r#17, also specifying whether to auto-increment, and then
writing the values to port #9B:</p>

<pre>                  MSB  7   6   5   4   3   2   1   0  LSB
                     ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Register #17       │AII│ 0 │R5 │R4 │R3 │R2 │R1 │R0 │ REGISTER #
                     └─┬─┴───┴───┴───┴───┴───┴───┴───┘
                       ├── 1:  Auto increment inhibit
                       └── 0:  Auto increment on

                     ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Port #3            │D7 │D6 │D5 │D4 │D3 │D2 │D1 │D0 │ DATA
                     └───┴───┴───┴───┴───┴───┴───┴───┘
</pre>

<p>Code example:</p>

<pre>    ld a,regnr      ; add +128 for no auto increment
    di
    out (#99),a
    ld a,17 + 128
    ei
    out (#99),a

    ld b,bytecount
    ld c,#9B        ; you can also write ld bc,#nn9B, which is faster
    ld hl,address
    otir
</pre>

<p>Note that since speed can be important when programming the VDP, especially
in screensplits, you often need the fastest solution possible. In that case,
consider unrolling the <code>OTIR</code> to <code>OUTI</code>s as discussed in
the <a href="/articles/fast_loops.php#unrolling">Fast Loops</a> article.</p>


<h3 id="status">Status register access</h3>

<p>Besides the normal registers, there are also status registers. These can only
be read, although some status bits are reset when they’re read. The status
registers are usually referred to as s#&lt;number&gt;, for example s#0 (the
first status register), and they contain information about interrupts, sprite
status, and also the VDP <abbr title="Identification">ID</abbr> number with
which can identify the VDP type. (The V9938 has ID 0, the V9958 has ID 2. The
TMS9918 doesn’t have it.)</p>

<p>In order to read a status register, write the number of the status register
in r#15, after which the status register’s value can be read from port #99:</p>

<pre>                  MSB  7   6   5   4   3   2   1   0  LSB
                     ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Register #15       │ 0 │ 0 │ 0 │ 0 │S3 │S2 │S1 │S0 │ Status register
                     ╞═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╡
  Port #1 Read data  │D7 │D6 │D5 │D4 │D3 │D2 │D1 │D0 │ DATA
                     └───┴───┴───┴───┴───┴───┴───┴───┘
</pre>

<p>An important thing to remember is that with the BIOS interrupt handler
active, s#0 must <em>always</em> be selected. So if you select another status
register, keep the interrupts disabled until you’ve read it and changed back to
s#0. Also note that it is good practice to not keep the interrupts disabled for
a prolonged period of time, like when polling a certain status register while
keeping the interrupts disabled. Switch back to s#0 and enable the interrupts
regularly.</p>

<p>Some example code to read out a status register:</p>

<pre>    ld a,statusregnr
    di
    out (#99),a
    ld a,15 + 128
    out (#99),a
    in a,(#99)
    ex af,af'
    xor a           ; ld a,0
    out (#99),a
    ld a,15 + 128
    ei
    out (#99),a
    ex af,af'
</pre>


<h2 id="vram">Writing and reading the VRAM</h2>

<p>The VRAM holds image data, in the form of name and pattern tables
(screen modes 0-4) or bitmap data (screen modes 5-8), as well as sprite tables.
The VRAM is connected to the VDP, and since the CPU does not have access to it
directly, it needs to do it through the VDP.</p>

<p>The BIOS provides functionality to read and write the VRAM with the
<a href="/resources/msxbios.php#RDVRM">RDVRM</a>,
<a href="/resources/msxbios.php#WRTVRM">WRTVRM</a>,
<a href="/resources/msxbios.php#SETRD">SETRD</a>,
<a href="/resources/msxbios.php#SETWRT">SETWRT</a>,
<a href="/resources/msxbios.php#FILVRM">FILVRM</a>,
<a href="/resources/msxbios.php#LDIRMV">LDIRMV</a> and
<a href="/resources/msxbios.php#LDIRVM">LDIRVM</a> routines, which work on the
first 16 kB of VRAM. Additionally, the MSX2 BIOS also provides the
<a href="/resources/msxbios.php#NRDVRM">NRDVRM</a>,
<a href="/resources/msxbios.php#NWRVRM">NWRVRM</a>,
<a href="/resources/msxbios.php#NSETRD">NSETRD</a> and
<a href="/resources/msxbios.php#NSTWRT">NSTWRT</a> routines which use the
<a href="/resources/msxsystemvars.php#ACPAGE">ACPAGE</a> system variable to
access the full 128 kB.</p>

<p>The process of writing to the VRAM by directly accessing the VDP I/O ports
consists of two steps, first set the VDP’s address counter and the mode (read or
write access), and then the program can output (or input) a sequence of bytes to
the VDP, which writes or reads the VRAM. The address counter is set as follows:</p>

<ol type="1">
<li>Set the address counter bits 14-16 in register 14</li>
<li>Set the address counter bits 0-7</li>
<li>Set the address counter bits 8-13 and specify whether to read or to write</li>
</ol>

<p>The upper three bits in r#14 were added in the V9938 VDP to support the
larger amount of VRAM, 128 kB instead of the 16 kB of the TMS9918. Those bits
should be set first, and then bits 0-13 have to be written using two consecutive
<code>OUT</code>s to port #99. To clarify a bit more:</p>

<pre>                   MSB  7   6   5   4   3   2   1   0  LSB
                      ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Register #14        │ 0 │ 0 │ 0 │ 0 │ 0 │A16│A15│A14│ VRAM access base
                      └───┴───┴───┴───┴───┴───┴───┴───┘ address register

                   MSB  7   6   5   4   3   2   1   0  LSB
                      ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Port #1 First byte  │A7 │A6 │A5 │A4 │A3 │A2 │A1 │A0 │ VRAM access base
                      ╞═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╡ address registers
         Second byte  │ X │ X │A13│A12│A11│A10│A9 │A8 │
                      └─┬─┴─┬─┴───┴───┴───┴───┴───┴───┘
                        0   0:  Read
                        0   1:  Write
</pre>

<p>After having done this, you can read or write the data from or to port #98.
After each VRAM read/write the address counter is automatically increased, so if
you read or write repeatedly you don’t need to set the address counter again.
In screen mode 0 (width 40) and screen modes 1-3 the lower 14 bits of the
address counter wraps around whenever a multiple of 4000H (16 kB) is reached,
for compatibility with the TMS9918. In the V9938’s new screen modes the counter
counts up to the full 128 kB before it wraps.</p>

<p>Note that you shouldn’t mix reads and writes, the VDP behaviour for that is
undocumented (though known, but that goes beyond the scope of this article). If
you wish to change from reading to writing mode or vice versa you should re-set
the address with the read/write bit set appropriately.</p>

<p>On the TMS9918 the VRAM address counter gets modified when you write to a
register. If you do any register writes between VRAM access, you must set the
address counter again. If you have an interrupt handler that does any register
writes, you must keep interrupts disabled while writing to or reading from VRAM.
Fortunately the V9938’s address counter is not affected by register writes, so
you don’t need to worry about this on MSX2 and up.</p>


<h3 id="vramtiming">VRAM access timing</h3>

<p>It is important to know that there is a speed limit when accessing the VRAM.
How fast you can write exactly depends on the screen mode you’re in and whether
you have sprites enabled, etc. The TMS9918 is the slowest, and in the worst case
requires you to space your reads and writes 29 CPU cycles apart. Notably, this
is slower than the <code>OTIR</code> and <code>INIR</code> instructions (23
cycles), so use the following code instead (exactly 29 cycles):</p>

<pre>OtirToVram:
    outi
    jp nz,OtirToVram
</pre>

<p>The V9938 is quite a bit faster, reads and writes only need to be 15 CPU
cycles apart. With one exception: screen 0 requires a 20 cycle wait, both in
width 40 and 80 modes. Note that the TMS9918 is actually faster in this screen
mode, so make sure to test screen 0 programs on MSX2 hardware.</p>

<p>What this means is that in MSX2 software you can safely use the
<code>OTIR</code> and <code>INIR</code> instructions to output bulk data to the
VRAM. If you’re not in screen 0, you can also safely use <code>OUTI</code>
and <code>INI</code> instructions, refer to the
<a href="/articles/fast_loops.php">Fast Loops</a> article for more details on
how you can access the VRAM as quickly as possible by creating fast 16-bit loops
and unrolling the <code>OTIR</code> / <code>INIR</code> instructions.</p>

<p>Access times are reduced even further during vertical blanking or
when the screen is disabled, or when sprites are disabled on V9938 / V9958. See
the table below for an overview. Note that there are some cases where the V9938
and V9958 require more waits than the TMS9918. Additionally, when you intend to
exploit this knowledge to access the VDP faster during vertical blanking, please
be aware that at 60Hz the vertical blanking period is shorter than at 50Hz, so
test your code on both European and Japanese machines.</p>

<p>This table is based on information published in section 2.1.5 of the
<a href="/resources/video/texasinstruments_tms9918.pdf">TMS9918 application manual</a>,
Wouter Vermaelen’s <a href="/articles/vdp-vram-timing/vdp-timing.html">V9938 VRAM timings</a>
(<a href="/articles/vdp-vram-timing/vdp-timing-2.html">part II</a>) articles,
and measurements performed with Aoineko’s VATT test in
<a href="https://www.msx.org/forum/msx-talk/development/vatt-vram-access-timing-tester?page=3#comment-442333">this
forum thread</a>. Lastly, note that all V9938 timings also apply to the V9958.</p>

<table>
<caption>Minimum VRAM access timings in 3.58 MHz Z80 cycles</caption>
<thead>
	<tr><th>Screen mode</th><th>VDP mode</th><th>TMS9918</th><th>TMS9918<br />blanking</th><th>V9938</th><th>V9938<br />sprites off</th><th>V9938<br />blanking</th></tr>
</thead>
<tbody>
	<tr><td>screen 0, width 40</td><td>TEXT 1</td><td>12</td><td>8</td><td>20</td><td></td><td>20<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 0, width 80</td><td>TEXT 2</td><td></td><td></td><td>20</td><td></td><td>20<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 1</td><td>GRAPHIC 1</td><td>29</td><td>8</td><td>15</td><td>15<a href="#v99x8legacynote">²</a></td><td>15<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 2</td><td>GRAPHIC 2</td><td>29</td><td>8</td><td>15</td><td>15<a href="#v99x8legacynote">²</a></td><td>15<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 3</td><td>MULTICOLOR</td><td>29<a href="#tms9918mcnote">¹</a></td><td>8</td><td>15</td><td>15<a href="#v99x8legacynote">²</a></td><td>15<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 4</td><td>GRAPHIC 3</td><td></td><td></td><td>15</td><td>15<a href="#v99x8legacynote">²</a></td><td>15<a href="#v99x8legacynote">²</a></td></tr>
	<tr><td>screen 5</td><td>GRAPHIC 4</td><td></td><td></td><td>15</td><td>13</td><td>10</td></tr>
	<tr><td>screen 6</td><td>GRAPHIC 5</td><td></td><td></td><td>15</td><td>13</td><td>10</td></tr>
	<tr><td>screen 7</td><td>GRAPHIC 6</td><td></td><td></td><td>15</td><td>13</td><td>10</td></tr>
	<tr><td>screen 8</td><td>GRAPHIC 7<a href="#tms9918mcnote">³</a></td><td></td><td></td><td>15</td><td>13</td><td>10</td></tr>
</tbody>
</table>

<p id="tms9918mcnote">¹ The timings on TMS9918 for screen 3 are the same as for
screen 1-2. This is contrary to what the manual claims.</p>

<p id="v99x8legacynote">² The timings on V9938 for screen 0-4 are not affected
by disabling sprites or blanking the screen.</p>

<p id="v9958yjknote">³ The timings for V9958 YJK / YAE modes are the same as
screen 8.</p>

<p>Note that any MSX with a turbo mode, where the CPU runs faster than 3.58 MHz,
has a wait circuit which protects the VRAM from being accessed too fast. So you
do not need to worry about inserting additional waits for them. Also note that
some MSX models insert 1 or 2 extra wait cycles on every VDP access.</p>

<p>Here are example routines to set the VDP for reading/writing the VRAM:</p>

<pre>;
; Set VDP address counter to write from address AHL (17-bit)
; Enables the interrupts
;
VDP_SetWrite:
    rlc h
    rla
    rlc h
    rla
    srl h
    srl h
    di
    out (#99),a
    ld a,14 + 128
    out (#99),a
    ld a,l
    out (#99),a
    ld a,h
    or 64
    ei
    out (#99),a
    ret

;
; Set VDP address counter to read from address AHL (17-bit)
; Enables the interrupts
;
VDP_SetRead:
    rlc h
    rla
    rlc h
    rla
    srl h
    srl h
    di
    out (#99),a
    ld a,14 + 128
    out (#99),a
    ld a,l
    out (#99),a
    ld a,h
    ei
    out (#99),a
    ret
</pre>


<h2 id="commands">Executing VDP commands</h2>

<p>The command unit is one of the most powerful features of the V9938 VDP.
It can make the VDP perform drawing operations independently from the CPU,
ranging from copying or filling an area of the screen, and transferring data
between the CPU and VRAM, to drawing lines. It offers several variants of the
same operation, which exchange functionality for speed. For example, the
<abbr title="Logical Move Memory to Memory">LMMM</abbr>,
<abbr title="High-speed Move Memory to Memory">HMMM</abbr> and
<abbr title="High-speed Move Memory to Memory, Y only">YMMM</abbr> commands all
copy an area of the screen, where LMMM supports logical operations while HMMM
does not, but HMMM is significantly faster than LMMM, and YMMM even more so but
with coordinate restrictions that make it useful in only a few occasions.</p>

<p>Take a look at the COMMANDS section in the
<a href="/resources/video/yamaha_v9938.pdf">V9938 application manual</a>
(page 54 onwards) for detailed descriptions of the commands that are available, 
and refer to the <a href="/articles/vdp_commands_speed.php">VDP commands speed measurements</a>
article for more details on command speeds.</p>

<p>On the V9938 the VDP commands only work in the bitmap screen modes 5-8,
however the V9958 also allows them to be used in the pattern and text modes if
you set the CMD bit in r#25 (bit 6). In this case the coordinate system maps to
the VRAM as if it was screen 8.</p>

<p>The VDP expects its command parameters to be set in registers 32-45, and the
final command code in register 46. The fastest and easiest way to do this is by
using the <a href="#indirect">indirect register access</a> method. You can pass
a pointer to a 15-byte VDP command data block to a function which sets the
registers and executes the copy (see <code>DoCopy</code> example given below).
But before a new command is set to r#32-r#46, the program should first check the
<abbr title="Command Execute">CE</abbr> bit in s#2 (bit 0). This bit indicates
whether a previously given command has completed yet. If it hasn’t, you should
wait before giving the next command, otherwise the previous one will be aborted.
If aborting is what you want, there is a special STOP command for that.</p>

<p>Because the VDP executes commands independently of the CPU, the CPU can do
something else while the VDP is executing the command. Maximising this potential
parallelism by letting the CPU take care of other business while the VDP is
executing commands is key to getting high performance. Only once you issue
another command will the CPU have to wait for the VDP to finish.</p>

<p>Here is the <code>DoCopy</code> routine, read the small source code article
<a href="/sources/docopy.php">about <code>DoCopy</code></a> on ways to speed it
up a little more.</p>

<pre>;
; Execute a VDP command
; In:  HL = pointer to 15-byte VDP command data
; Out: HL = updated
;
VDP_DoCopy:
    ld a,32
    di
    out (#99),a
    ld a,17 + 128
    out (#99),a
    ld c,#9B
VDP_DoCopy_Ready:
    ld a,2
    di
    out (#99),a     ; select s#2
    ld a,15 + 128
    out (#99),a
    in a,(#99)
    rra
    ld a,0          ; back to s#0, enable ints
    out (#99),a
    ld a,15 + 128
    ei
    out (#99),a     ; loop if vdp not ready (CE)
    jp c,VDP_DoCopy_Ready
    outi            ; 15x OUTI
    outi            ; (faster than OTIR)
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    ret
</pre>


<h2 id="palette">Setting the palette</h2>

<p>The V9938 can select the 16 indexed colours from a 512-colour palette. This
palette has linear 3-bit red, green and blue components.</p>

<p>The MSX2 SUBROM BIOS provides palette functionality with
<a href="/resources/subrom.php#INIPLT">INIPLT</a> to initialise the palette to default,
<a href="/resources/subrom.php#RSTPLT">RSTPLT</a> to restore the palette from the VRAM mirror,
<a href="/resources/subrom.php#GETPLT">GETPLT</a> to get a palette colour from the VRAM mirror, and
<a href="/resources/subrom.php#SETPLT">SETPLT</a> to set a palette colour. Because the VDP palette can
not be read back, the BIOS mirrors the palette in VRAM, but note that you can
choose to use these VRAM addresses for different purposes, the VDP stores the
palette internally and does <em>not</em> read it from VRAM.</p>

<table>
<caption>BIOS VDP palette mirror</caption>
<thead>
    <tr><th>Screen mode</th><th>VDP mode</th><th>VRAM mirror address</th></tr>
</thead>
<tbody>
	<tr><td>screen 0, width 40</td><td>TEXT 1</td><td>#0400</td></tr>
	<tr><td>screen 0, width 80</td><td>TEXT 2</td><td>#0F00</td></tr>
	<tr><td>screen 1</td><td>GRAPHIC 1</td><td>#2020</td></tr>
	<tr><td>screen 2</td><td>GRAPHIC 2</td><td>#1B80</td></tr>
	<tr><td>screen 3</td><td>MULTICOLOR</td><td>#2020</td></tr>
	<tr><td>screen 4</td><td>GRAPHIC 3</td><td>#1B80</td></tr>
	<tr><td>screen 5</td><td>GRAPHIC 4</td><td>#7680</td></tr>
	<tr><td>screen 6</td><td>GRAPHIC 5</td><td>#7680</td></tr>
	<tr><td>screen 7</td><td>GRAPHIC 6</td><td>#FA80</td></tr>
	<tr><td>screen 8</td><td>GRAPHIC 7</td><td>#FA80</td></tr>
</tbody>
</table>

<p>Setting a new VDP palette is a rather easy thing to do. First you have to set
the palette pointer in r#16, usually it is set to 0, and then you can write your
palette values to port #9A. The palette pointer automatically increments, and
loops to 0 again when it reaches the last palette entry. By the way, please note
that in screen 8 the palette can’t be used for sprites.</p>

<p>The red, green and blue colour components of each palette entry are written
in pairs of bytes with the following format:</p>

<pre>                   MSB  7   6   5   4   3   2   1   0  LSB
                      ┌───┬───┬───┬───┬───┬───┬───┬───┐
  Port #2 First byte  │ 0 │R2 │R1 │R0 │ 0 │B2 │B1 │B0 │ Red, Blue
                      ╞═══╪═══╪═══╪═══╪═══╪═══╪═══╪═══╡
         Second byte  │ 0 │ 0 │ 0 │ 0 │ 0 │G2 │G1 │G0 │ Green
                      └───┴───┴───┴───┴───┴───┴───┴───┘
</pre>

<p>Note that the first byte of a palette value uses the same internal latch that
register writes do, so if you have an interrupt routine which writes to VDP
registers, be sure to disable interrupts while setting palette values.</p>

<p>Here is an example SetPalette routine. The <code>OTIR</code> could be
unrolled to <code>OUTI</code>s if you really need the additional speed (for
example in a screensplit).</p>

<pre>;
; Set the palette to the one HL points to...
; Modifies: AF, BC, HL (=updated)
; Enables the interrupts.
;
VDP_SetPalette:
    xor a           ; set p#pointer to zero.
    di
    out (#99),a
    ld a,16+128
    out (#99),a
    ld bc,#209A     ; out 32x to port #9A
    otir
    ei
    ret

VDP_defaultPalette:
    dw #000, #000, #611, #733, #117, #327, #151, #627, #171, #373, #661, #664, #411, #265, #555, #777
</pre>


<h2 id="example">Programming example</h2>

<p>This is an example of a short program which combines most techniques.</p>

<pre>;
; Is supposed to run in screen 5, so you should make a small BASIC loader,
; or call the CHMOD BIOS routine.
;
DoExampleCopy:
    xor a           ; set vram write base address
    ld hl,#8000     ;  to 1st byte of page 1...
    call SetVDP_Write

    ld a,#88        ; use color 8 (red)
FillL1:
    ld c,8          ; fill 1st 8 lines of page 1
FillL2:
    ld b,128        ;
    out (#98),a     ; could also have been done with
    djnz FillL2     ; a vdp command (probably faster)
    dec c           ; (and could also use a fast loop)
    jp nz,FillL1

    ld hl,COPYBLOCK ; execute the copy
    call VDP_DoCopy

    ret


COPYBLOCK:
    db 0,0,0,1
    db 0,0,0,0
    db 8,0,8,0
    db 0,0,#D0        ; HMMM

; As an alternate notation, you might actually prefer the following:
;
;   dw    #0000,#0100
;   dw    #0000,#0000
;   dw    #0008,#0008
;   db    0,0,#D0
</pre>

<p>~Grauw</p>

<?php addFooter(); ?>
</body>
</html>
