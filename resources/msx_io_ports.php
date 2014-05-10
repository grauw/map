<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX I/O ports overview</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>MSX I/O ports overview</h1>

<p>Here’s an overview of all used I/O ports on MSX as far as I could find out at the moment. Some entries will contain a link to a more specific description on how to use those ports.</p>

<p><em>More detailed port descriptions will be added later when I have more time. And a request: if you have more details about devices where I put a note, or if you see an error, then please mail us (email address can be found on the main page).</em></p>

<table>
<tr>
<th>Port range</th>
<th>Description</th>
</tr>
<tr>
  <td>#00-#01</td>
  <td>Music Module MIDI, output ports</td>
</tr>
<tr>
  <td>#00-#03</td>
  <td>FAC MIDI interface</td>
</tr>
<tr>
  <td>#00-#02</td>
  <td>MIDI Saurus</td>
</tr>
<tr>
  <td>#04-#05</td>
  <td>Music Module MIDI, input ports</td>
</tr>
<tr>
  <td>#0F</td>
  <td><a href="#zemina-memory">Zemina memory extensions</a></td>
</tr>
<tr>
  <td>#18-#19</td>
  <td>Philips Barcode Reader NMS1170/20</td>
</tr>
<tr>
  <td>#20-#28</td>
  <td>Second setting Philips NMS1251 modem</td>
</tr>
<tr>
  <td>#20-#28</td>
  <td>Second setting Miniware M4000 modem</td>
</tr>
<tr>
  <td>#28-#2F</td>
  <td>Second setting Philips NMS1210 RS232 interface</td>
</tr>
<tr>
  <td>#2E-#2F</td>
  <td>openMSX debug device (default address)</td>
</tr>
<tr>
  <td>#30-#38</td>
  <td>Philips NMS1251 modem</td>
</tr>
<tr>
  <td>#30-#38</td>
  <td>Miniware M4000 modem</td>
</tr>
<tr>
  <td>#30-#38</td>
  <td>GREEN/MAK SCSI-interface</td>
</tr>
<tr>
  <td>#30-#38</td>
  <td>CD-ROM interface</td>
</tr>
<tr>
  <td>#40-#4F</td>
  <td><a href="#switch_io">Switched I/O ports</a></td>
</tr>
<tr>
  <td>#60-#6F</td>
  <td><a href="#gfx9000">Graphics9000 / v9990</a></td>
