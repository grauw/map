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



<h1>MSX System Variables</h1>

<p>This is an overview of the system variables which you can use. They are official, unless mentioned otherwise.</p>

<p>VDP Registers: <a href="#RG0SAV">R#0-R#7</a>, <a href="#RG8SAV">R#8-R#23</a>, <a href="#RG25SAV">R#25-R#27</a>, R#32-R#45 (not mirrored in system ram), <a href="#STATFL">S#0</a>.</p>



<h1>MSX System Variables located in Main ROM</h1>

<table width="100%">
<colgroup>
  <col width="10%" />
  <col width="7%" />
  <col width="7%" />
  <col />
</colgroup>
<tr><th>Name</th><th>Address</th><th>Length</th><th>Description</th></tr>

<tr id="CGTABL">
  <td>CGTABL</td>
  <td>#0004</td>
  <td>2</td>
  <td>Base address of the MSX character set in ROM</td>
</tr>

<tr id="VDP.DR">
  <td>VDP.DR</td>
  <td>#0006</td>
  <td>1</td>
  <td>Base port address for VDP data read</td>
</tr>

<tr id="VDP.DW">
  <td>VDP.DW</td>
  <td>#0007</td>
  <td>1</td>
  <td>Base port address for VDP data write</td>
</tr>

<tr id="msxnl1">
  <td></td>
  <td>#002B</td>
  <td>1</td>
  <td>Basic ROM version
<pre>
7 6 5 4 3 2 1 0
| | | | +-+-+-+-- Character set
| | | |           0 = Japanese, 1 = International, 2=Korean
| +-+-+---------- Date format
|                 0 = Y-M-D, 1 = M-D-Y, 2 = D-M-Y
+---------------- Default interrupt frequency
                  0 = 60Hz, 1 = 50Hz
</pre></td>
</tr>

<tr id="msxnl2">
  <td></td>
  <td>#002C</td>
  <td>1</td>
  <td>Basic ROM version
<pre>
7 6 5 4 3 2 1 0
| | | | +-+-+-+-- Keyboard type
| | | |           0 = Japanese, 1 = International
| | | |           2 = French (AZERTY), 3 = UK, 4 = German (DIN)
+-+-+-+---------- Basic version
                  0 = Japanese, 1 = International
</pre></td>
</tr>

<tr id="msxver">
  <td></td>
  <td>#002D</td>
  <td>1</td>
  <td>MSX version number<br />
      0 = MSX 1<br />
      1 = MSX 2<br />
      2 = MSX 2+<br />
      3 = MSX turbo R</td>
</tr>

