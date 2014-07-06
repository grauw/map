<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Yamaha YM2148 MIDI interface</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>Yamaha YM2148, FM Sound Synthesizer Unit MIDI interface</h1>

<p>The Yamaha YM2148 is used as the MIDI UART for the SFG-01 and SFG-05 FM Sound
Synthesizer Unit modules. In these modules it works in tandem with the YM2151
“OPM” sound chip. The YM2148 and YM2151 are accessed through <em>memory mapped
I/O</em> at address 3FF0H-3FF6H of the SFG’s ROM. More specifically:</p>

<table>
<thead>
<tr><th>Address</th><th>Access</th><th>Description</th></tr>
</thead>
<tbody>
<tr><td>3FF0H</td><td>R</td><td>FM status register</td></tr>
<tr><td>3FF0H</td><td>W</td><td>FM address register</td></tr>
<tr><td>3FF1H</td><td>R/W</td><td>FM data register</td></tr>
<tr><td>3FF2H</td><td>R/W</td><td>External mounted keyboard (MK) I/O</td></tr>
<tr><td>3FF3H</td><td>W</td><td>MIDI UART IRQ vector</td></tr>
<tr><td>3FF4H</td><td>W</td><td>External IRQ vector</td></tr>
<tr><td>3FF5H</td><td>R/W</td><td>MIDI UART data read / write buffer</td></tr>
<tr><td>3FF6H</td><td>R</td><td>MIDI UART status register</td></tr>
<tr><td>3FF6H</td><td>W</td><td>MIDI UART command register</td></tr>
</tbody>
</table>

<p>Note that these are not regular memory locations; the values you read and
write are not stored. They are dynamic and behave like I/O ports do. Reading an
address can access a different function than writing to it. For example writing
to 3FF6H configures the UART, but reading from 3FF6H will not give you the
current configuration; in stead it gives status information.</p>

<p>In this document we will focus on the YM2148 MIDI UART’s registers. For more
information about the FM registers, refer to the <a href="/resources/#opm">OPM
documentation</a>. For more information about the Yamaha external keyboard I/O
register, refer to <a href="http://www.cx5m.net/fmunit.htm">NYYRIKKI’s
documentation</a>.</p>

<h2 id="registers">Register overview</h2>

<p>Following is an overview of the YM2148’s registers. See the
<a href="#usage">usage section</a> for more information.</p>


<h3 id="midi_vector">MIDI UART IRQ vector (3FF3H, write)</h3>

<p>MIDI interrupt vector for use with IM2.</p>


<h3 id="external_vector">External IRQ vector (3FF4H, write)</h3>

<p>External interrupt vector for use with IM2.</p>


<h3 id="data_buffer">Data buffer (3FF5H, read / write)</h3>

<p>Data buffer read / write port.</p>

<p>There are separate buffers for reading and writing. The buffer size is
1 byte.</p>


<h3 id="status_register">Status register (3FF6H, read)</h3>

<p>Returns UART status information.</p>

<table>
<tr><td>bit 0</td><td>TxRDY (1 = Tx ready)</td></tr>
<tr><td>bit 1</td><td>RxRDY (1 = Rx ready)</td></tr>
<tr><td>bit 4</td><td>Overrun error flag (1 = error occurred)</td></tr>
<tr><td>bit 5</td><td>Framing error flag (1 = error occurred)</td></tr>
</table>

<p>The error flags only apply to incoming data.</p>


<h3 id="command_register">Command register (3FF6H, write)</h3>

<p>Configures the UART.</p>

<table>
<tr><td>bit 0</td><td>Tx enable (1 = enabled)</td></tr>
<tr><td>bit 1</td><td>TxRDY interrupt enable (1 = enabled)</td></tr>
<tr><td>bit 2</td><td>Rx enable (1 = enabled)</td></tr>
<tr><td>bit 3</td><td>RxRDY interrupt enable (1 = enabled)</td></tr>
<tr><td>bit 4</td><td>Clear error flags command (1 = clear)</td></tr>
<tr><td>bit 5</td><td>Unknown</td></tr>
<tr><td>bit 6</td><td>Unknown</td></tr>
<tr><td>bit 7</td><td>Reset UART command (1 = reset, other bits should be 0)</td></tr>
</table>