</tr>
<tr>
  <td>#70</td>
  <td>MIDI Saurus <em>(wasn’t it on #00-#02 already?)</em></td>
</tr>
<tr>
  <td>#7C-#7D</td>
  <td>MSX-Music / FM-Pac / OPLL</td>
</tr>
<tr>
  <td>#7E-#7F</td>
  <td>MSX 2 key cartridge <em>(what is it?)</em></td>
</tr>
<tr>
  <td>#7E-#7F</td>
  <td>MoonSound / OPL4 - WAVE-bank</td>
</tr>
<tr>
  <td>#80-#83</td>
  <td><a href="#rs232">RS232C UART / 8251</a> <em>(Spectravideo, and Sony (if enabled))</em></td>
</tr>
<tr>
  <td>#84-#87</td>
  <td><a href="#rs232">RS232C programmable timer / 8253</a> <em>(Spectravideo, and Sony (if enabled))</em></td>
</tr>
<tr>
  <td>#88-#8B</td>
  <td>Alternate VDP v9938 ports for MSX1 to MSX2 adaptor</td>
</tr>
<tr>
  <td>#8C-#8D</td>
  <td>Sony MSX Modem <em>(HBI-1200? “TELECOM BIOS” what does it mean?)</em></td>
</tr>
<tr>
  <td>#8E-#8F</td>
  <td>MegaRAM / MegaRAM Disk</td>
</tr>
<tr>
  <td>#90-#91</td>
  <td>Printer port interface</td>
</tr>
<tr>
  <td>#93</td>
  <td>Printer port bus direction <em>(does it exist?)</em></td>
</tr>
<tr>
  <td>#98-#9B</td>
  <td><a href="#vdp">VDP / Video Display Processor / TMS9918A / v9938 / v9958</a></td>
</tr>
<tr>
  <td>#A0-#A3</td>
  <td><a href="#psg">PSG / AY-3-8910</a>, <a href="#psgioports">I/O ports A &amp; B</a></td>
</tr>
<tr>
  <td>#A4-#A5</td>
  <td>PCM controller (turboR)</td>
</tr>
<tr>
  <td>#A7</td>
  <td><a href="#pausetr">Pause / R800 info</a> (turboR)</td>
</tr>
<tr>
  <td>#A8-AB</td>
  <td><a href="#ppi">PPI / Programmable Peripheral Interface / 8255</a></td>
</tr>
<tr>
  <td>#AC-AF</td>
  <td>MSX-Engine / S3527 / S1985</td>
</tr>
<tr>
  <td>#B0-B3</td>
  <td>Sony HBI-55 data cartridge (4kB SRAM) <em>(‘External memory’? 8255??)</em></td>
</tr>
<tr>
  <td>#B4-B5</td>
  <td>Clock chip / RP-5C01</td>
</tr>
<tr>
  <td>#B8-BB</td>
  <td>Card Reader <em>(maybe the <a href="http://www.faq.msxnet.org/hardware.html#Electric">Softcard adaptor</a> or <a href="http://www.faq.msxnet.org/hardware.html#Hudson">Bee Pack</a>???)</em></td>
</tr>
<tr>
  <td>#B8-BB</td>
  <td>Sanyo lightpen interface</td>
</tr>
<tr>
  <td>#BC-BF</td>
  <td>JVC video controller</td>
</tr>
<tr>
  <td>#C0-#C1</td>
  <td>MSX-Audio / Music Module / OPL1</td>
</tr>
<tr>
  <td>#C0-#C1</td>
  <td>MoonSound / OPL4 - FM-bank 1 alternate addressing mode</td>
</tr>
<tr>
  <td>#C2-#C3</td>
  <td>MSX-Audio / Music Module / OPL1 - 2nd cartridge</td>
</tr>
<tr>
  <td>#C2-#C3</td>
  <td>MoonSound / OPL4 - FM-bank 2 alternate addressing mode</td>
</tr>
<tr>
  <td>#C4-#C5</td>
  <td>MoonSound / OPL4 - FM-bank 1</td>
</tr>
<tr>
  <td>#C6-#C7</td>
  <td>MoonSound / OPL4 - FM-bank 2</td>
</tr>
<tr>
  <td>#C8-#CF</td>
  <td>MSX Interface</td>
</tr>
<tr>
  <td>#D0-#D7</td>
  <td>FDC / Floppy Disk Controller <em>(which types?)</em></td>
</tr>
<tr>
  <td>#D8-#D9</td>
  <td>Kanji ROM, JIS 1</td>
</tr>
<tr>
  <td>#DA-#DB</td>
  <td>Kanji ROM, JIS 2</td>
</tr>
<tr>
  <td>#DC-#DD</td>
  <td>Kanji ROM, 24-dots</td>
</tr>
<tr>
  <td>#E0-#E2</td>
  <td>External MIDI interface (micro pack)</td>
</tr>
<tr>
  <td>#E4-#E7</td>
  <td><a href="#s1990">S1990 controller</a> (turboR)</td>
</tr>
<tr>
  <td>#E8-#EF</td>
  <td>Internal MIDI interface (turboR GT)</td>
</tr>
<tr>
  <td>#F4</td>
  <td><a href="#sysflags">System flags</a></td>
</tr>
<tr>
  <td>#F5</td>
  <td>System control</td>
</tr>
<tr>
  <td>#F6</td>
  <td>Reserved for color bus I/O</td>
</tr>
<tr>
  <td>#F7</td>
  <td>A/V controller</td>
</tr>
<tr>
  <td>#F8</td>
  <td>Optional A/V controller for PAL version</td>
</tr>
<tr>
  <td>#F8-#FB</td>
  <td>Memory Mapper controller (in 16-bit mappers, contains MSB)</td>
</tr>
<tr>
  <td>#FC-#FF</td>
  <td><a href="#mmapper">Memory Mapper registers</a></td>
</tr>
</table>

<p>Here are also some memory-mapped I/O areas:</p>

<table>
<tr>
  <th>Address Range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#7FC0-#7FCF</td>
  <td><a href="#a1fm-modem">Panasonic FS-A1FM Modem ROM</a></td>
</tr>
<tr>
  <td>#FFFF</td>
  <td><a href="#subslot">Secondary slot select register</a></td>
</tr>
</table>


<p><i>Information collected from various sources. Special thanks go to Alex Wulms for the nice overview published in MCCM 75.</i></p>


<h2 id="zemina-memory">Zemina memory extensions</h2>

<p>Port #0F is used for the Zemina Golden Box (ZMB-1024, 1Mbit / 128K), Black Box (1Mbit / 128K), Deluxe Box (ZMB-2048, 2Mbit / 256K) and Deluxe IV (4Mbit / 512K) memory extensions.</p>

<p>It uses I/O port #0F for device settings, and address #4000 for page select if the device is in RAM SELECT mode.</p>

<table>
<tr>
  <th>Port</th>
  <th>Description</th>
</tr>
<tr>
  <td rowspan="2">#0F</td>
  <td>Page size select<br />
      bit 7, 6: 8K (1, 0) or 16K (0, 1)</td>
</tr>
<tr>
  <td>Function of writing to address range #4000-#BFFF<br />
      bit 5, 4: RAM SELECT (1, 0) or WRITE (0, 1)</td>
</tr>
</table>

<p>For a 128K extension, with a page size of 8K there are 16 pages, with a page size of 16K there are 8 pages.</p>

<p>Following are some examples, that assume the Zemina memory extension slot is selected for address range #4000-#7FFF.</p>

<p>To switch RAM page 5 to address #4000-#5FFF (8K page size):</p>

<pre>LD   A,10100000B
OUT  (0FH),A
LD   A,5
LD   (4000H),A
</pre>

<p>To copy the contents of the MSX main RAM address range #A000-#BFFF to RAM page 3 (8K page size):</p>

<pre>LD   A,10100000B
OUT  (0FH),A
LD   A,3
LD   (4000H),A
LD   A,10010000B
OUT  (0FH),A
LD   HL,0A000H
LD   DE,4000H
LD   BC,2000H
LDIR
</pre>

<p>See the <a href="http://www.hqunix.com/wordpress/?page_id=554">scanned manual</a> with partial translation for more info.</p>


<h2 id="switch_io">Switched I/O ports</h2>

<p>According to the MSX2 Hardware Specification, ports #40-#4F are forming the so-called ‘switched I/O ports’. With these the limitation of a maximum number of 256 I/O ports can be overcome, although it does require a little additional logic on the hardware’s behalf. The port numbers #41-#4F are the actual switched ports, and the device ‘connected’ (e.g. listening to) to those ports is determined by the device ID written to port #40. This device ID can be a number from 1-254, and when port #40 is read it returns the complement of the current device ID.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#40</td>
  <td>Device ID register</td>
</tr>
<tr>
  <td>#41-#4F</td>
  <td>Switched I/O ports</td>
</tr>
</table>

<p>ID numbers between 1 and 127 are manufacturer ID numbers, and ID numbers 128 to 254 are device IDs. As a basic rule, those devices which are designed specifically for one machine should contain the manufacturer’s company ID, while periperhal devices which can be used on all MSX computers should have a device ID number. Also, the Z80 actually has a 16-bit I/O addressing space so it is recommended to access in 16-bit by decoding the upper 8 bits for those IDs which might be expanded in the future (although I have personally only seen this done in the ADVRAM hardware). Especially for devices which are connected with their make ID it can be expected that they might eventually need more addressing space, and with this it will be future-proofed.</p>

<p>List of BIOS extension device ID’s:</p>
<table>
<tr><th>ID</th><th>Maker/device</th></tr>
<tr><td>1</td><td>ASCII/Microsoft</td></tr>
<tr><td>2</td><td>Canon</td></tr>
<tr><td>3</td><td>Casio</td></tr>
<tr><td>4</td><td>Fujitsu</td></tr>
<tr><td>5</td><td>General</td></tr>
<tr><td>6</td><td>Hitachi</td></tr>
<tr><td>7</td><td>Kyocera</td></tr>
<tr><td>8</td><td>Matsushita (Panasonic)</td></tr>
<tr><td>9</td><td>Mitsubishi</td></tr>
<tr><td>10</td><td>NEC</td></tr>
<tr><td>11</td><td>Nippon Gakki</td></tr>
<tr><td>12</td><td>JVC</td></tr>
<tr><td>13</td><td>Philips</td></tr>
<tr><td>14</td><td>Pioneer</td></tr>
<tr><td>15</td><td>Sanyo</td></tr>
<tr><td>16</td><td>Sharp</td></tr>
<tr><td>17</td><td>SONY</td></tr>
<tr><td>18</td><td>Spectravideo</td></tr>
<tr><td>19</td><td>Toshiba</td></tr>
<tr><td>20</td><td>Mitsumi</td></tr>
<tr><td>128</td><td>Image Scanner (Matsushita)</td></tr>
<tr><td>254</td><td>MPS2 (ASCII)</td></tr>
</table>

<p>Some example code, this enables the 6MHz mode on Panasonic FS-A1WX/WSX/FX computers:</p>

<table>
<tr><th>Port</th><th>Panasonic extensions</th></tr>
<tr>
  <td>#40</td>
  <td>= 8 (Panasonic manufacturer ID)</td>
</tr>
<tr>
  <td rowspan="2">#41</td>
  <td><i>Available on FS-A1FX/WX/WSX only:</i><br />
      bit 0: CPU speed mode (0=5.37MHz, 1=3.57MHz)</td>
</tr>
<tr>
  <td><i>Available on FS-A1FX/WX/WSX/ST/GT only:</i><br />
      bit 7: Firmware switch status (0=on, 1=off) <em>(read-only)</em></td>
</tr>
</table>


<pre>
	LD	A,8
	OUT 	(040H),A	;out the manufacturer code 8 (Panasonic) to I/O port 40h
	IN	A,(040H)	;read the value you have just written
	CPL			;complement all bits of the value
	CP	8		;if it does not match the value you originally wrote,
	JR	NZ,Not_WX	;it is not a WX/WSX/FX.
	XOR	A		;write 0 to I/O port 41h
	OUT	(041H),A	;and the mode changes to high-speed clock
</pre>

So you can check if certain extensions are available and ready to be accessed by reading back the value you just wrote to the device ID register. If that value is not the complement of what you wrote, then the extensions are not present.



<h2 id="gfx9000">Graphics9000 / v9990</h2>

<p>The v9990 has 16 registers in total, covering the range #60-#6F. Only the first eight are used in the Graphics9000, ports #68-#6B are used in combination with an optional Kanji ROM extension, and the rest is left as reserve. In the Graphics9000, port #6F is mapped to the v7040 superimpose chip.</p>

<table>
<tr><th>Port range</th> <th>Description</th></tr>
<tr><td>#60</td> <td>VRAM data port</td></tr>
<tr><td>#61</td> <td>Palette data port</td></tr>
<tr><td>#62</td> <td>Command data port</td></tr>
<tr><td>#63</td> <td>Register data port</td></tr>
<tr><td>#64</td> <td>Register select port <em>(write only)</em></td></tr>
<tr><td>#65</td> <td>Status port <em>(read only)</em></td></tr>
<tr><td>#66</td> <td>Interrupt flag port</td></tr>
<tr><td>#67</td> <td>System control port <em>(write only)</em></td></tr>
<tr><td>#68-#69</td> <td>Primary standard Kanji ROM address port <em>(write only) (not used in Gfx9000)</em></td></tr>
<tr><td>#69</td> <td>Primary standard Kanji ROM data port <em>(read only) (not used in Gfx9000)</em></td></tr>
<tr><td>#6A-#6B</td> <td>Secondary standard Kanji ROM address port <em>(write only) (not used in Gfx9000)</em></td></tr>
<tr><td>#6B</td> <td>Secondary standard Kanji ROM data port <em>(read only) (not used in Gfx9000)</em></td></tr>
<tr><td>#6C-#6E</td> <td>Reserved</td></tr>
<tr><td>#6F</td> <td>v7040 superimpose chip <em>(write only)</em> <em>(both Gfx9000 and Video9000)</em></td></tr>
</table>

<p><em>Important note:</em> for correct behaviour, all Gfx9000 applications should initialize by writing 0 to port #6F (the v7040 superimpose chip), and then wait a frame before accessing the Gfx9000 again. Not ensuring this  register has the value 0 written to it will cause the Gfx9000 output to be blurred occasionally. On exit, Gfx9000 applications should write #10 to port #6F as a courtesy to Video9000 owners.</p>

<p>Refer to the <a href="/resources/#v9990">Video9000 manual</a>, page 13, for more (Video9000-specific) details about the v7040 chip.</p>


<h2 id="rs232">RS232C UART (8251) / timer (8253)</h2>

<p>These are the functions of the I/O registers:</p>
<table>
  <tr>
    <th>Port</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>#80</td>
    <td>i-8251 data transmission</td>
  </tr>
  <tr>
    <td>#81</td>
    <td>i-8251 command / status register</td>
  </tr>
  <tr>
    <td>#82 (read)</td>
    <td>i-8251 connection state</td>
  </tr>
  <tr>
    <td>#83 (write)</td>
    <td>i-8251 interrupt mask</td>
  </tr>
  <tr>
    <td>#84</td>
    <td>i-8253 counter 0</td>
  </tr>
  <tr>
    <td>#85</td>
    <td>i-8253 counter 1</td>
  </tr>
  <tr>
    <td>#86</td>
    <td>i-8253 counter 2</td>
  </tr>
  <tr>
    <td>#87 (write)</td>
    <td>i-8253 control register</td>
  </tr>
</table>

<h2 id="vdp">VDP / Video Display Processor / TMS9918A / v9938 / v9958</h2>

<p>These are the I/O registers for accessing the standard MSX VDPs:</p>
<table>
  <tr>
    <th>Port range</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>#98</td>
    <td>VRAM data read/write port</td>
  </tr>
  <tr>
    <td>#99 (write)</td>
    <td>VDP register write port (bit 7=1 in second write)<br />
      VRAM address register (bit 7=0 in second write, bit 6: read/write access (0=read))</td>
  </tr>
  <tr>
    <td>#99 (read)</td>
    <td>Status register read port</td>
  </tr>
  <tr>
    <td>#9A</td>
    <td>Palette access port <em>(only v9938/v9958)</em></td>
  </tr>
  <tr>
    <td>#9B</td>
    <td>Indirect register access port <em>(only v9938/v9958)</em></td>
  </tr>
</table>

<p>See the <a href="/resources/#video">TMS9918, v9938 and v9958 application manuals</a>
for more details.</p>


<h2 id="psg">PSG / AY-3-8910</h2>

<p>These are the I/O registers for accessing the MSX PSG (Programmable Sound Generator):</p>

<table>
  <tr>
    <th>Port range</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>#A0 (write)</td>
    <td>Register write port</td>
  </tr>
  <tr>
    <td>#A1 (write)</td>
    <td>Value write port</td>
  </tr>
  <tr>
    <td>#A2 (read)</td>
    <td>Value read port</td>
  </tr>
</table>

<p>The following table describes the registers of the PSG:</p>

<table>
  <tr>
    <th>Register(s)</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>0-5</td>
    <td>Tone generator control</td>
  </tr>
  <tr>
    <td>6</td>
    <td>Noise generator control</td>
  </tr>
  <tr>
    <td>7</td>
    <td>Mixer control-I/O enable<br />
      <em>Important note:</em> bit 6 <strong>must</strong> be 0, and bit 7 <strong>must</strong> be 1. Setting different values can cause damage on some systems. Safest approach is to just not touch them and read them first before writing a new value.
    </td>
  </tr>
  <tr>
    <td>8-10</td>
    <td>Amplitude control</td>
  </tr>
  <tr>
    <td>11-13</td>
    <td>Envelope generator control</td>
  </tr>
  <tr>
    <td>14-15</td>
    <td>I/O ports A &amp; B</td>
  </tr>
</table>

<p>See the <a href="/resources/#psg">AY-3-8910 and YM2149 application manuals</a>
for more details.</p>

<h3 id="psgioports">Additional PSG I/O ports A &amp; B</h3>

<p>The PSG has two additional I/O ports in registers 14 and 15. They are used by
the MSX standard for several device I/O related tasks, comparable with the PPI
and working more or less in conjunction with it. These are the functions:</p>

<table>
  <caption>PSG I/O port A (r#14) – <em>read-only</em></caption>
  <tr>
    <th>Bit</th>
    <th>Description</th>
  <th>Comment</th>
  </tr>
  <tr>
    <td>0</td>
    <td>Input joystick pin 1</td>
  <td>(up)</td>
  </tr>
  <tr>
    <td>1</td>
    <td>Input joystick pin 2</td>
  <td>(down)</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Input joystick pin 3</td>
  <td>(left)</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Input joystick pin 4</td>
  <td>(right)</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Input joystick pin 6</td>
  <td>(trigger A) </td>
  </tr>
  <tr>
    <td>5</td>
    <td>Input joystick pin 7</td>
  <td>(trigger B) </td>
  </tr>
  <tr>
    <td>6</td>
    <td>Japanese keyboard layout bit</td>
  <td>(1=JIS, 0=ANSI) </td>
  </tr>
  <tr>
    <td>7</td>
    <td>Cassette input signal</td>
  <td></td>
  </tr>
</table>

<table>
  <caption>PSG I/O port B (r#15) – <em>write/read</em></caption>
  <tr>
    <th>Bit</th>
    <th>Description</th>
  <th>Comment</th>
  </tr>
  <tr>
    <td>0</td>
    <td>Output joystick port 1, pin 6</td>
  <td>(set 1 for input)</td>
  </tr>
  <tr>
    <td>1</td>
    <td>Output joystick port 1, pin 7</td>
  <td>(set 1 for input)</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Output joystick port 2, pin 6</td>
  <td>(set 1 for input)</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Output joystick port 2, pin 7</td>
  <td>(set 1 for input)</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Output joystick port 1, pin 8</td>
  <td></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Output joystick port 2, pin 8</td>
  <td></td>
  </tr>
  <tr>
    <td>6</td>
    <td>Joystick input selection, for r#14 inputs</td>
  <td>(1=port 2)</td>
  </tr>
  <tr>
    <td>7</td>
    <td>Kana led control</td>
  <td>(1=off)</td>
  </tr>
</table>


<h2 id="pausetr">Pause / R800 info (turboR)</h2>

<p>This I/O register is only present on MSX turboR computers. Its function differs depending on whether you are reading or writing.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#A7 (read)</td>
  <td>bit 0: pause switch (1=on)<br />
      Works only in R800 mode (connected to WAIT of Z80)</td>
</tr>
<tr>
  <td>#A7 (write)</td>
  <td>bit 0: pause LED (1=on)<br />
      bit 7: R800 LED (1=on)<br />
      Mirror address is #FCB1 in the system RAM.</td>
</tr>
</table>



<h2 id="ppi">PPI / Programmable Peripheral Interface / 8255</h2>

<p>The PPI controls a number of things in the MSX system, ranging from slot selection through cassette output to interfacing with the keyboard.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
	<td>#A8</td>
	<td>PPI-register A<br />
	Primary slot select register.</td>
</tr>
<tr>
	<td>#A9 (read)</td>
	<td>PPI-register B<br />
	Keyboard matrix row input register.</td>
</tr>
<tr>
	<td>#AA</td>
	<td>PPI-register C<br />
	Keyboard and cassette interface.</td>
</tr>
<tr>
	<td>#AB (write)</td>
	<td>Command register.</td>
</tr>
</table>

<p>Below, we will describe the registers in more detail.</p>

<h3 id="ppi-a">Primary slot select register</h3>

<p>The 64k of MSX main memory is divided into four blocks of 16k, referred to as <dfn>pages</dfn>. This register controls which primary slot will be mapped to each page of memory.</p>

<table>
	<caption>PPI-register A (#A8)</caption>
	<tr>
		<th>Bits</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>0-1</td>
		<td>Slot for page 0 (#0000-#3FFF)</td>
	</tr>
	<tr>
		<td>2-3</td>
		<td>Slot for page 1 (#4000-#7FFF)</td>
	</tr>
	<tr>
		<td>4-5</td>
		<td>Slot for page 2 (#8000-#BFFF)</td>
	</tr>
	<tr>
		<td>6-7</td>
		<td>Slot for page 3 (#C000-#FFFF)</td>
	</tr>
</table>

<p>This register can both be written and be read.</p>

<p>Additionally, each primary slot can and often will be expanded into four secondary slots, also known as <dfn>subslots</dfn>. The subslot select register can be found at memory address #FFFF. For more details, go to the <a href="#subslot">secondary slot select register</a>.</p>


<h3 id="ppi-bc">Misc PPI controls</h3>

<p>With PPI register C you can access the keyboard (including CAPS LED and key click), and control the cassette interface. The precise function of each bit is described in the table below:</p>

<table>
	<caption>PPI-register C (#AA)</caption>
	<tr>
		<th>Bits</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>0-3</td>
		<td>Keyboard matrix row select register. <br />
		Matrix row can be read from PPI-register B (#A9).</td>
	</tr>
	<tr>
		<td>4</td>
		<td>Cassette motor control. 1 = off.</td>
	</tr>
	<tr>
		<td>5</td>
		<td>Cassette write signal. 1 = high.</td>
	</tr>
	<tr>
		<td>6</td>
		<td>Keyboard CAPS LED. 1 = off.</td>
	</tr>
	<tr>
		<td>7</td>
		<td>1-bit key click sound output. 1 = high.</td>
	</tr>
</table>

<p>More information about keyboard matrices can be found in the <a href="/articles/keymatrix.php">keyboard matrices</a> article.</p>


<h3 id="ppi-cmd">PPI command register</h3>

<p>With this write-only register you can set or reset individual bits in PPI-register C. This is the recommended (fastest) method to use when you want to modify bits 4-7.</p>

<table>
	<caption>PPI command register (#AB)</caption>
	<tr>
		<th>Bits</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>0</td>
		<td>Value to set.</td>
	</tr>
	<tr>
		<td>1-3</td>
		<td>Bit no. within PPI-register C.</td>
	</tr>
	<tr>
		<td>4-6</td>
		<td>Not used.</td>
	</tr>
	<tr>
		<td>7</td>
		<td>Must be 0.</td>
	</tr>
</table>





<h2 id="s1990">S1990 controller (turboR)</h2>

<p>Through these ports you can access the turboR’s S1990 bus controller.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#E4</td>
  <td>Register select port</td>
</tr>
<tr>
  <td>#E5</td>
  <td>Register access port</td>
</tr>
<tr>
  <td>#E6-#E7 (read)</td>
  <td>16-bit counter, little endian, running at 255682 Hz</td>
</tr>
<tr>
  <td>#E6 (write)</td>
  <td>16-bit counter reset (write to reset)</td>
</tr>
</table>

<p></p>

<table>
  <caption>S1990 registers</caption>
<tr>
  <th>Register</th>
  <th>Description</th>
</tr>
<tr>
  <td>5</td>
  <td>bit 6: Switch (0=right, 1=left)</td>
</tr>
<tr>
  <td>6</td>
  <td>bit 5: Processor mode (0=R800, 1=Z80)<br />
      bit 6: ROM mode (0=DRAM, 1=ROM)</td>
</tr>
<tr>
  <td>14</td>
  <td>Contains last but one byte written to memory</td>
</tr>
<tr>
  <td>15</td>
  <td>Contains last byte written to memory</td>
</tr>
</table>

<p>It is rumoured the turboR R800 mode’s VDP slowdown can be disabled through one of the S1990’s registers. How, however, is still a mystery ^_^.</p>



<h2 id="sysflags">System flags</h2>

<p>This register is basically a simple memory cell which is preserved after a reset. It is used on the MSX2+ to differentiate between a hard boot (power on) and a soft boot (reset button) by writing a value to it during the boot routine, and check for that value everytime the computer starts. On the turboR, it also indicates whether the Z80 or the R800 has to boot.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#F4</td>
  <td>System flags, preserved after reset<br />
      bit 5: CPU boot mode (1=R800)<br />
      bit 7: Boot method (1=soft boot, doesn’t show start logo)</td>
</tr>
</table>



<h2 id="mmapper">Memory Mapper registers</h2>

<p>The Z80 used in the MSX has 64k of addressable memory. To be able to use more memory, memory mappers are used in MSX2 computers and above. A memory mapper divides the 64k of RAM into four 16k blocks called <dfn>pages</dfn>, into which up to 256 different memory <dfn>segments</dfn> can be mapped. Note that these segments are shared – it is possible to map a segment used in page 0 into page 1 as well.</p>

<table>
<tr>
  <th>Port range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#FC (write)</td>
  <td>Mapper segment for page 0 (#0000-#3FFF)</td>
</tr>
<tr>
  <td>#FD (write)</td>
  <td>Mapper segment for page 1 (#4000-#7FFF)</td>
</tr>
<tr>
  <td>#FE (write)</td>
  <td>Mapper segment for page 2 (#8000-#BFFF)</td>
</tr>
<tr>
  <td>#FF (write)</td>
  <td>Mapper segment for page 3 (#C000-#FFFF)</td>
</tr>
</table>

<p>Note that reading those registers is <strong>not</strong> reliable, and should not be done.</p>

<p>Detecting the amount of available memory can be done by writing a unique value into all mapper pages and iterating through them until you see repetition. If the repetition e.g. occurs after 8 pages, there is 128k of RAM available. Usually, you will want to do this with interrupts disabled and also want to restore the original values.</p>

<p>Note about DOS2: MSX-DOS2 provides a set of <a href="/resources/dos2_environment.php#c5">convenient memory management routines</a>. In a DOS2 environment, you should <strong>not</strong> access the mapper registers directly, as this will cause various problems. The routines DOS2 offers are very fast, and there should be no reason not to use them.</p>



<h2 id="a1fm-modem">Panasonic FS-A1FM Modem ROM</h2>

<p>The Panasonic FS-A1FM computer has a built-in modem with firmware. On the back of the computer, there is a switch to enable the modem software. This firmware, including a memory-mapped I/O area in the #7FC0-#7FFF range, is located in slot 3-1. I do not know if there is a detection method.</p>

<table>
<tr>
  <th>Address range</th>
  <th>Description</th>
</tr>
<tr>
  <td>#7FC4</td>
  <td>bits 0-3: mapper for #4000-#5FFF area (uses slot 3-3 ROM pages #00-#0F)<br/>
      bits 4-7: mapper for #6000-#7FFF area (RAM, don’t know how much)</td>
</tr>
<tr>
  <td>#7FC6</td>
  <td>bit 2: modem switch on back of case setting</td>
</tr>
<tr>
  <td>#7FF9</td>
  <td>bit 2: set activates ports 7FF0-7FF7</td>
</tr>
</table>



<h2 id="subslot">Secondary slot select register</h2>

<p>Each <a href="#ppi-a">primary slot</a> can and often will be expanded into four secondary slots, also known as <dfn>subslots</dfn>. Just like a primary slot, a subslot can also be mapped to one of the four pages in main memory.</p>

<p>The subslot select register can be found at memory address #FFFF, and looks as follows:</p>

<table>
	<tr>
		<th>Bits</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>0-1</td>
		<td>Subslot for page 0 (#0000-#3FFF)</td>
	</tr>
	<tr>
		<td>2-3</td>
		<td>Subslot for page 1 (#4000-#7FFF)</td>
	</tr>
	<tr>
		<td>4-5</td>
		<td>Subslot for page 2 (#8000-#BFFF)</td>
	</tr>
	<tr>
		<td>6-7</td>
		<td>Subslot for page 3 (#C000-#FFFF)</td>
	</tr>
</table>

<p>When this register is read, it returns the complement of the previous value written.</p>

<p>It is important to note that the subslot register <strong>only</strong> affects the primary slot which is selected in page 3 (which the #FFFF address is in). This makes selecting a different subslot in e.g. page 1 a little less than trivial when page 1 doesn’t have the same primary slot as page 3. This involves switching page 1’s slot into page 3, selecting the desired subslot, and switching back the original slot into page 3. All this must be done with interrupts disabled and, logically, from an address not in the #C000-#FFFF range. Don’t forget to take care of the stack as well.</p>

<p>Usually it will be easier to use the BIOS-provided slot select routines (e.g. <a href="/resources/msxbios.php#ENASLT">ENASLT</a> or its <a href="/resources/dos2_environment.php#c2_3">DOS equivalent</a>). While on the subject of the BIOS, the easiest method to determine whether a slot is expanded is to read out the <a href="/resources/msxsystemvars.php#EXPTBL">EXPTBL</a> system variables. Also, the BIOS maintains a mirror of the value of each primary slot’s subslot register in the <a href="/resources/msxsystemvars.php#SLTTBL">SLTTBL</a> system variables.</p>



<p class="signed">Grauw</p>




<?php addFooter(); ?>
</body>
</html>