<tr id="msxmid">
  <td></td>
  <td>#002E</td>
  <td>1</td>
  <td>Bit 0: if 1 then MSX-MIDI is present internally (MSX&#160;turbo&#160;R only)</td>
</tr>

<tr>
  <td></td>
  <td>#002F</td>
  <td>1</td>
  <td>Reserved</td>
</tr>
</table>






<h1>MSX System Variables located in Sub ROM</h1>

<table width="100%">
<colgroup>
  <col width="10%" />
  <col width="7%" />
  <col width="7%" />
  <col />
</colgroup>
<tr><th>Name</th><th>Address</th><th>Length</th><th>Description</th></tr>

<tr id="subromid">
  <td></td>
  <td>#0000</td>
  <td>2</td>
  <td>String "CD", identification of MSX Sub ROM</td>
</tr>

<tr id="msxlogo">
  <td></td>
  <td>#0002</td>
  <td>2</td>
  <td>Execution address for the startup screen on MSX&#160;2, MSX&#160;2+
      or MSX&#160;turbo&#160;R. This is unofficial and undocumented.</td>
</tr>
</table>




<h1>MSX-DOS (DiskROM) System Variables located in RAM</h1>

<p>These addresses are only initialized when a DiskROM is present (e.g. when the machine has a diskdrive or a harddisk interface connected).</p>

<table width="100%">
<colgroup>
  <col width="10%" />
  <col width="7%" />
  <col width="7%" />
  <col />
</colgroup>
<tr><th>Name</th><th>Address</th><th>Length</th><th>Description</th></tr>

<tr id="RAMAD0">
  <td>RAMAD0</td>
  <td>#F341</td>
  <td>1</td>
  <td>Slot address of RAM in page 0 (DOS)</td>
</tr>

<tr id="RAMAD1">
  <td>RAMAD1</td>
  <td>#F342</td>
  <td>1</td>
  <td>Slot address of RAM in page 1 (DOS)</td>
</tr>

<tr id="RAMAD2">
  <td>RAMAD2</td>
  <td>#F343</td>
  <td>1</td>
  <td>Slot address of RAM in page 2 (DOS/BASIC)</td>
</tr>

<tr id="RAMAD3">
  <td>RAMAD3</td>
  <td>#F344</td>
  <td>1</td>
  <td>Slot address of RAM in page 3 (DOS/BASIC)</td>
</tr>

<tr>
  <td></td>
  <td>#F348</td>
  <td>1</td>
  <td>Slot address of the main DiskROM</td>
</tr>
</table>





<h1>MSX System Variables located in RAM</h1>

<p>This is the start of the MSX BIOS system area.</p>

<table width="100%">
<colgroup>
  <col width="10%" />
  <col width="7%" />
  <col width="7%" />
  <col />
</colgroup>
<tr><th>Name</th><th>Address</th><th>Length</th><th>Description</th></tr>

<tr id="RDPRIM">
  <td>RDPRIM</td>
  <td>#F380</td>
  <td>5</td>
  <td>Routine that reads from a primary slot</td>
</tr>

<tr id="WRPRIM">
  <td>WRPRIM</td>
  <td>#F385</td>
  <td>7</td>
  <td>Routine that writes to a primary slot</td>
</tr>

<tr id="CLPRIM">
  <td>CLPRIM</td>
  <td>#F38C</td>
  <td>14</td>
  <td>Routine that calls a routine in a primary slot</td>
</tr>

<tr id="USRTAB">
  <td rowspan="10">USRTAB</td>
  <td>#F39A</td>
  <td>2</td>
  <td>Address to call with Basic USR0</td>
</tr>

<tr>
  <td>#F39C</td>
  <td>2</td>
  <td>Address to call with Basic USR1</td>
</tr>

<tr>
  <td>#F39E</td>
  <td>2</td>
  <td>Address to call with Basic USR2</td>
</tr>

<tr>
  <td>#F3A0</td>
  <td>2</td>
  <td>Address to call with Basic USR3</td>
</tr>

<tr>
  <td>#F3A2</td>
  <td>2</td>
  <td>Address to call with Basic USR4</td>
</tr>

<tr>
  <td>#F3A4</td>
  <td>2</td>
  <td>Address to call with Basic USR5</td>
</tr>

<tr>
  <td>#F3A6</td>
  <td>2</td>
  <td>Address to call with Basic USR6</td>
</tr>

<tr>
  <td>#F3A8</td>
  <td>2</td>
  <td>Address to call with Basic USR7</td>
</tr>

<tr>
  <td>#F3AA</td>
  <td>2</td>
  <td>Address to call with Basic USR8</td>
</tr>

<tr>
  <td>#F3AC</td>
  <td>2</td>
  <td>Address to call with Basic USR9</td>
</tr>

<tr id="LINL40">
  <td>LINL40</td>
  <td>#F3AE</td>
  <td>1</td>
  <td>Width for SCREEN 0 (default 37)</td>
</tr>

<tr id="LINL32">
  <td>LINL32</td>
  <td>#F3AF</td>
  <td>1</td>
  <td>Width for SCREEN 1 (default 29)</td>
</tr>

<tr id="LINLEN">
  <td>LINLEN</td>
  <td>#F3B0</td>
  <td>1</td>
  <td>Width for the current text mode</td>
</tr>

<tr id="CRTCNT">
  <td>CRTCNT</td>
  <td>#F3B1</td>
  <td>1</td>
  <td>Number of lines on screen</td>
</tr>

<tr id="CLMLST">
  <td>CLMLST</td>
  <td>#F3B2</td>
  <td>1</td>
  <td>Column space. It’s uncertain what this address actually stores</td>
</tr>

<tr id="TXTNAM">
  <td>TXTNAM</td>
  <td>#F3B3</td>
  <td>2</td>
  <td>BASE(0) - SCREEN 0 name table</td>
</tr>

<tr id="TXTCOL">
  <td>TXTCOL</td>
  <td>#F3B5</td>
  <td>2</td>
  <td>BASE(1) - SCREEN 0 color table</td>
</tr>

<tr id="TXTCGP">
  <td>TXTCGP</td>
  <td>#F3B7</td>
  <td>2</td>
  <td>BASE(2) - SCREEN 0 character pattern table</td>
</tr>

<tr id="TXTATR">
  <td>TXTATR</td>
  <td>#F3B9</td>
  <td>2</td>
  <td>BASE(3) - SCREEN 0 Sprite Attribute Table</td>
</tr>

<tr id="TXTPAT">
  <td>TXTPAT</td>
  <td>#F3BB</td>
  <td>2</td>
  <td>BASE(4) - SCREEN 0 Sprite Pattern Table</td>
</tr>

<tr id="T32NAM">
  <td>T32NAM</td>
  <td>#F3B3</td>
  <td>2</td>
  <td>BASE(5) - SCREEN 1 name table</td>
</tr>

<tr id="T32COL">
  <td>T32COL</td>
  <td>#F3B5</td>
  <td>2</td>
  <td>BASE(6) - SCREEN 1 color table</td>
</tr>

<tr id="T32CGP">
  <td>T32CGP</td>
  <td>#F3B7</td>
  <td>2</td>
  <td>BASE(7) - SCREEN 1 character pattern table</td>
</tr>

<tr id="T32ATR">
  <td>T32ATR</td>
  <td>#F3B9</td>
  <td>2</td>
  <td>BASE(8) - SCREEN 1 sprite attribute table</td>
</tr>

<tr id="T32PAT">
  <td>T32PAT</td>
  <td>#F3BB</td>
  <td>2</td>
  <td>BASE(9) - SCREEN 1 sprite pattern table</td>
</tr>

<tr id="GRPNAM">
  <td>GRPNAM</td>
  <td>#F3B3</td>
  <td>2</td>
  <td>BASE(10) - SCREEN 2 name table</td>
</tr>

<tr id="GRPCOL">
  <td>GRPCOL</td>
  <td>#F3B5</td>
  <td>2</td>
  <td>BASE(11) - SCREEN 2 color table</td>
</tr>

<tr id="GRPCGP">
  <td>GRPCGP</td>
  <td>#F3B7</td>
  <td>2</td>
  <td>BASE(12) - SCREEN 2 character pattern table</td>
</tr>

<tr id="GRPATR">
  <td>GRPATR</td>
  <td>#F3B9</td>
  <td>2</td>
  <td>BASE(13) - SCREEN 2 sprite attribute table</td>
</tr>

<tr id="GRPPAT">
  <td>GRPPAT</td>
  <td>#F3BB</td>
  <td>2</td>
  <td>BASE(14) - SCREEN 2 sprite pattern table</td>
</tr>

<tr id="MLTNAM">
  <td>MLTNAM</td>
  <td>#F3B3</td>
  <td>2</td>
  <td>BASE(15) - SCREEN 3 name table</td>
</tr>

<tr id="MLTCOL">
  <td>MLTCOL</td>
  <td>#F3B5</td>
  <td>2</td>
  <td>BASE(16) - SCREEN 3 color table</td>
</tr>

<tr id="MLTCGP">
  <td>MLTCGP</td>
  <td>#F3B7</td>
  <td>2</td>
  <td>BASE(17) - SCREEN 3 character pattern table</td>
</tr>

<tr id="MLTATR">
  <td>MLTATR</td>
  <td>#F3B9</td>
  <td>2</td>
  <td>BASE(18) - SCREEN 3 sprite attribute table</td>
</tr>

<tr id="MLTPAT">
  <td>MLTPAT</td>
  <td>#F3BB</td>
  <td>2</td>
  <td>BASE(19) - SCREEN 3 sprite pattern table</td>
</tr>

<tr id="CLIKSW">
  <td>CLIKSW</td>
  <td>#F3DB</td>
  <td>1</td>
  <td>=0 when key press click disabled<br />
      =1 when key press click enabled<br />
      SCREEN ,,n will write to this address</td>
</tr>

<tr id="CSRY">
  <td>CSRY</td>
  <td>#F3DC</td>
  <td>1</td>
  <td>Current row-position of the cursor</td>
</tr>

<tr id="CSRX">
  <td>CSRX</td>
  <td>#F3DD</td>
  <td>1</td>
  <td>Current column-position of the cursor</td>
</tr>

<tr id="CNSDFG">
  <td>CNSDFG</td>
  <td>#F3DE</td>
  <td>1</td>
  <td>=0 when function keys are not displayed<br />
      =1 when function keys are displayed</td>
</tr>

<tr id="RG0SAV">
  <td>RG0SAV</td>
  <td>#F3DF</td>
  <td>1</td>
  <td>Content of VDP(0) register (R#0)</td>
</tr>

<tr id="RG1SAV">
  <td>RG1SAV</td>
  <td>#F3E0</td>
  <td>1</td>
  <td>Content of VDP(1) register (R#1)</td>
</tr>

<tr id="RG2SAV">
  <td>RG2SAV</td>
  <td>#F3E1</td>
  <td>1</td>
  <td>Content of VDP(2) register (R#2)</td>
</tr>

<tr id="RG3SAV">
  <td>RG3SAV</td>
  <td>#F3E2</td>
  <td>1</td>
  <td>Content of VDP(3) register (R#3)</td>
</tr>

<tr id="RG4SAV">
  <td>RG4SAV</td>
  <td>#F3E3</td>
  <td>1</td>
  <td>Content of VDP(4) register (R#4)</td>
</tr>

<tr id="RG5SAV">
  <td>RG5SAV</td>
  <td>#F3E4</td>
  <td>1</td>
  <td>Content of VDP(5) register (R#5)</td>
</tr>

<tr id="RG6SAV">
  <td>RG6SAV</td>
  <td>#F3E5</td>
  <td>1</td>
  <td>Content of VDP(6) register (R#6)</td>
</tr>

<tr id="RG7SAV">
  <td>RG7SAV</td>
  <td>#F3E6</td>
  <td>1</td>
  <td>Content of VDP(7) register (R#7)</td>
</tr>

<tr id="STATFL">
  <td>STATFL</td>
  <td>#F3E7</td>
  <td>1</td>
  <td>Content of VDP(8) status register (S#0)</td>
</tr>

<tr id="TRGFLG">
  <td>TRGFLG</td>
  <td>#F3E8</td>
  <td>1</td>
  <td>Information about trigger buttons and space bar state
<pre>
7 6 5 4 3 2 1 0
| | | |       +-- Space bar, trig(0) (0 = pressed)
| | | +---------- Stick 1, Trigger 1 (0 = pressed)
| | +------------ Stick 1, Trigger 2 (0 = pressed)
| +-------------- Stick 2, Trigger 1 (0 = pressed)
+---------------- Stick 2, Trigger 2 (0 = pressed)
</pre></td>
</tr>

<tr id="FORCLR">
  <td>FORCLR</td>
  <td>#F3E9</td>
  <td>1</td>
  <td>Foreground color</td>
</tr>

<tr id="BAKCLR">
  <td>BAKCLR</td>
  <td>#F3EA</td>
  <td>1</td>
  <td>Background color</td>
</tr>

<tr id="BDRCLR">
  <td>BDRCLR</td>
  <td>#F3EB</td>
  <td>1</td>
  <td>Border color</td>
</tr>

<tr id="MAXUPD">
  <td>MAXUPD</td>
  <td>#F3EC</td>
  <td>3</td>
  <td>Jump instruction used by Basic LINE command. The routines used are:
      <a href="/resources/msxbios.php#RIGHTC">RIGHTC</a>,
      <a href="/resources/msxbios.php#LEFTC">LEFTC</a>,
      <a href="/resources/msxbios.php#UPC">UPC</a> and
      <a href="/resources/msxbios.php#DOWNC">DOWNC</a></td>
</tr>

<tr id="MINUPD">
  <td>MINUPD</td>
  <td>#F3EF</td>
  <td>3</td>
  <td>Jump instruction used by Basic LINE command. The routines used are:
      <a href="/resources/msxbios.php#RIGHTC">RIGHTC</a>,
      <a href="/resources/msxbios.php#LEFTC">LEFTC</a>,
      <a href="/resources/msxbios.php#UPC">UPC</a> and
      <a href="/resources/msxbios.php#DOWNC">DOWNC</a></td>
</tr>

<tr id="ATRBYT">
  <td>ATRBYT</td>
  <td>#F3F2</td>
  <td>1</td>
  <td>Attribute byte (for graphical routines it’s used to read the color)</td>
</tr>

<tr id="QUEUES">
  <td>QUEUES</td>
  <td>#F3F3</td>
  <td>2</td>
  <td>Address of the queue table</td>
</tr>

<tr id="FRCNEW">
  <td>FRCNEW</td>
  <td>#F3F5</td>
  <td>1</td>
  <td>CLOAD flag<br />
      =0 when CLOAD<br />
      =255 when CLOAD?</td>
</tr>

<tr id="SCNCNT">
  <td>SCNCNT</td>
  <td>#F3F6</td>
  <td>1</td>
  <td>Key scan timing<br />
      When it’s zero, the key scan routine will scan for pressed keys so
      characters can be written to the keyboard buffer</td>
</tr>

<tr id="REPCNT">
  <td>REPCNT</td>
  <td>#F3F7</td>
  <td>1</td>
  <td>This is the key repeat delay counter<br />
      When it reaches zero, the key will repeat</td>
</tr>

<tr id="PUTPNT">
  <td>PUTPNT</td>
  <td>#F3F8</td>
  <td>2</td>
  <td>Address in the keyboard buffer where a character will be written</td>
</tr>

<tr id="GETPNT">
  <td>GETPNT</td>
  <td>#F3FA</td>
  <td>2</td>
  <td>Address in the keyboard buffer where the next character is read</td>
</tr>

<tr id="CS120">
  <td>CS120</td>
  <td>#F3FC</td>
  <td>5</td>
  <td>Cassette I/O parameters to use for 1200 baud</td>
</tr>

<tr id="CS240">
  <td>CS240</td>
  <td>#F401</td>
  <td>5</td>
  <td>Cassette I/O parameters to use for 2400 baud</td>
</tr>

<tr id="LOW">
  <td>LOW</td>
  <td>#F406</td>
  <td>2</td>
  <td>Signal delay when writing a 0 to tape</td>
</tr>

<tr id="HIGH">
  <td>HIGH</td>
  <td>#F408</td>
  <td>2</td>
  <td>Signal delay when writing a 1 to tape</td>
</tr>

<tr id="HEADER">
  <td>HEADER</td>
  <td>#F40A</td>
  <td>1</td>
  <td>Delay of tape header (sync.) block</td>
</tr>

<tr id="ASPCT1">
  <td>ASPCT1</td>
  <td>#F40B</td>
  <td>2</td>
  <td>Horizontal / Vertical aspect for CIRCLE command</td>
</tr>

<tr id="ASPCT2">
  <td>ASPCT2</td>
  <td>#F40D</td>
  <td>2</td>
  <td>Horizontal / Vertical aspect for CIRCLE command</td>
</tr>

<tr id="ENDPRG">
  <td>ENDPRG</td>
  <td>#F40F</td>
  <td>5</td>
  <td>Pointer for the RESUME NEXT command</td>
</tr>

<tr id="ERRFLG">
  <td>ERRFLG</td>
  <td>#F414</td>
  <td>1</td>
  <td>Basic Error code</td>
</tr>

<tr id="LPTPOS">
  <td>LPTPOS</td>
  <td>#F415</td>
  <td>1</td>
  <td>Position of the printer head<br />
      Is read by Basic function LPOS and used by LPRINT Basic command</td>
</tr>

<tr id="PRTFLG">
  <td>PRTFLG</td>
  <td>#F416</td>
  <td>1</td>
  <td>Printer output flag is read by
      <a href="/resources/msxbios.php#OUTDO">OUTDO</a><br />
      =0 to print to screen<br />
      =1 to print to printer</td>
</tr>

<tr id="NTMSXP">
  <td>NTMSXP</td>
  <td>#F417</td>
  <td>1</td>
  <td>Printer type is read by
      <a href="/resources/msxbios.php#OUTDO">OUTDO</a>.
      SCREEN ,,,n writes to this address<br />
      =0 for MSX printer<br />
      =1 for non-MSX printer</td>
</tr>

<tr id="RAWPRT">
  <td>RAWPRT</td>
  <td>#F418</td>
  <td>1</td>
  <td>Raw printer output is read by
     <a href="/resources/msxbios.php#OUTDO">OUTDO</a><br />
      =0 to convert tabs and unknown characters to spaces and
         remove graphical headers<br />
      =1 to send data just like it gets it</td>
</tr>

<tr id="VLZADR">
  <td>VLZADR</td>
  <td>#F419</td>
  <td>2</td>
  <td>Address of data that is temporarilly replaced by ‘O’ when Basic
      function VAL("") is running</td>
</tr>

<tr id="VLZDAT">
  <td>VLZDAT</td>
  <td>#F41B</td>
  <td>1</td>
  <td>Original value that was in the address pointed to with
      <a href="#VLZADR">VLZADR</a></td>
</tr>

<tr id="CURLIN">
  <td>CURLIN</td>
  <td>#F41C</td>
  <td>2</td>
  <td>Line number the Basic interpreter is working on, in direct mode
      it will be filled with #FFFF</td>
</tr>




<tr id="charsetslot">
  <td></td>
  <td>#F91F</td>
  <td>1</td>
  <td>Character set SlotID</td>
</tr>
<tr id="charsetaddr">
  <td></td>
  <td>#F920</td>
  <td>2</td>
  <td>Character set address</td>
</tr>





<tr id="EXBRSA">
  <td>EXBRSA</td>
  <td>#FAF8</td>
  <td>1</td>
  <td>Slot address of the SUBROM (EXtended Bios-Rom Slot Address)</td>
</tr>

<tr id="DRVINF">
  <td rowspan="8">DRVINF</td>
  <td>#FB21</td>
  <td>1</td>
  <td>Nr. of drives connected to disk interface 1</td>
</tr>
<tr>
  <td>#FB22</td>
  <td>1</td>
  <td>Slot address of disk interface 1</td>
</tr>
<tr>
  <td>#FB23</td>
  <td>1</td>
  <td>Nr. of drives connected to disk interface 2</td>
</tr>
<tr>
  <td>#FB24</td>
  <td>1</td>
  <td>Slot address of disk interface 2</td>
</tr>
<tr>
  <td>#FB25</td>
  <td>1</td>
  <td>Nr. of drives connected to disk interface 3</td>
</tr>
<tr>
  <td>#FB26</td>
  <td>1</td>
  <td>Slot address of disk interface 3</td>
</tr>
<tr>
  <td>#FB27</td>
  <td>1</td>
  <td>Nr. of drives connected to disk interface 4</td>
</tr>
<tr>
  <td>#FB28</td>
  <td>1</td>
  <td>Slot address of disk interface 4</td>
</tr>

<tr id="EXPTBL">
  <td rowspan="4">EXPTBL</td>
  <td>#FCC1</td>
  <td>1</td>
  <td>Slot 0: #80 = expanded, 0 = not expanded. Also slot address of the main BIOS-ROM.</td>
</tr>
<tr>
  <td>#FCC2</td>
  <td>1</td>
  <td>Slot 1: #80 = expanded, 0 = not expanded.</td>
</tr>
<tr>
  <td>#FCC3</td>
  <td>1</td>
  <td>Slot 2: #80 = expanded, 0 = not expanded.</td>
</tr>
<tr>
  <td>#FCC4</td>
  <td>1</td>
  <td>Slot 3: #80 = expanded, 0 = not expanded.</td>
</tr>

<tr id="SLTTBL">
  <td rowspan="4">SLTTBL</td>
  <td>#FCC5</td>
  <td>1</td>
  <td>Mirror of slot 0 secondary slot selection register.</td>
</tr>
<tr>
  <td>#FCC6</td>
  <td>1</td>
  <td>Mirror of slot 1 secondary slot selection register.</td>
</tr>
<tr>
  <td>#FCC7</td>
  <td>1</td>
  <td>Mirror of slot 2 secondary slot selection register.</td>
</tr>
<tr>
  <td>#FCC8</td>
  <td>1</td>
  <td>Mirror of slot 3 secondary slot selection register.</td>
</tr>


<tr>
  <td></td>
  <td>#FFFF (all slots)</td>
  <td>1</td>
  <td>Secondary slot select register. Reading returns the inverted previously written value.</td>
</tr>

</table>



<?php addFooter(); ?>
</body>
</html>