<p>Note that some bits act as commands when they are set (notably, bit 4),
but others are regular flags. Therefore, you will want to mirror the current
value so that you can only change the bits you need to change. You need to
mirror it because you can’t read back the value you’ve written.</p>


<h2 id="detection">Detecting the SFG-01 and SFG-05</h2>

<p>When inserted in the special side expansion slot in Yamaha MSX computers,
the SFG-01/05 will always be present in slot 3-3. However,
it can also be inserted into regular cartridge slots with the
Yamaha UCN-01 Unit Connector adapter, so you should not make any assumptions
about the slot it is in. In stead, you need to search for it.</p>

<p>Like any search routine, you need to iterate through all slots and subslots
when they’re expanded, and look for the identification string “MCHFM0” at
address 80H. Consult the <a href="/resources/sound/yamaha_sfg05_mbios.pdf">MBIOS
documentation</a> section 1-5 for more details.</p>

<p><a href="http://www.cx5m.net/fmunit.htm">NYYRIKKI’s FM-Sound Synthesizer Unit
documentation</a> provides an example detection routine.</p>


<h2 id="usage">Initialising and using the YM2148 MIDI UART</h2>

<p>Before you start using the YM2148, you first want to reset it. You can do
this by writing the value 80H to the command port. After it has been reset,
configure it for normal operation by writing the value 05H.</p>

<p>Now you can send and receive data. Use the TxRDY flag in the status register
to determine whether the buffer is empty, and then write the data byte you want
to transmit to the data buffer. Use the RxRDY flag in the status register to
determine whether a data byte is available, and if it is set you can read the
value from the data buffer.</p>

<p>If the status register’s overrun error flag is set, it means a byte was
received while the previous value hadn’t been read yet. If the framing error
flag is set, it means something went wrong during transmission of the value.
If one of these errors occur, you can clear the flags by setting the clear error
flags bit in the command register (beware to keep the other bits intact).</p>

<p>Note that the error flags themselves do not raise interrupts, so clearing
them is not necessary. You could even choose to ignore them entirely. When an
overflow error occurs, the buffer will contain the new byte. When a framing
error occurs, the badly received byte will most likely not be placed in the
buffer (needs to be confirmed).</p>

<p>The YM2148 can also be configured to generate interrupts when a value has
been received or when it’s ready to send.</p>

<p>To generate an interrupt when a byte is received, set the RxRDY interrupt
enable flag in the command register. Now as soon as the RxRDY flag goes high,
the Z80 will receive an interrupt signal. The interrupt signal is cleared as
soon as the value is read from the buffer.</p>

<p>To generate an interrupt when a byte is ready to be sent, set the TxRDY
interrupt enable flag in the command register. An interrupt signal will be
generated when the TxRDY flag is high. The interrupt signal will be cleared as
soon as a value is set to the buffer, and if there are no more bytes to send you
can disable the interrupt by disabling the command register flag.</p>

<p>A rather unique feature of the YM2148 is that it can also generate vectors
for interrupt mode 2 (IM2). The Z80 interrupt mode 2 combines a base address set
in the I register with a vector provided by the device, forming an index into an
interrupt handler address table. This allows device interrupts to immediately
invoke their handlers rather than query all devices one by one as it is usually
done on MSX.</p>

<p>On the YM2148, the vector can be set by the user program. The MIDI UART IRQ
vector register allows you to specify the vector used for interrupts originating
from the YM2148 itself. The external IRQ vector register is used to specify
the vector send for timer interrupts coming from the YM2151.</p>

<p>A word of warning though: IM2 falls outside of the normal operation of MSX
computers. It works, and is used sometimes, but it is not the way things are
normally done and has a couple of pitfalls as a result. Also, the usage
documentation is likely incomplete; it seems that command register bits 5 and 6
are involved, but some further investigation is needed to figure out the
details.</p>

<p>So, do not feel obliged to use the IM2 mode just because it supports it.
For first-time users, I would recommend to start with normal IM1 mode interrupt
handling, and only move to IM2 mode when there is a need for it.</p>


<p class="signed">Grauw</p>


<?php addFooter(); ?>
</body>
</html>
