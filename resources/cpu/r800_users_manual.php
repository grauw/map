<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>R800 User’s Manual</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>


<h1>R800 User’s Manual</h1>

<p>Preliminary version</p>

<p>ASCII corporation<br />
Systems division</p>

<p>1991-01-24</p>

<p>Source images posted
<a href="https://twitter.com/v9938/status/1124223395141308417">here</a> and
<a href="https://twitter.com/v9938/status/1124296770270351360">here</a> by
Japanese MSX user <a href="https://twitter.com/v9938">Kinnoji</a>.</p> 


<h2 id="section1">1 Features</h2>

<ol>
<li>A 16-bit ALU pass is adopted to speed up the arithmetic processing.
	<ul>
	<li>Execute 16-bit arithmetic operation in one system clock.</li>
	</ul>
</li>
<li>Supports 24-bit wide address space.
	<ul>
	<li>Built-in memory mapper of 9 entries and memory expansion is possible
	with 16 MB.</li>
	</ul>
</li>
<li>The built-in DRAM interface allows direct connection of DRAM.
	<ul>
	<li>Direct connection of DRAM is possible.</li>
	<li>Built-in refresh controller (refresh is CAS before RAS method).</li>
	<li>Supports DRAM high-speed interface (page mode), so it can be accessed by
	computer.</li>
	</ul>
</li>
<li>Built-in clock generator (28 MHz).</li>
<li>Enhanced interrupt functionality.
	<ul>
	<li>Indirect addressing interrupt with 7 levels of priority.</li>
	</ul>
</li>
<li>Built-in 2 channels of DMA controller.</li>
<li>CPU clock is about 7 MHz and most 1 byte instructions can be executed in 1
CPU clock.</li>
<li>Compatible with Zilog Z80 and instruction code upper.
	<ul>
	<li>All Z80 instructions are supported.</li>
	<li>Supports 8-bit instructions in IX and IY registers.</li>
	<li>Supports multiplication instructions.</li>
	<li>FAST mode (performs block transfer of IO data in one instruction fetch).</li>
	</ul>
</li>
<li>Bidirectional mapper address pin.
	<ul>
	<li>When the path is open, access can be made from the DRAM section by
	inputting all addresses and /ERAS from the outside.</li>
	</ul>
</li>
</ol>


<h2 id="section7">7 Internal Extension Register</h2>

<p>R800 has registers for interrupts, DMA, and memory mapper. Register bit
assignments are shown below. The internal IO registers are accessed by bringing
the /CSREG pin low. When the address signal A0 is “Low”, the pointer of the
internal IO register is latched, and when it is “High”, the data is written. The
pointer is auto-incremented at each data write, so high-speed data transfer to
the memory mapper registers etc. is possible.</p>

<p>Internal register pointer register (/CSREG=L, A0=L, R/W)</p>

<pre> B7   B6   B5   B4   B3   B2   B1   B0
  -  IRA6 IRA5 IRA4 IRA3 IRA2 IRA1 IRA0
</pre>

<p>IRA: Internal Register Address</p>

<p>Internal register write / read data register (/CSREG=L, A0=H)</p>

<pre> B7   B6   B5   B4   B3   B2   B1   B0
DAT7 DAT6 DAT5 DAT4 DAT3 DAT2 DAT1 DAT0
</pre>


<h2 id="section8">8 Interrupt Operation</h2>

<p>The R800 interrupts have the following 4 modes.</p>


<h2 id="section10">10 DMA Controller</h2>

<p>In R800, the DMA controller has 2 channels of DMA0 and DMA1 built-in, and
DMA0 loses its priority first. The transfer destination address and transfer
source address can be set to 24 bits each and the transfer byte count can be set
to 16 bits. There is no 64K byte boundary for the transmission byte count
because a 24-bit counter is used.</p>

<p>It has a transfer source start address setting register (24 bits), transfer
destination start address setting register (24 bits), transfer number setting
register (16 bits) and mode register (8 bits) for each of the 2 channels of the
DMA controller. Refer to the internal extension register section for details on
register writing.</p>

<p>Transfer source start address setting register. (Write only)</p>

<p>Lower address setting register</p>

<pre> B7   B6   B5   B4   B3   B2   B1   B0
 A7   A6   A5   A4   A3   A2   A1   A0
</pre>

<p>Internal register address<br />
Channel 0: 20H<br />
Channel 1: 30H</p>

<p>Middle address setting register</p>

<pre> B7   B6   B5   B4   B3   B2   B1   B0
MA15 MA14 MA13  A12  A11  A10  A9   A8
</pre>

<p>Internal register address<br />
Channel 0: 21H<br />
Channel 1: 31H</p>


<h2 id="section15">15 Instruction Execution</h2>

<p>The R800 executes an instruction in SYSCLK units obtained by dividing the
XTAL frequency by 1/4. Also, since instruction fetching and instruction
execution are pipelined, the next instruction fetch is performed during
instruction execution. (See figure below.) If the prefetched instruction can not
be executed due to an interrupt or bus request, etc., the instruction that could
not be executed will be fetched again after the service such as interrupt or bus
request is finished.</p>

<p><img src="r800_users_manual_figure15-1.jpg" /></p>


<?php addFooter(); ?>
</body>
</html>