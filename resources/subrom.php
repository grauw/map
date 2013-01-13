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



<h1>MSX 2 SUBROM BIOS Entries</h1>

<p>These are additional BIOS routines which are available in the MSX 2 standard. No new subrom calls were introduced on the MSX 2+ / turbo R. They are located in the so-called SUBROM, which is an alternate BIOS page, switched when necessary. You can call the SUBROM by putting the jump address in register IX and then calling the BIOS routine <a href="/resources/msxbios.php#EXTROM">EXTROM</a> (#15F) or <a href="/resources/msxbios.php#SUBROM">SUBROM</a> (#15C). Please note that officially it is illegal to call the SUBROM using CALSLT because this will cause trouble with some DiskROMs. Therefore, it cannot be called directly from MSX-DOS environment. There is a workaround for that though, which is described in <a href="/sources/callbios.php">this article</a>.</p>


<h3 id="PAINT">PAINT (Basic!)</h3>
<pre>
Address  : #0069
Function : Paints graphical screen
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="PSET">PSET (Basic!) </h3>
<pre>
Address  : #006D
Function : Sets a point
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="ATRSCN">ATRSCN (Basic!)</h3>
<pre>
Address  : #0071
Function : Scans color attribute
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="GLINE">GLINE (Basic!)</h3>
<pre>
Address  : #0075
Function : Draws a line
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="DOBOXF">DOBOXF (Basic!)</h3>
<pre>
Address  : #0079
Function : Draws a filled box
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="DOLINE">DOLINE (Basic!)</h3>
<pre>
Address  : #007D
Function : Draws a line
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="BOXLIN">BOXLIN (Basic!)</h3>
<pre>
Address  : #0081
Function : Draws a box
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="DOGRPH">DOGRPH</h3>
<pre>
Address  : #0085
Function : Draws a line
Input    : BC, HL are start coordinates
           GXPOS, GYPOS are end-coordinates
           ATRBYT for attribute
           LOGOPR for logical operator
Registers: AF
</pre>


<h3 id="GRPPRT">GRPPRT</h3>
<pre>
Address  : #0089
Function : Places a character on graphic screen
Input    : A  - Character
           ATRBYT for attribute
           LOGOPR for logical operator
</pre>


<h3 id="SCALXY">SCALXY</h3>
<pre>
Address  : #008D
Function : Clip coordinates (till border of screen)
Input    : BC - X-position
           DE - Y-position
Output   : BC - X-position bordered
           DE - Y-position bordered
Registers: AF
</pre>


<h3 id="MAPXYC">MAPXYC</h3>
<pre>
Address  : #0091
Function : Converts an X,Y position to an address: and mask in CLOC and CMASK
Input    : BC - X-position
           DE - Y-position
Output   : HL - VRAM address: In SCREEN 3    (in CLOC too)
           A  - Mask          In SCREEN 3    (in CMASK too)
           HL - X-position In SCREEN 5-&gt;8 (in CLOC too)
           A  - Y-position In SCREEN 5-&gt;8 (in CMASK too)
Registers: F
</pre>


<h3 id="READC">READC</h3>
<pre>
Address  : #0095
Function : Reads attribute of pixel
Input    : X-position in CLOC
           Y-position in CMASK
Output   : A  - the attribute
Registers: AF
</pre>


<h3 id="SETATR">SETATR</h3>
<pre>
Address  : #0099
Function : Set attribute in ATRBYT
Input    : A  - attribute
Output   : C-flag set if attribute is wrong
Registers: F
</pre>


<h3 id="SETC">SETC</h3>
<pre>
Address  : #009D
Function : Set attribute of pixel
Input    : X-position in CLOC
           Y-position in CMASK
           Attribute-byte in ATRBYT
Registers: AF
</pre>


<h3 id="TRIGHT">TRIGHT</h3>
<pre>
Address  : #00A1
Function : Moves pixel to the right
Input    : X-position in CLOC
           Yposition in CMASK
Output   : New X-position in CLOC
           New Y-position in CMASK
           C-flag set if border of screen is reached
Registers: AF
Remark   : SCREEN 3 only
</pre>


<h3 id="RIGHTC">RIGHTC</h3>
<pre>
Address  : #00A5
Function : Moves pixel to the right
Input    : See TRIGHT
Output   : See TRIGHT (except for the C-flag remark)
Registers: AF
Remark   : SCREEN 3 only
</pre>


<h3 id="TLEFTC">TLEFTC</h3>
<pre>
Address  : #00A9
Function : Moves pixel to the left
Input    : See TRIGHT
Output   : See TRIGHT
Registers: AF
</pre>


<h3 id="LEFTC">LEFTC</h3>
<pre>
Address  : #00AD
Function : Moves pixel to the left
Input    : See RIGHTC
Output   : See RIGHTC
Registers: AF
Remark   : SCREEN 3 only
</pre>


<h3 id="TDOWNC">TDOWNC</h3>
<pre>
Address  : #00B1
Function : Moves pixel down
Input    : See TRIGHT
Output   : See TRIGHT
Registers: AF
</pre>


<h3 id="DOWNC">DOWNC</h3>
<pre>
Address  : #00B5
Function : Moves pixel down
Input    : See RIGHTC
Output   : See RIGHTC
Registers: AF
Remark   : SCREEN 3 only
</pre>


<h3 id="TUPC">TUPC</h3>
<pre>
Address  : #00B9
Function : Moves pixel up
Input    : See TRIGHT
Output   : See TRIGHT
Registers: AF
</pre>


<h3 id="UPC">UPC</h3>
<pre>
Address  : #00BD
Function : Moves pixel up
Input    : See RIGHTC
Output   : See RIGHTC
Registers: AF
Remark   : SCREEN 3 only
</pre>


<h3 id="SCANR">SCANR</h3>
<pre>
Address  : #00C1
Function : Scans pixels to the right
Input    : B  - 'Suspend'-flag
           C  - Border-counting
Output   : DE - Border-counting
           C  - 'Pixel-changed'-flag
Registers: All
</pre>


<h3 id="SCANL">SCANL</h3>
<pre>
Address  : #00C5
Function : Scans pixels to the left
Input    : DE - Border-counting
Output   : DE - Border-counting
           C  - 'Pixel-changed'-flag
Registers: All
</pre>


<h3 id="NVBXLN">NVBXLN</h3>
<pre>
Address  : #00C9
Function : Draws a box
Input    : BC - X start-position
           DE - Y-start-position
           X end-position in GXPOS
           Y-end-position in GYPOS
           Attribute in ATRBYT
           Logical operator in LOGOPR
Registers: All
</pre>


<h3 id="NVBXFL">NVBXFL </h3>
<pre>
Address  : #00CD
Function : Draws a filled box
Input    : See NVBXLN
Registers: All
</pre>


<h2>Double BIOS calls</h2>

<p>The following routines are called from the equally named calls in the MAIN ROM, and therefor the input and results will not be shown, nor will the register changes. For that, refer to the corresponding call in the MSX1-BIOS. </p>


<h3 id="CHGMOD">CHGMOD</h3>
<pre>
Address  : #00D1
Function : Switches to given screenmode
</pre>


<h3 id="INITXT">INITXT</h3>
<pre>
Address  : #00D5
Function : Switches to SCREEN 0
</pre>


<h3 id="INIT32">INIT32</h3>
<pre>
Address  : #00D9
Function : Switches to SCREEN 1
</pre>


<h3 id="INIGRP">INIGRP</h3>
<pre>
Address  : #00DD
Function : Switches to SCREEN 2
</pre>


<h3 id="INIMLT">INIMLT</h3>
<pre>
Address  : #00E1
Function : Switches to SCREEN 3
</pre>


<h3 id="SETTXT">SETTXT</h3>
<pre>
Address  : #00E5
Function : Switches VDP in SCREEN 0
</pre>


<h3 id="SETT32">SETT32</h3>
<pre>
Address  : #00E9
Function : Switches VDP in SCREEN 1
</pre>


<h3 id="SETGRP">SETGRP</h3>
<pre>
Address  : #00ED
Function : Switches VDP in SCREEN 2
</pre>


<h3 id="SETMLT">SETMLT</h3>
<pre>
Address  : #00F1
Function : Switches VDP in SCREEN 3
</pre>


<h3 id="CLRSPR">CLRSPR</h3>
<pre>
Address  : #00F5
Function : Initialises sprite tables
</pre>


<h3 id="CALPAT">CALPAT</h3>
<pre>
Address  : #00F9
Function : Returns address of sprite pattern-table
</pre>


<h3 id="CALATR">CALATR</h3>
<pre>
Address  : #00FD
Function : Returns address of sprite attribute-table
</pre>


<h3 id="GSPSIZ">GSPSIZ</h3>
<pre>
Address  : #0101
Function : Returns current sprite-size
</pre>


<h2>MSX 2 specific calls</h2>

<h3 id="GETPAT">GETPAT</h3>
<pre>
Address  : #0105
Function : Returns current pattern of a character
Input    : A  - ASCII code of character
Output   : Pattern in PATWRK starting from address #FC40
Registers: All
Remark   : Same as routine in MSX1-BIOS, but there is doesn't exist as
           a BIOS-call
</pre>


<h3 id="WTRVRM">WTRVRM</h3>
<pre>
Address  : #0109
Function : Writes data in VRAM (#0000 - #ffff)
Input    : HL - Address
           A  - Value
Registers: AF
</pre>


<h3 id="RDVRM">RDVRM</h3>
<pre>
Address  : #010D
Function : Reads content in VRAM (#0000 - #ffff)
Input    : HL - Address
Output   : A  - Read value
Registers: AF
</pre>


<h3 id="CHGCLR">CHGCLR</h3>
<pre>
Address  : #0111
Function : Changes screen colors
Input    : A  - Screenmode
           See MSX1BIOS.HTM (CHGCLR)  
Registers: All
</pre>


<h3 id="CLS">CLS</h3>
<pre>
Address  : #0115
Function : Clear screen
Registers: All
</pre>


<h3 id="CLRTXT">CLRTXT</h3>
<pre>
Address  : #0119
Function : Clear Text-screen
Registers: All
</pre>


<h3 id="DSPFNK">DSPFNK</h3>
<pre>
Address  : #011D
Function : Display the function keys
Registers: All
</pre>


<h3 id="DELLNO">DELLNO</h3>
<pre>
Address  : #0121
Function : Remove line in text screen
Input    : L  - Line Number
Registers: All
</pre>


<h3 id="INSLNO">INSLNO</h3>
<pre>
Address  : #0125
Function : Add line to text screen
Input    : L  - Line Number
Registers: All
</pre>


<h3 id="PUTVRM">PUTVRM</h3>
<pre>
Address  : #0129
Function : Put character on text screen
Input    : H  - Y-position
           L  - X-position
Registers: AF
</pre>


<h3 id="WRTVDP">WRTVDP</h3>
<pre>
Address  : #012D
Function : Write to VDP-register
Input    : B  - Value to write
           C  - Register number
Registers: AF, BC
</pre>


<h3 id="VDPSTA">VDPSTA</h3>
<pre>
Address  : #0131
Function : Read VDP-status
Input    : A  - Status register
Output   : A  - Read value
Registers: F
</pre>


<h3 id="KYKLOK">KYKLOK</h3>
<pre>
Address  : #0135
Function : Control KANA-key and KANA-lamp (Japan)
Registers: AF
</pre>


<h3 id="PUTCHR">PUTCHR</h3>
<pre>
Address  : #0139
Function : Gets a key-code of keyboard, conversion to KANA and in
           buffer (Japan)
Input    : Z-flag set if not in conversion mode
Registers: All
</pre>


<h3 id="SETPAG">SETPAG</h3>
<pre>
Address  : #013D
Function : Switches the page
Input    : ACPAGE - Active page
           DPPAGE - display page number
Registers: AF
</pre>


<h2>Palette-functions</h2>

<h3 id="INIPLT">INIPLT</h3>
<pre>
Address  : #0141
Function : Initialises the palette (current palet is save in VRAM)
Registers: AF, BC, DE
</pre>


<h3 id="RSTPLT">RSTPLT</h3>
<pre>
Address  : #0145
Function : Restores palette from VRAM
Registers: AF, BC, DE
</pre>


<h3 id="GETPLT">GETPLT</h3>
<pre>
Address  : #0149
Function : Obtains the colorcodes from the palette
Input    : A  - Colorcode
Output   : B  - RRRRBBBB
           C  - xxxxGGGG
Registers: AF, DE
</pre>


<h3 id="SETPLT">SETPLT</h3>
<pre>
Address  : #014D
Function : Sets the color code to the palette
Input    : D  - Colorcode
           E  - xxxxGGGG
           A  - RRRRBBBB
Registers: AF
</pre>


<h3 id="PUTSPRT">PUTSPRT (Basic!)</h3>
<pre>
Address  : #0151
Function : Set sprites
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="COLOR">COLOR (Basic!)</h3>
<pre>
Address  : #0155
Function : Changes Screen- or spritecolor, or palettevalues
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="SCREEN">SCREEN (Basic!)</h3>
<pre>
Address  : #0159
Function : Changes screenmode
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="WIDTHS">WIDTHS (Basic!)</h3>
<pre>
Address  : #015D
Function : Changes textscreen-width
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="VDP">VDP (Basic!)</h3>
<pre>
Address  : #0161
Function : Sets VDP-register
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="VDPF">VDPF (Basic!)</h3>
<pre>
Address  : #0165
Function : Reads VDP-register
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="BASE">BASE (Basic!)</h3>
<pre>
Address  : #0169
Function : Sets VDP base-register
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="BASEF">BASEF (Basic!)</h3>
<pre>
Address  : #016D
Function : Reads VDP base-register
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="VPOKE">VPOKE (Basic!)</h3>
<pre>
Address  : #0171
Function : Writes a byte to VRAM
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="VPEEK">VPEEK (Basic!)</h3>
<pre>
Address  : #0175
Function : Reads a byte from VRAM
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="SETS">SETS (Basic!)</h3>
<pre>
Address  : #0179
Function : Sets BEEP, ADJUST, TIME and DATE
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="BEEP">BEEP</h3>
<pre>
Address  : #017D
Function : Generates beep
Registers: All
</pre>


<h3 id="PROMPT">PROMPT</h3>
<pre>
Address  : #0181
Function : Shows prompt (normal &quot;Ok&quot;, Chaos: &quot;Files&quot; = a nice prompt ;))
Registers: All
</pre>


<h3 id="SDFSCR">SDFSCR</h3>
<pre>
Address  : #0185
Function : Recovers screen-parameters of clock-chip. When C-flag is set
           function-key text will be displayd
Input    : C-flag reset after MSX-DOS call
Registers: All
</pre>


<h3 id="SETSCR">SETSCR</h3>
<pre>
Address  : #0189
Function : Recovers screen-parameter and prints Welcome message
Registers: All
</pre>


<h3 id="SCOPY">SCOPY (Basic!)</h3>
<pre>
Address  : #018D
Function : Copy's VRAM, array and disk-file
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h2>BIT-BLIT routines</h2>

<p>From here on the so-called BIT-BLIT routines are listed, which are mostly executed by the VDP. The parameters must be passed through the system RAM at #F562. See the MSX 2 system variables documentation for more details. HL must always contain the value #F562 when calling.</p>


<h3 id="BLTVV">BLTVV</h3>
<pre>
Address  : #0191
Function : Copy VRAM to VRAM
Input    : SX, SY, DX, DY, NX, NY, ARG, L_OP
Registers: All
</pre>


<h3 id="BLTVM">BLTVM</h3>
<pre>
Address  : #0195
Function : Copy Main-RAM to VRAM
Input    : SX - Address of screendata in RAM
           DX, DY, ARG, L_OP. NX and NY must be in screendata
Output   : C-flag set if data failure in RAM
Registers: All
</pre>


<h3 id="BLTMV">BLTMV</h3>
<pre>
Address  : #0199
Function : Copy VRAM to Main-RAM
Input    : DX - Address of screendata in RAM
           SX, SY, ARG, L_OP. NX and NY must be in screendata
Registers: All
</pre>


<h3 id="BLTVD">BLTVD</h3>
<pre>
Address  : #019D
Function : Copy Diskfile to VRAM
Input    : SX -Address  of filenaam.
           SX, SY, ARG, L_OP. NX and NY must be in diskfile
Registers: All
</pre>


<h3 id="BLTDV">BLTDV</h3>
<pre>
Address  : #01A1
Function : Copy VRAM to Diskfile
Input    : DX - Address of filenaam.
           SX, SY, NX, NY,ARG
Registers: All
</pre>


<h3 id="BLTMD">BLTMD</h3>
<pre>
Address  : #01A5
Function : Copy Diskfile to Main-RAM
Input    : SX - Address of filenaam.
           DX - start-address
           DY - end-address (in Main-RAM)
Registers: All
</pre>


<h3 id="BLTDM">BLTDM</h3>
<pre>
Address  : #01A9
Function : Copy Main-RAM to Diskfile
Input    : DX - Address of filenaam.
           SX - start-address
           SY - end-address  (in Main-RAM)
Registers: All
</pre>


<h3 id="NEWPAD">NEWPAD</h3>
<pre>
Address  : #01AD
Function : Read lightpen, mouse and trackball
Input    : Access via GETPAD in MSX1BIOS, Will be linked to this call
           Procedure: read device, after that X and Y.
           A  - 8 tot 19
           [ 8]   Read lightpen (#FF if available)
           [ 9]   Read X-position
           [10]   Read Y-position
           [11]   Read lightpen-status (#FF if pressed)

           [12]   Read mouse/trackball in port 1
           [13]   Read X-offset
           [14]   Read Y-offset
           [15]   No function (always #00)

           [16]   Read mouse/trackball in port 2
           [17]   Read X-offset
           [18]   Read Y-offset
           [19]   No function (always #00)

Output   : A  - Read value
Registers: All
</pre>


<h3 id="GETPUT">GETPUT (Basic!)</h3>
<pre>
Address  : #01B1
Function : GET TIME, GET DATE and PUT KANJI
Input    : HL - Basic textpointer
Output   : HL - Adapted Basic textpointer
Registers: All
</pre>


<h3 id="CHGMDP">CHGMDP</h3>
<pre>
Address  : #01B5
Function : sets SCREEN-mode
Input    : A  - SCREEN-mode
Registers: All
</pre>


<h3 id="RESVI">RESVI</h3>
<pre>
Address  : #01B9
Function : Not used... Reserve entry
</pre>


<h3 id="KNJPRT">KNJPRT</h3>
<pre>
Address  : #01BD
Function : Puts Kanji-character on graphical screen (5-8)
Input    : BC - JIS Kanji-character code
           A  - Display-mode (0=full, 1=even, 2=odd)
Registers: AF
</pre>


<h3 id="REDCLK">REDCLK</h3>
<pre>
Address  : #01F5
Function : Read clock-RAM
Input    : C  - clock-RAM address
                xxBBAAAA
                  ||++++-- address
                  ++------ Block-number
Output   : A  - Read value in lowest four bits
Registers: F
</pre>


<h3 id="WRTCLK">WRTCLK</h3>
<pre>
Address  : #01F9
Function : Write clock-RAM
Input    : C  - clock-RAM address
                xxBBAAAA
                  ||++++-- address  :
                  ++------ Block-number
           A  - Value to write
Registers: F
</pre>




<?php addFooter(); ?>
</body>
</html>