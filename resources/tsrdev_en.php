<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MemMan 2.32 TSR Development Kit</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1 style="text-align:center">MemMan 2.32</h1>
<h2 style="text-align:center">TSR Development Kit</h2>


<p style="text-align:center">Development kit for MemMan 2 TSR programs</p>

<p style="text-align:center">MSX2<br />
80kB RAM<br />
3.5 inch, 1DD<br />
MSXDOS 1 or 2</p>

<p style="text-align:center">Original by MSX Software Team (MST)<br />
Original provided and scanned by BiFi<br />
Converted to PDF by HansO<br />
Translated and transcribed by Laurens Holst</p>


<p class="page"></p>


<h1>Changes in MemMan 2.3 compared to 2.2</h1>

<ul>
<li>The function XTsrCall (61) was added. This function works just like TsrCall
(63), however the Tsr-ID is expected to be passed in register IX instead of BC.
This frees up register BC for use as an input parameter. Disadvantage is that
this function can not called via the MemMan hook, it can only be invoked
directly.</li>
<li>Using the Info (50) function, the address on which XTsrCall can be called
directly can be obtained.</li>
<li>The status (31) function has been improved. The computer’s total amount of
usable memory is now reported correctly, also in MSX-DOS 2 environment.</li>
<li>The Alloc (10) function now also recognizes memory that becomes available
when the DOS2 RAMdisk is removed or resized! It does not matter anymore if the
RAMdisk is created before or after MemMan was installed.</li>
<li>The internal stack of MemMan, used to process function calls, has been
enlarged from 160 to 240 bytes. MemMan 2.2’s function stack turned out to be too
small to process nested “tsrCalls”.</li>
</ul>

<pre class="func">
Name:     XTsrCall
Number:   61
Function: Invoke the driver entry of a TSR
In:       IX = ID code of the TSR to call
          AF, BC, DE, HL are passed to the TSR
Out:      AF, BC, DE, HL are returned from the TSR
</pre>

<p>This is an improved version of the TsrCall (63) function. Because it can pass
all main registers to the TSR, it is advised to use this function instead of
function 63.</p>

<p>Note: This function can not be called through the EXTBIO hook, because the
EXTBIO call modifies the IX register. Therefore, invoke this function directly,
or use the MemMan function handling routine. The addresses at which these
routines can be called can be obtained through the info function (50).</p>

<pre class="func">
Name:     Info
Number:   50
Function: Provides information about amongst others
          the entry adddresses of certain MemMan functions
In:       B = Information number (0..8)
Out:      HL = Information
</pre>

<p>Information number overview, with the corresponding MemMan function codes
between brackets:</p>

<ol type="1">
<li value="0">Entry address of FastUse0 (function 0)</li>
<li value="1">Entry address of FastUse1 (function 1)</li>
<li value="2">Entry address of FastUse2 (function 2)</li>
<li value="3">Entry address of TsrCall (function 63)</li>
<li value="4">Entry address of BasicCall</li>
<li value="5">Entry address of FastCurSeg (function 32)</li>
<li value="6">Entry address of MemMan’s function handler</li>
<li value="7">MemMan version number, format: version #H.L</li>
<li value="8">Entry address of XTsrCall (function 61)</li>
</ol>


<p class="page">I</p>


<p>The above function addresses can be called directly by an application or TSR.
All entry addresses are guaranteed to be in page 3.</p>

<p>The functions will be executed swiftly because the MemMan CALL to the EXTBIO
hook is omitted, and because the function codes in registers D and E won’t have
to be examined. Another advantage is that parameters can be passed in the DE
register, mostly useful for the TsrCall and BasicCall functions.</p>

<p>For example, the initialization routine of a TSR can request the necessary
function entry addresses through the INFO function and store those for later use
in the TSR’s code, which will improve the TSR program’s speed significantly.</p>

<p>An exact description of the above functions can be found at the MemMan
function whose number is listed between parentheses.</p>

<p>Keep in mind however that the ‘fast’ functions differ from the ‘normal’
MemMan functions in the following ways:</p>

<dl>
<dt>fastUse0-2:</dt>
<dd>Selects a segment into a certain memory page. See the description at the
MemMan ‘Use’ functions.</dd>

<dt>tsrCall:</dt>
<dd>Register [DE] will be passed to the TSR unchanged. This is different form
function 63 (TsrCall), where register DE is already used to pass the MemMan
function number.</dd>

<dt>FastCurSeg:</dt>
<dd>No valid value will be returned in register [A]. The MemMan CurSeg function
(32) will indicate if it is an FSEG or a PSEG.</dd>

<dt>xTsrCall</dt>
<dd>All main registers (AF, BC, DE, HL) will be passed to the TSR unchanged.
The TSR-ID code has to be passed in the IX register.</dd>
</dl>

<pre class="func">
basicCall: Has no function number (address must be obtained through info)
Function:  Invoke a routine in the BASIC ROM.
In:        IX = Call address in page 0 or 1
           AF, BC, DE, HL are passed to the BASIC ROM
Out:       AF, BC, DE, HL are received from the BASIC ROM
           Interrupts are disabled
</pre>

<p>Through this function a TSR can call routines in page 0 or 1 of the BASIC
ROM. The BIOS must already be enabled in page 0. The BASIC ROM in page 1 will be
enabled by MemMan.</p>

<p>This is for example needed to be able to call the math-pack routines which
are located in page 0 of the BASIC ROM, but which themselves also call a few
routines in page 1. The H.STKE (stack error) hook will be bent, so that if a
BASIC error occurs the internal MemMan stacks can be reset.</p>

<pre class="func">
memMan:   Has no MemMan function number (address must be obtained through info)
Function: Directly invoke a MemMan function
In:       E = Memman function number
          AF, BC, HL are passed to the function
Out:      AF, BC, DE, HL are received from the function
</pre>

<p>Invoking this routine will have the same effect as calling a MemMan function
through the EXTBIO hook. However because the call to the EXTBIO hook is skipped,
the other expansions which are linked to this hook won’t be called. This limits
stack usage and increases processing speed.</p>


<p class="page">II</p>


<h1>MemMan 2.3 BASIC statements</h1>

<p>Since version 2.3 on MemMan contains a couple of statements and functions
which can be invoked from MSX-BASIC. For this purpose MemMan comes with a system
TSR, with the ID-name "MST TsrUtils". This TSR has sequence number 0 and can not
be removed by TSR-Kill. Below is a description of the available BASIC
instructions. The meaning of the used symbols is as follows:</p>

<p>[] Everything between square brackets may be omitted.<br />
&lt;&gt; Parameter descriptions are between angle brackets.<br />
() Parentheses must be entered, as well as punctuation and comma’s.</p>

<pre class="func">
Command:  TSR-Load
Syntax:   CMD TL("&lt;filename&gt;",[T],[A$],[&lt;F&gt;])
Type:     Statement
Example:  CMD TL("PB")
          CMD TL("ALARM",T,,A)
Function: Loads a TSR file into memory
</pre>

<p>&lt;filename&gt; = name of the TSR file. In MSX-DOS2 environment a
subdirectory may be specified.<br />
T = Show the TSR’s intro text<br />
A$ = Name of a string variable in which the TSR ID-name will be stored<br />
&lt;F&gt; = Variable in which an error code will be stored. If this variable is
omitted load errors will produce a standard BASIC error. The error codes are:</p>
<ol>
<li value="0">TSR loaded successfully</li>
<li value="1">TSR installation aborted</li>
<li value="2">Structure error in TSR file</li>
<li value="3">TSR table is full</li>
<li value="4">Hook table is full</li>
<li value="5">No free MemMan segment</li>
<li value="6">Not enough BASIC work memory</li>
</ol>

<pre class="func">
Command:  TSR-Kill
Syntax:   CMD TK("&lt;TSR ID-name&gt;")
Type:     Statement
Example:  CMD TK("MJV printbuf")
Function: Removes a TSR from memory
</pre>

<p>&lt;TSR ID-name&gt; = Identification name of the TSR to remove. This name can
be retrieved by means of TSR-View or Find-TSR.</p>


<pre class="func">
Command:  TSR-View
Syntax:   CMD TV
Type:     Statement
Function: Shows an overview of the ID-names of all active TSRs.
</pre>


<p class="page">III</p>


<pre class="func">
Command:  Find-TSR name
Syntax:   ATTR$ FT("&lt;TSR ID-name&gt;")
Type:     Function
Example:  IF ATTR$ FT("CAPS") THEN CMD TK("CAPS")
Function: Returns -1 if the specified TSR is installed, otherwise 0.
</pre>

<p>&lt;TSR ID-name&gt; = Identification name of the TSR.</p>

<pre class="func">
Command:  Find-TSR number
Syntax:   ATTR$ FT(&lt;TSR sequence number&gt;)
Type:     Function
Example:  N$ = ATTR$ FT(0)
Function: Returns the ID-name of the TSR with the specified sequence number.
          If the sequence number exceeds the number of active TSRs, an empty
          string with length 0 will be returned.
</pre>


<p class="page">IV</p>


<h1>Patches MemMan 2.3 (version 2.30 to 2.31)</h1>

<p>The first error which was found concerned TL.COM. It turned out that it
wasn’t able to load TSRs in MSXDOS 1. The patch was published in MSX Computer
Magazine 49 and MSX Club Magazine 38.</p>

<p class="box"><code>
10 'Update TL.COM from version 1.30 to 1.31<br />
20 OPEN "TL.COM" AS #1 LEN=1: FIELD #1,1 AS A$: GET #1,1637: IF A$&lt;&gt;"0" THEN PRINT "Not TL.COM version 1.30": CLOSE: END<br />
30 READ A: IF A=-2 THEN CLOSE: PRINT "TL.COM version 1.31 created": END ELSE IF A=-1 THEN READ B,A<br />
40 LSET A$=CHR$(A): PUT #1,B: B=B+1: GOTO 30<br />
50 DATA -1,70,68,10,-1,497,183,32,238,-1,1637,49,-1,2373,33,128,0,84,94,25,35,11,6,195,253,6,-2<br />
</code></p>

<p>The second error was more serious. It affected TSRs that switched memory in
page 2, fortunately at that moment only the printerbuffer PB.TSR did this,
and it only failed if people used DOS 1 and CMD TL was used to load the TSR.
The patch was published in MSX Computer Magazine 52, and probably in MSX Club
Magazine 40 as well, which is not out yet at the moment of writing.</p>

<p class="box"><code>
10 PRINT "Update MEMMAN.BIN and/or MEMMAN.COM from version 2.30 to version 2.31": PRINT "1 Patch MEMMAN.BIN": PRINT "2 Patch MEMMAN.COM": PRINT "3 Patch both": PRINT "4 Stop": Print "Choice: ";: I=VAL(INPUT$(1)): PRINT I$: PRINT<br />
20 IF (IAND1)=1 THEN RESTORE 80: F$="MEMMAN.BIN": C=174: GOSUB 50<br />
30 IF (IAND2)=1 THEN RESTORE 90: F$="MEMMAN.COM": C=267: GOSUB 50<br />
40 IF I=4 THEN END ELSE PRINT: GOTO 10<br />
50 OPEN F$ AS#1 LEN=1: FIELD #1,1 AS A$: GET #1,C: B$=A$: GET #1,C+1: B$=B$+A$: IF B$="31" THEN PRINT F$;" has already been patched": CLOSE: RETURN ELSE IF B$&lt;&gt;"30" THEN PRINT F$;" is not version 2.30": CLOSE: RETURN<br />
60 READ A: IF A=-2 THEN CLOSE: PRINT F$;" version 2.31 created": RETURN ELSE IF A=-1 THEN READ B,A<br />
70 LSET A$=CHR$(A): PUT #1,B: B=B+1: GOTO 60<br />
80 DATA -1,35,59,131,-1,322,0,205,181,134,17,30,77,205,202,255,201,-1,175,49,-2<br />
90 DATA -1,128,64,131,-1,415,0,205,186,134,17,30,77,205,202,255,201,-1,268,49,-2<br />
</code></p>


<p class="page">V</p>


<h1>Table of Contents</h1>

<dl class="index">
<dt><span class="indexpage">3</span>
    Introduction</dt>

<dt><span class="indexpage">4</span>
    Overview MST files TSR development disk</dt>

<dt><span class="indexpage">5</span>
    Introduction MemMan 2</dt>
<dd><span class="indexpage">6</span>
    Configuration</dd>
<dd><span class="indexpage">7</span>
    Installation</dd>
<dd><span class="indexpage">8</span>
    TSR programs</dd>
<dd><span class="indexpage">8</span>
    Loading TSRs</dd>
<dd><span class="indexpage">9</span>
    Showing TSRs</dd>
<dd><span class="indexpage">9</span>
    Removing TSRs</dd>

<dt><span class="indexpage">10</span>
    MemMan 2.2 specifications</dt>
<dd><span class="indexpage">10</span>
    Changes since MemMan 2.0</dd>
<dd><span class="indexpage">11</span>
    Changes since MemMan 2.1</dd>
<dd><span class="indexpage">12</span>
    Used terminology</dd>
<dd><span class="indexpage">13</span>
    The basic principles</dd>
<dd><span class="indexpage">14</span>
    Function description MemMan 2.2</dd>
<dd><span class="indexpage">25</span>
    Usage of the stack in MemMan environment</dd>
<dd><span class="indexpage">25</span>
    BIOS calls in Turbo Pascal</dd>

<dt><span class="indexpage">26</span>
    Calling of TSRs through MemMan 2</dt>
<dd><span class="indexpage">26</span>
    Processing of hook-calls</dd>
<dd><span class="indexpage">30</span>
    Processing of TSR calls through TsrCall</dd>
<dd><span class="indexpage">31</span>
    Function calls by TSRs</dd>
<dd><span class="indexpage">31</span>
    Calls to the Main ROM</dd>

<dt><span class="indexpage">32</span>
    TSR files: background</dt>
<dd><span class="indexpage">32</span>
    REL table</dd>
<dd><span class="indexpage">32</span>
    Initialization code</dd>
<dd><span class="indexpage">33</span>
    Hook table</dd>
<dd><span class="indexpage">33</span>
    Header table</dd>
<dd><span class="indexpage">35</span>
    File structure</dd>

<dt><span class="indexpage">36</span>
    Interrupts</dt>

<dt><span class="indexpage">40</span>
    Source listings</dt>
<dd><span class="indexpage">40</span>
    TSRFRAME</dd>
<dd><span class="indexpage">42</span>
    PB.TSR</dd>
<dd><span class="indexpage">57</span>
    PRINT.COM</dd>

<dt><span class="indexpage">69</span>
    Index</dt>
</dl>


<p class="page">2</p>


<h1>Introduction</h1>

<p>First of all, we’d very much like to thank you for acquiring the MST TSR development disk. With this packet you will be able to program Terminate and Stay Resident programs according to the MemMan-standard.</p>

<p>MemMan 2 is an addition to the MSX-standard, as far as memory control is concerned. In addition to that, MemMan regulates the installation, the calling and the removal of TSR programs. Because of that it is in theory possible to run an infinite number of TSRs flawless at the same time.<br />
TSR programs are placed in memory segments controlled by MemMan, and if possible multiple TSRs are placed in one segment.</p>

<p>The largest part of the MemMan code is located in a memory segment outside of the common DOS and Basic memory. Only a few routines are installed in page 3, to safe DOS memory. The TSRs, too, are placed in separate segments, and if possible one segments is shared between multiple TSRs. The space left in the MemMan-segment can also be used by TSRs.</p>

<p>Bending the hooks in the system memory is entirely handled by MemMan, the TSR code will only have to specify the address of the to-be-bent hooks. The way applications can call the TSRs is also standardized.</p>

<p>TSRs can be developed with every assembler which can create relocatable files. These files are consecutively joined together by MST’s own linker - LinkTsr - into a TSR file.</p>

<p>Finally, we’d like to point out to you that MemMan may freely be spread and even be contained in a commercially packet. This way, we hope to ensure a broad support of the MemMan standard. Only this manual and the several development-tools on the disk may not be spread. See the file overview elsewhere in this manual.</p>


<p class="signed">The MemMan development team</p>


<p class="page">3</p>


<h1>File overview MST TSR development disk</h1>

<table>
<tr><th> Filename </th><th> PD </th><th> Description </th></tr>
<tr><td> MEMMAN.COM </td><td> Yes </td><td> MemMan version 2.2, load from MSX-DOS </td></tr>
<tr><td> MEMMAN.BIN </td><td> Yes </td><td> MemMan version 2.2, load from MSX Disk Basic </td></tr>
<tr><td> TL.COM </td><td> Yes </td><td> TsrLoad, version 1.20 </td></tr>
<tr><td> TK.COM </td><td> Yes </td><td> TsrKill, version 1.20 </td></tr>
<tr><td> TV.COM </td><td> Yes </td><td> TsrView, version 1.20 </td></tr>
<tr><td> LT.COM </td><td> No </td><td> LinkTsr, version 1.00 </td></tr>
<tr><td colspan="3"></td></tr>
<tr><td> MM2INTRO.TXT </td><td> Yes </td><td> User’s Manual MemMan 2.2 </td></tr>
<tr><td> MM22SPEC.TXT </td><td> Yes </td><td> Function description MemMan 2.2 </td></tr>
<tr><td colspan="3"></td></tr>
<tr><td> TSRFRAME.GEN </td><td> No </td><td> Framework of a TSR listing, for the GEN80 assembler </td></tr>
<tr><td> TSRFRAME.MAC </td><td> No </td><td> Framework of a TSR listing, for the M80 assembler </td></tr>
<tr><td> GTSR.BAT </td><td> No </td><td> Batchfile for assembling/linking a TSR, GEN80 version </td></tr>
<tr><td> MTSR.BAT </td><td> No </td><td> Batchfile for assembling/linking a TSR, M80 version </td></tr>
<tr><td colspan="3"></td></tr>
<tr><td> PB.TSR </td><td> Yes </td><td> Printerbuffer </td></tr>
<tr><td> PRINT.COM </td><td> Yes </td><td> PB application </td></tr>
</table>

<p>Nota Bene: The column PD indicates if a file is Public Domain</p>


<p class="page">4</p>


<h1>MST’s MemMan 2, the MSX Memory Manager</h1>

<p>Begin 1990 MSX Computer Magazine first called the best MSX-programmers of the Netherlands together with the intention to blow new life into the MSX scene. The group of programmers introduced themselves to eachother and ideas were exchanged. There appeared to be a need for a Memory Manager, a program which controls the memory of the MSX.</p>

<p>With the Memory Manager two goals are pursued:</p>

<ol>
<li>The searching and using of memory becomes easier. The searching will be done by MemMan while the useage of memory will as much as possible be uncoupled from the configuration: ‘old’ expansions, one, two or more mappers, MemMan has not troubles with it.</li>
<li>It becomes possible to load multiple programs at the same time into the memory without them being in eachother’s way. Ramdisks, printerbuffers and on the background working programs were held in mind.</li>
</ol>

<p>With version 1 of MemMan - introduced on september 9, 1990 - the first goal was achieved. Now, the second goal has also been achieved.<br />
MemMan version 2 can load and run multiple programs ‘somewhere’ in the memory, without them troubling eachother. On other computer makes this technologie was already known. Such programs are called TSRs, hence here too: Terminate and Stay Resident programs.</p>

<p>Hopefully even more programs will make use of MemMan and existing programs will be adapted for MemMan. An immediate advantage is that the program can then also operate with for example 64 kB modules and even with multiple memory mappers, something most existing programs don’t handle correctly.</p>

<p>MemMan version 2 will, just like the first version, be sent out into the world as Public Domain. This means that everyone may freely use MemMan. It is even allowed to sell MemMan as a part of a commercial packet. Only then the program can grow to be an addition to the MSX standard. Two large packets will be published. The first is for the user of MemMan. This packet will contain MemMan and a number of tools for the TSRs. The second packet contains development tools and technical documentation about programming TSRs. The latter packet is not Public Domain.</p>

<p>The following people contributed to MemMan:</p>

<p>
Ramon van der Winkel<br />
Ries Vriend<br />
Robbert Wethmar<br />
Paul te Bokkel<br />
Markus The<br />
and a number of people who with their constructive critisizm helped MemMan became what it now is.</p>


<p class="page">5</p>


<h2>The configuring</h2>

<p>MemMan is available in two versions: a .BIN and a .COm file. It should be clear that the .BIN version can be loaded from BASIC with a BLOAD"MEMMAN.BIN",R instruction, while the .COM can be started from MSXDOS by simply typing MEMMAN. Both version automatically return - through a so-called warm boot - to BASIC. If the .COM version is started from MSXDOS, a commandline can be given. These are commands which will be executed as if they are typed. A Return can be specified with the @ character. Multiple @ characters can be put at the commandline, so that multiple commands can be executed subsequently.</p>

<p>For example:</p>

<p><kbd>A&gt;MEMMAN _SYSTEM@TL CAPS@</kbd></p>

<p>After booting MEMMAN it will return to MSXDOS and the TSR "CAPS" will be loaded.</p>

<p>With the help of CFGMMAN it is possible to specify a number of settings and a default commandline for MemMan. CFGMMAN can configure aswell the .COM as the .BIN version. As for the TSRs the following settings can be changed:</p>

<ul>
<li>Default command line<br />
Here one can set the default command-line. This command-line will be executed after MemMan has been installed. After loading the .BIN version of MemMan this standard commandline will always be executed. The standard command-line if MemMan is started from DOS with another commandline specified. If a MemMan error occurs the commandline won’t be executed.</li>

<li>Heap size<br />
Some TSR programs need additional memory in page 3, to which they usually don’t have access. The heap is a part of the memory in page 3 which is accessible to TSRs. In case a TSR reports that there is too little heap memory available this value needs to be increased. Usually the addition of 100 extry bytes of heap-memory will end the problems. In case a TSR needs more heap-space the manual needs to specify that. Every change in heap-space only takes effect after reloading MemMan</li>

<li>Maximum number of TSRs which can be loaded at the same time<br />
The number of TSRs which can be loaded under MemMan 2 is limited. When the TSR Loader (TL) generates a ‘TSR Table Full’ error, this value needs to be increased.</li>
</ul>


<p class="page">6</p>


<ul>
<li>Maximum number of hooks which can be bent<br />
The number of hooks which can be bent by all residing TSRs is limited. In case the TSR Loader returns a ‘Hook Table Full’ error this value needs to be increased.</li>

<li>Recursion depth<br />
If TSRs call eachother or themselves too often the system will at some point crash. By increasing the maximum recursion depth these kind of problems can be solved. TSRs which call themselves should - with the necessary recursion depth - mention that in the manual.</li>
</ul>


<h2>The installation</h2>

<p>To load MemMan from MSX-DOS, typing ‘MEMMAN’ after the ‘A:>’ prompt will suffice. From BASIC the command BLOAD"MEMMAN.BIN",R needs to be entered. After installing MemMan, in both cases BASIC will be started, after which the default commandline is executed, as specified in the configuration tool CFGMMAN. The default commandline will not be executed in case the memory manager is started from DOS with a replacing commandline as an argument.</p>

<p>Version 2 of MemMan uses aside from a part of BASIC-memory also a 16kB segment. Because of this as much as possible memory remains available in BASIC and MSXDOS. The space which is left in the 16kB segment is if possible used to load TSRs in. The amount of BASIC-memory MemMan uses can be influenced by the configuration tool CFGMMAN.</p>

<p>When MemMan is installed under DOS2 all segments - except for the one MemMan needs itself - will also remain available to DOS2. Therefor it is without a doubt possible to install MemMan first, and then a DOS2 RAMdisk. This order adds the advantage that MemMan can give the memory which becomes available after resizing the RAMdisk to other MemMan applications. If the DOS2 RAMdisk is installed before MemMan the segments the RAMdisk used are unavailable to MemMan.<br />
Before settling itself in the RAM MemMan will ofcourse check if there is already a version of MemMan loaded. In that case the info-lines will disappear, with in addition the notification that MemMan has already been installed. Nothing else will happen, and the commandline will be executed just like anytime else.</p>


<p class="page">7</p>


<h2>Terminate and Star Resident programs</h2>

<p>Usually a program won’t remain in the memory after execution. Programs which do are designated with the abbreviation TSR: Terminate and Stay Resident. Examples of such programs are printerbuffers and RAMdisks. But also other applications, like a calculator or a calendar which can be summoned with a single key press, are possible.<br />
In the past TSRs for the MSX have been a rather rare appearance. The problem was that the memory a TSR uses can also be used for other programs. In a standard MSX machine, there are no possibilities to reserve a certain amount of memory for a TSR. This problem is solved by MemMan. MemMan controls the memory and makes sure no memory conflicts occur.<br />
Thanks to MemMan it is possible to have multiple TSRs in the memory at the same time, where every TSR can have a maximum size of 16kB. On the standard MSX the loading of more than one TSR is already a pain and only possible if the TSR isn’t too big. With the introduction of MemMan 2 the MSX gets better TSR possibilities than the widely appreciated PC. In addition to that, they can compare with the ‘Desktop Accesoires’ like they are being used on the Macintosh and the Atari ST.<br />
Packed with MemMan are two simple example TSRs. They don’t do much useful, but certainly do demonstrate the power of Terminate and Stay Resident programs. The examples are CAPS.TSR and COLOR.TSR. The first lets the Caps led blink, the second lets the Basic command CMD COLOR invert the screen. In the future however more and more TSRs will appear, with possibilities the MSX user could until shortly only dream of.</p>


<h2>Loading TSRs</h2>

<p>TSR programs are recognizable by their file extension: they end with .TSR. Aside from the actual code these programs also contain all information necessary to let the TSR install well in the memory.<br />
For example, to load the demonstration TSR ‘CAPS’ - which on a sidenote doesn’t do anything else except for blinking the Caps light - one should type:</p>

<p><kbd>TL CAPS</kbd></p>

<p>TL is short for TSR-Load, the program which loads the TSR and places it into the memory. Unfortunately TSR-Load at this moment only work under MSX-DOS. From Basic it is not yet possible to load TSR programs.<br />
As soon as TL has loaded the TSR in memory the program will become active. In abovementioned example that means that the CAPS led will start blinking and that at every keypress the casette relais will be switched on or off.<br />
TL is a smart program. As long as there is still space left in the MemMan segment for TSRs that’s where they’ll be put. Only if it is really necessary a new segment is used, which will be made unapproachable for other applications. That for example happens when an extremely large TSR program is being load. If next another small one is loaded TL will first search through all existing TSR segments to see if there might be space somewhere else. The order in which TSRs are loaded will therefor not be of influence on the memory usage.</p>


<p class="page">8</p>


<h2>Viewing TSRs</h2>

<p>It is always possible to see which TSRs are currently active in the memory. For that, the MemMan packet contains the utility TV, TSR-View. The usage is as simple as it can be; just type at the DOS prompt:</p>

<p><kbd>TV</kbd></p>

<p>An overview of the currently active TSRs will appear, complete with their full name. This name must be unique for every TSR, and will therefor also almost always contain the initials of the programmers. So this name is not the same as the filename! It is this full name - the TSR ID - which is needed if a TSR has to be removed from the memory. Also programs which directly work together with TSRs can use this name to see if a TSR is present in the memory.</p>


<h2>Removing TSRs</h2>

<p>As said it’s also possible to remove TSRs from the memory again. The necessary program is called TK, TSR-Kill. TK makes sure a TSR is tidily removed. All other TSRs continue to work perfectly, and if the TSR was the only one in its segment the segment is freed again for use by other applications. For example to return the Caps function to its normal state and to disable the blinking, removing the corresponding TSR will suffice. To do that, type:</p>

<p><kbd>TK "MJVcapsblink"</kbd></p>

<p>where the full name of the TSR has to be specified between quotation marks. Except for freeing memory TSR-Kill can also be used to remove crashed TSRs from the memory. A TSR which for some reason won’t work well anymore can with the help of TK usually be removed without problems. Subsequently the TSR can be reloaded with TL again, just like restarting normal programs sometimes helps the same goes for TSRs.</p>


<p class="page">9</p>


<h1>MEMMAN version 2.2 - specifications</h1>

<p>This chapter contains all necessary information to be able to write applications for MemMan 2. For more information on programming and the calling of TSRs we refer to the concerning chapters.</p>


<h2>Changes compared to MemMan version 2.0:</h2>

<p>The release of the MSX Turbo R machine in the Netherlands threw up some dust at the MemMan programmers. Right after releasing MemMan 2.0 the usage of MemMan on a Turbo-R appeared to give some trouble, especially when using the Kanji screen modes.</p>

<p>These problems partially occurred because the Kanji routines in the Turbo-R bent the extended BIOS hook at address #FFCA in a way which wasn’t foreseen by the MemMan programmers. The Turbo-R namely expects that every application which is hooked to the extended BIOS hook to be called through a so-called interslot call, whilst MemMan worked via the much faster "jump" instruction. This had as a result that the Turbo-R didn’t bend the extended BIOS hook - on which MemMan is linked - corectly, and crashed. After this was solved it appeared another structural error had been made.</p>

<p>If MemMan 2.0 is loaded and after that the Kanji driver is activated through a ‘CALL KANJI’ instruction, after a call of the extended BIOS hook the Kanji-ROM will be selected in page 1. When after that the call appears to be meant for MemMan, MemMan is called, however at that moment the Kanji ROM is still active in page 1. When the MemMan is ready, the interslot-call will switch the routines back to the way it was known at the time of the hook-call.</p>

<p>In some cases the restoration of the slot settings however not desired. The MemMan ‘use’ functions are for example especially meant to be able to change the slot settings. The effect of the ‘use’ functions is however undone because the interslot-call switches the slot settings back.</p>

<p>Therefor MemMan’s ‘use’ functions should not be called from the extended BIOS hook. Also ‘restore slot’ (function 41) has the same problem and is better not used. To remain compatible with previous versions of MemMan the abovementioned functions are still present. As a replacement for the ‘use’ and ‘(re)store slot’ functions the usage of the ‘fastUse’ and perhaps the ‘fastCurSeg’ functions is strongly advised. The address on which these functions can be called can be obtained through function 50 ‘info’.</p>


<p class="page">10</p>


<h2>Further changes in MemMan 2.1 compared to version 2.0:</h2>

<ul>
<li>functions 60 and 61 have been dropped because of a structure error.<br />
These functions used register IX as a parameter, while this register is changed by the interslot call with which MemMan 2.1 is linked to the extended BIOS hook.</li>
<li>functions GetTsrID(63) and TsrCall(63) now replace functions 60 and 61<br />
The TSR-ID is with these functions passed in register BC instead of register IX.</li>
</ul>


<h2>Changes in MemMan 2.2 compared to version 2.1:</h2>

<ul>
<li>MemMan’s function processing routine can be called directly. This routine its address can be acquired through the info function (50).</li>
<li>MemMan’s version number can be obtained through the info function. Because of this programs can determine which version of MemMan is installed, without having to call the IniChk function.</li>
<li>Bug removed concerning TSR management on a system with multiple memory mappers</li>
<li>Bug removed concerning the DeAlloc (20) functions, when freeing PSEGs.</li>
</ul>


<p class="page">11</p>


<h2>Used terminoligy</h2>

<dl>
<dt>Segment</dt>
<dd>A memory block of 16kB. Segments occur as page-specific segments (PSEG) and flexible segments (FSEG). The flexible segments can be switched into the pages 0, 1 and 2. The page specific segments can only be switched into their own page. There are three kinds of page specific segments: PSEG0000, PSEG4000 and PSEG8000. They can respectively be enabled in pages 0, 1 and 2. In case DOS2 is active during the installation of MemMan, MemMan won’t add DOS2’s segments which are not free anymore to the segment table. So the memory which is used by a RAMdisk, installed before MemMan, can’t be controlled by MemMan anymore.<br />
If a (Dos2-) RAMdisk is installed after MemMan however, the segments used by the RAMdisk can be used by MemMan after the RAMdisk is removed.</dd>

<dt>Heap</dt>
<dd>A block of memory in page 3 (somewhere between #C000 and #FFFF) in which MemMan applications can request a part which they can then freely use.</dd>

<dt>FastUse</dt>
<dd>Same as Use, but then at the address in page 3 on which the routine can directly be called.</dd>

<dt>unCrash</dt>
<dd>To prevent that segments are requested and would never be freed again because of a program crash, the IniChk routine executes an unCrash. Here, all segments are freed again. The unCrashing of a segment can be prevented to give a segment the Reserved status. This can be done with the SetRes (11) function. Usually, a segment won’t have to be given the Reserved status.</dd>
</dl>


<p class="page">12</p>


<h2>The principles</h2>

<p>MemMan divides the available memory in segments of 16kB. Before a segment can be used, it must be allocated. After usage it must be freed again. There are two kinds of segments, the so-called page-specific PSEGs and the flexible FSEGs.</p>

<p>PSEGs are segments which are allocated for usage on a certain page, for example from #4000 to #7FFF or from #8000 to #BFFF. When a PSEG-segment is requested, MemMan will assign as much non-mapper segments as possible.</p>

<p>FSEGs are segments which can be switched into a random page. These segments always come from memory mappers. No matter which kind of segment is being requested, MemMan will return a 16-bit ‘segment code’. This segment code is needed when selecting or freeing a segment. If you only need memory in the #8000 to #BFFF area it’s best to request PSEGs. Memman will then use as much memory as possible from ‘old’ 16- and 64-kB modules and will only after that start using the mapper.</p>

<p>So, with the help of MemMan a program will never have to look for memory again. Just request a page, use it, and ultimately free it again. It’s as simple as that. On a sidenote, there is a page which won’t be switched by MemMan. Page 3 contains, except for the MemMan code itself, also the stack (usually), and a large amount of system variables. There are quite some difficulties when switching all that away.</p>


<p class="page">13</p>


<h2>Function description MemMan 2.2</h2>

<p>MemMan functions can be executed through a call of the ‘Extended BIOS’, or the EXTBIO hook, on address #FFCA. Memman’s device ID - ‘M’, or #4D - must be placed in register D. Register E has to contain the MemMan function number. After calling a MemMan function all registers can be expected to have changed, except in case the opposite is mentioned at the function description.</p>

<p>Since the EXTBIO hook is also used for several system extensions like Kanji and RS232 interfaces, it is possible that the MemMan function will be processed very slowly. The performance of the MemMan applications can be noticably increased by calling MemMan’s function handler directly, instead of through the EXTBIO hook. The address on which the function handler can be called, can be inquired through the info function (50).</p>

<p>Most MemMan functions are located within a separate memory segment in page 1. These functions switch to an internal stack, so that MemMan applications can suffice with a relatively small stack. A MemMan function will at most place 20 additional bytes on the application’s stack. This will however not be the case if the function is called directly, or through the MemMan function handler.</p>

<p>A function call through the EXTBIO hook can however require an extremely large stack. This is caused because all expansion modules which are linked to the EXTBIO hook are called, until one module recognizes the function call. If inbetween also an interrupt occurs, the stack usage can increase strongly. All in all, the guideline for the required stack space when calling the EXTBIO hook is a minimum of 150 bytes.</p>

<p>It is therefor wise to retrieve the address of the routine which handles the MemMan function calls. If this function is called directly, the processing speed will increase, and the stack usage will remain limited.</p>

<p>After a MemMan function call, in most cases the interrupt settings will remain unchanged. Some functions however, like the several (Fast)Use functions always disable the interrupts. This property is for example of importance for a TSR program which only has a very small stack available. As long as the interrupts are disabled, all MemMan functions can be executed without problems, on the condition that MemMan’s function handler is called directly. If the interrupts are however enabled, a large stack is required, because the interrupt-handler places several tens of bytes on the stack.</p>


<p class="page">14</p>


<pre class="func">
Name:     Use0
Number:   0
Function: Enabling a segment on page 0 (address range #0000..#3FFF)
In:       HL = segment code
Out:      A = result code (-1 = failed, 0 = succeeded)
</pre>

<p>Enabling a segment on page 0 is only possible if the segment contains the standard MSX slotswitching entry points.</p>

<p>Remark: This functions may not be called through the EXTBIO hook. This function may only be called through a direct call of the MemMan function handler, or the FastUse0 function. The addresses on which these routines can be called, can be obtained through the Info function (50).</p>


<pre class="func">
Name:     Use1
Number:   1
Function: Enabling a segment on page 1 (address range #4000..#7FFF)
In:       HL = segment code
Out:      A = result code (-1 = failed, 0 = succeeded)
</pre>

<p>Remark: This functions may not be called through the EXTBIO hook. This function may only be called through a direct call of the MemMan function handler, or the FastUse1 function. The addresses on which these routines can be called, can be obtained through the Info function (50).</p>


<pre class="func">
Name:     Use2
Number:   2
Function: Enabling a segment on page 2 (address range #8000..#BFFF)
In:       HL = segment code
Out:      A = result code (-1 = failed, 0 = succeeded)
</pre>

<p>Remark: This functions may not be called through the EXTBIO hook. This function may only be called through a direct call of the MemMan function handler, or the FastUse2 function. The addresses on which these routines can be called, can be obtained through the Info function (50).</p>


<p class="page">15</p>


<pre class="func">
Name:     Alloc
Number:   10
Function: Allocate a segment
In:       B = Segment preferrence code
Out:      HL = Segment code (0000 = no free segments)
          B = Segment type code (-1 = FSEG, 0=PSEG)
</pre>

<p>Segment preferrence code overview (register B):</p>

<pre>
Bit 7 6 5 4 3 2 1 0
    ^ ^ ^ ^ ^ ^ ^ ^
    | | | | | | | |
    | | | | | | +-+-- Segment Type. 00 = PSEG0000
    | | 0 0 0 0                     01 = PSEG4000
    | |                             02 = PSEG8000
    | |                             03 = FSEG
    | +-------------- 1 = Prefer TPA (in other words, the
    |                      standard MSXDOS RAM slot)
    +---------------- 1 = Prefer unexpanded (hence, fast) slot
</pre>

<p>Bits 5-2 are unused and must be 0.</p>

<p>In case a PSEG type segment was allocated but is not available - if possible - an FSEG will be used instead.</p>


<pre class="func">
Name:     SetRes
Number:   11
Function: Give a segment the reserved-status
In:       HL = segment code
</pre>

<p>Gives a segment the ‘reserved’-status, so that the segment won’t automatically be freed after calling the IniChk routine. Usually, programs won’t have to set the reserved status, unless it wants to retain the segment after it terminates - like for example a Ramdisk -.</p>


<pre class="func">
Name:     DeAlloc
Number:   20
Function: Free a segment
In:       HL = segment code
</pre>

<p>On termination of a program this function is to be used to give all allocated segments back to MemMan. The eventual reserved status of the to be returned segment will automatically be cancelled. Segments which are also controlled by DOS2, will also be available through the DOS2 mapper routines again.</p>


<p class="page">16</p>


<pre class="func">
Name: ClrRes
Number: 21
Function: Cancel the reserved status of a segment
In: HL = segment code
</pre>

<p>It is not necessary to call this function right before DeAlloc. The DeAlloc will cancel the Reserved status of the segment by itself.</p>


<p class="page">17</p>


<pre class="func">
Name:     IniChk
Number:   30
Function: Initialization of MemMan before a program
In:       A = Control code
Out:      A = Control code + ‘M’
          DE = Version number (format: version #D.E)
</pre>

<p>This routine adds the ASCII value of the letter ‘M’ to the contents of register A. Because of this, a MemMan availability check can be performed. As for the rest, an unCrash is executed, and the segment codes of the actively switched slots are calculated and stored for CurSeg.<br />
The IniChk function may only be called once by every MemMan application. The calling of IniChk has to occur before any other functions of MemMan are called. TSR programs may never call the IniChk function.</p>


<pre class="func">
Name:     Status
Number:   31
Function: Retrieve MemMan status information
Out:      HL = Number of available segments
          BC = Number of free segments
          DE = Number of segments which are controlled by both DOS2 and MemMan
          A  = Connected status of the connected hardware
               Bit  Function
               0    1 = DOS2 Mapper Support Routines available
               1-7  Reserved, always 0.
</pre>

<p>In case bit 0 of the connected status is set, the DOS2 memory management functions are present. The number of free segments can be lower than is indicated in register BC, because some segments are in use by DOS2 after MemMan’s installation - for example to install a RAM-disk.</p>


<pre class="func">
Name:     CurSeg
Number:   32
Function: Retrieve segment code of a page
In:       B = Page number (0, 1, 2, 3)
Out:      HL = Segment code
          A  = Segment type (-1 = FSEG, 0 = PSEG)
</pre>

<p>This routine will return the current segment code of one of the four pages.</p>


<p class="page">18</p>


<p>TSR programs may not use this function to retrieve the active segment in page 0. To save time, this setting will not automatically be determined and stored at every TSR call. The active segments in the pages 1 and 2 are however redetermined at every hook call, and can at all times be retrieved through this call. Because page 3 always contains the same segment, the segment code of page 3 is also always retrievable.</p>

<p>A faster alternative is the FastCurSeg routine. The address on which this routine can be called can be retrieved through the Info function (50).</p>


<p class="page">19</p>


<pre class="func">
Name:     StoSeg
Number:   40
Function: Store current segment status
In:       HL = Buffer address (9 bytes)
</pre>

<p>The for MemMan known segment codes of the actively enabled slots will be stored in the buffer. These segment codes are initially calculated by IniChk, and are updated later on by the Use functions. Hence, the saved status is not the current status, but the status know to MemMan. TSRs therefor can’t save the active status with this.</p>

<p>Remark: This function may not be called through the EXTBIO hook. This function may only be executed by a direct call of the MemMan function handler. The address on which this routine can be called, can be obtained through the info function (50).<br />
Ofcourse also the (Fast)CurSeg functions can be used to store the current segment status.</p>


<pre class="func">
Name: RstSeg
Number: 41
Function: Activate a stored segment status
In: HL = Buffer status
</pre>

<p>Re-activate the buffered segment-status and save it for CurSeg.</p>

<p>Remark: This function may not be called through the EXTBIO hook. This function may only be executed by a direct call of the MemMan function handler. The address on which this routine can be called, can be obtained through the info function (50).<br />
Ofcourse also the (Fast)CurSeg functions can be used to store the current segment status.</p>


<p class="page">20</p>


<pre class="func">
Name:     Info
Number:   50
Function: Provides information about amongst others
          the entry adddresses of certain MemMan functions
In:       B = Information number (0..8)
Out:      HL = Information
</pre>

<p>Information number overview. The corresponding MemMan function codes are between brackets.</p>
<ol type="1">
<li value="0">Entry address of FastUse0 (function 0)</li>
<li value="1">Entry address of FastUse1 (function 1)</li>
<li value="2">Entry address of FastUse2 (function 2)</li>
<li value="3">Entry address of TsrCall (function 63)</li>
<li value="4">Entry address of BasicCall</li>
<li value="5">Entry address of FastCurSeg (function 32)</li>
<li value="6">Entry address of MemMan’s function handler</li>
<li value="7">MemMan’s version number, format: version #H.L</li>
<li value="8">Entry address of XTsrCall (function 61)</li>
</ol>


<p>The abovementioned function addresses may be directly called by an application or a TSR. All entry addresses are guaranteed to be in page 3.</p>

<p>The functions will be executed swiftly because the MemMan CALL to the EXTBIO hook is left out, and because the function codes in registers D and E won’t have to be examined. Another advantage is that parameters can also be passed through the DE register, which is mainly of importance for the TsrCall and BasicCall functions.</p>

<p>For example, the initialization routine of a TSR can request the necessary function entry addresses through the INFO function and subsequently store those for later use in the TSR’s code, which will improve the TSR’s speed significantly.</p>

<p>An exact description of the above functions can be found at the MemMan function of which the number is given between the brackets.<br />
Keep in mind however that the ‘fast’ functions differ from the ‘normal’ MemMan functions on the following points:</p>

<dl>
<dt>fastUse0-2:</dt>
<dd>Selects a segment into a certain memory page. See the description at the MemMan ‘Use’ functions.</dd>

<dt>tsrCall:</dt>
<dd>Register [DE] will be passed to the TSR unchanged. This in contrary to the function 63 (TsrCall), register DE is in that case already occupied to pass the MemMan function number.</dd>

<dt>FastCurSeg:</dt>
<dd>No valid value will be returned in register [A]. The MemMan CurSeg function (32) will indicate if it is an FSEG or a PSEG.</dd>

<dt>xTsrCall</dt>
<dd>All main registers (AF, BC, DE, HL) will be passed unchanged to the TSR. The TSR-ID code is to be placed in register IX.</dd>
</dl>


<p class="page">21</p>


<pre class="func">
BasicCall: Has no function number (address must be obtained through info)
Function:  Call a routine in the BASIC ROM.
In:        IX = Call address in page 0 or 1
           AF, BC, DE, HL are passed to the BASIC ROM
Out:       AF, BC, DE, HL are received from the BASIC ROM
           Interrupts are diabled
</pre>

<p>Through this function TSRs can call a routine which is in page 0 or 1 of the BASIC ROM. The bios must already be enabled in page 0. In page 1 the BASIC ROM will be enabled by MemMan.<br />
This is for example necessary to be able to call the math-pack routines which are situated in page 0 of the BASIC ROM, but which also call a few routines in page 1 inbetween. The H.STKE (stack error) hook will be bent, so that after an eventual BASIC error the internal MemMan stacks can be reset.</p>

<pre class="func">
memMan:   Has no MemMan function number (address must be obtained through info)
Function: Directly call a MemMan function
In:       E = Memman function number
          AF, BC, HL are passed to the function
Out:      AF, BC, DE, HL are received from the function
</pre>

<p>A call to this routine will have the same effect as calling a MemMan function through the EXTBIO hook. However, because the call to the EXTBIO hook is skipped, the other expansions which are linked to this hook won’t be called. Because of this, the stack usage will be limited, and the processing speed will be increased.</p>


<p class="page">22</p>


<pre class="func">
Name:     XTsrCall
Number:   61
Function: Call the driver-entry of a TSR
In:       IX = ID code of the to be called TSR
          AF, BC, DE, HL will be passed to the TSR
Out:      AF, BC, DE, HL will be returned from the TSR
</pre>

<p>This function is an improved version of the function TsrCall (63). Because this function can pass all main registers to the TSR, it is advised to use this function instead of function 63.
Remark: This function may not be called through the EXTBIO hook, because when calling through EXTBIO, the IX register is maimed. Therefor, call this function directly, or use the MemMan function handling routine. The addresses on which these routines can be called, can be obtained through the info function (50).</p>


<pre class="func">
Name:     GetTsrID
Number:   62
Function: Determine TSR ID code
In:       HL = Pointer to the TsrName (12 characters)
          Fill unused positions with spaces
Out:      Found: Carry clear (NC)
          BC = TSR ID code
          Otherwise: Carry set (C)
</pre>


<pre class="func">
Name:     TsrCall
Number:   63
Function: Call the driver-entry of a TSR
In:       BC = ID code of the to be called TSR
          AF, BC, DE, HL will be passed to the TSR
Out:      AF, BC, DE, HL will be returned from the TSR
</pre>

<p>Note that even though the DE register is passed to the TSR unchanged, it cannot be used for parameter input. This because MemMan’s Extended BIOS function code (D=‘M’, E=63) must be placed in that register.<br />
When using the Fast-TsrCall routine this complication does not arise; the address of this routine can be obtained through the Info (50) function.</p>


<p class="page">23</p>


<pre class="func">
Name:     HeapAlloc
Number:   70
Function: Allocate space in the heap
In:       HL = Desired amount of space (in bytes)
Out:      Sufficient free space: HL = start address
          Otherwise: HL = #0000
</pre>

<p>By means of this function a program can allocate a part of the memory. The block of memory is guaranteed to be located in page 3.<br />
The heap is mainly useful for TSR programs, which for example can use it as a temporary or permanent disk buffer. Also other buffers - of which it is absolutely necessary that they are located in page 3 - can be placed on the heap.<br />
Requested blocks of memory in the heap will stay unusable for other programs until a ‘HeapDeAlloc’ is executed (function 71).<br />
The heap’s size can be set by using the configuration tool CFGMMAN.</p>


<pre class="func">
Name:     HeapDeAlloc
Number:   71
Function: Frees previously allocated heap space
In:       HL = start address of the space
</pre>


<pre class="func">
Name:     HeapMax
Number:   72
Function: Return the length of the largest free block of heap space
Out:      HL = Length of the largest free block
</pre>


<p class="page">24</p>


<h2>Stack usage in MemMan</h2>

<p>MemMan applications are supposed to keep the stack pointer preferrably in page 2 or 3 (between #8000 and #FFFF). This because in case MemMan is activated by means of a hook call, the current segment in page 1 (#4000 to #8000) will be switched away to make place for the TSR-Manager and the TSRs. In case the stack is located in page 1 at that time the computer will crash.</p>

<p>In case TSRs are called after a BDOS call or through an interrupt via a BIOS-hook no stack problems will occur; not even when the application’s stack is located in page 1. This because the BDOS and interrupt functions use their own stack in page 3. Therefor at the time the hook is called the stack is also located in page 3.</p>

<p>Existing CP/M and MSX-DOS programs can therefor be used with MemMan 2 without problems - but only if the standard BDOS calls are used. If however a BIOS routine is called directly through an interslot call, the stack will have to be in page 2 or 3. In that case reserve at least 150 bytes for it.</p>

<h2>BIOS calls from Turbo Pascal</h2>

<p>If a Turbo Pascal program uses interslot-calls to the BIOS, it is important that the stack is located in page 2 or 3. At the moment the BIOS then calls a hook MemMan can safely activate the TSRs. The position of the stack depends on the maximum program address which is set in Turbo Pascal during compilation-time. In Turbo Pascal the stack is located directly below the variable memory. For programs which call the BIOS, the variable memory therefor has to be placed above address #8000.</p>

<p>When there is no source available, it is still possible to change the stack address of a Turbo Pascal program by means of a debugger. The initialization of a Turbo Pascal-program looks like this:</p>

<pre>
START:   JP INIT
         ...
         ...
INIT:    LD SP,#100
         LD HL,nn
         LD DE,nn
         LD BC,nn
         CALL yy
         LD HL,nn
         LD DE,stack     ;DE contains the stack address,
         LD BC,nn        ; it only needs to be adapted
         CALL zz         ; if it is lower than #80A0
         ...
</pre>

<p>The stack address in register DE can for example be set to #C100.</p>


<p class="page">25</p>


<h1>Calling TSRs using MemMan 2</h1>

<p>MemMan places TSR programs in memory segments which fall outside of the standard 64kB working memory of MSX-DOS. The calling of the TSRs therefor always happens through MemMan. The TSR calls can be devided into two categories: calling from hooks, and calling by applications.</p>

<p>In the hook-table of the TSR file is specified to which routines in the TSR the hooks should be bent. At the moment one of the bent hooks is called, MemMan will enable the segment in which the TSR is resident. Next, the routine which processes the hook-call will be called.</p>


<h2>Processing of hook-calls</h2>

<p>When writing routines which process a hook-call the following has to be taken into account.</p>

<p>TSRs are always called with the interrupts disabled. The interrupts should preferrably be enabled again as quickly as possible. That is why it is advised to start TSR routines with an EI-instruction.</p>

<p>MemMan only passes the registers AF, BC, DE and HL to the TSR unchanged.</p>

<p>The segment-layout of memory pages 0, 2 and 3 stays unchanged when calling the TSR. In page 1 the TSR’s segment is switched. TSRs may use the (fast-) CurSeg and Use functions to temporarily switch a segment in page 2.</p>

<p>The TSR manager places exactly one returnaddress on the stack. Directly below that the stack which was active at the moment the hook was called is situated, and the eventual registers which have been pushed on the stack by the BIOS.<br />
Note that hooks can also be bent by normal DOS-programs. When these programs bend the hook by using a JP instruction, there won’t be placed any additional return addresses. When the program sustains a copy of the hook and calls that subsequently, the stack will on entry of the TSR look exactly like described in the above alinea.<br />
Some programs however bend the hooks by using an RST 30H instruction, in other words, an interslot call. The interslot call routine places several data on the stack. When the program subsequently calls the hook which was installed by MemMan, the stack will be polluted by the interslot call with which the application was called. Such programs can’t be used in combination with TSRs which require a ‘clean’ stack.</p>


<p class="page">26</p>


<p>A TSR may only be left by jumping back to the TSR manager. Upon return to the manager after a hook-call a value needs to be placed in the shadow-register A'. The function of this is as follows:</p>

<pre>
Bit   Name      Function
 0    QuitHook  1 = Stop hook-processing
1..7  Reserved  Always 0
</pre>

<p>quitHook: This bit needs to be set to indicate that MemMan must not call the other TSRs and routines which are linked to the hook. By this it is possible to directly return from the TSR to the program which called the hook.<br />
This can for example be of use for a TSR which processes Basic-statements through the CMD-hook. In case the TSR doesn’t recognize the statement, it will have to restore the original data-registers, and have to return with the quitHook flag set. MemMan will then also call the other TSRs which are linked to the CMD-hook.<br />
In case the TSR however DID recognize and process the statement, the text-pointer will point to the start of the next statement. The other TSRs must then not be called, and it should directly jump back to the basic-interpreter. Setting the quitHook flag will suffice to accomplish that.</p>



<p>Example 1:</p>

<p>Say for exemple a TSR routine is linked to the interrupt-hook H.TIMI. This routine’s function is to increase a counter every interrupt. It could look like this:</p>

<pre>
INTTSR:  EI              ;This is the routine which increases
         LD HL,COUNT     ; a counter
         INC (HL)

         EX AF,AF'       ;Save register AF
         SUB A           ;Set quitHook flag and reset the other bits
         EX AF,AF'       ;Flag to A', restore AF
         RET             ;Return to TsrManager
</pre>


<p class="page">27</p>


<p>Example 2:</p>

<p>Say that a TSR is linked to the hook H.CHPUT. The BIOS routine CHPUT - which calls the hook H.CHPU - looks as follows:</p>

<pre>
CHPUT:   PUSH HL         ;Save data registers
         PUSH DE
         PUSH BC
         PUSH AF
         CALL H.CHPU     ;Call the CHPUT-Hook
         ...             ;Rest of the routine
</pre>

<p>When the H.CHPU hook is called, the stack which MemMan passes to the TSR will look as follows:</p>

<pre>
	(SP+0) = Return address to the TsrManager
	(SP+2) = Return address to the BIOS
	(SP+4) = AF
	(SP+6) = BC
	(SP+8) = DE
	(SP+10) = HL
	(SP+12) = Return address to the application routine
	(SP+14) = ...
</pre>

<p>When after execution of the TSR it directly needs to return to the application which the CHPUT routine called, the registers placed on the stack aswell as the return address to the BIOS must be removed from the stack. The return address to MemMan however needs to be retained. To do this you can put the following routine in the TSR:</p>

<pre>
CHARTSR: EI             ;This is the routine processing the H.CHPU call
         ...
         ...
         ...
         POP IX         ;Get the TsrManager's return address
         POP HL         ;Forget the return address to the BIOS
         POP AF         ;Restore registers
         POP BC
         POP DE
         POP HL

         EX AF,AF'      ;Store register AF
         LD A,1         ;set quitHook flag - stop hook processing
         EX AF,AF'      ;Flag in A', restore AF

         JP (IX)        ;Return via the TsrManager
</pre>


<p class="page">28</p>


<p>Note that the index- and shadow registers may be freely used by TSRs, they don’t need to remain unchanged. Upon entry and return from TSRs MemMan only passes the registers AF, BC, DE and HL intact. This because of the fact that the TSRs need to be called through an interslot call, which only retains the values of AF, BC, DE and HL.</p>


<p class="page">29</p>


<h2>Processing of TSR calls through TsrCall</h2>

<p>The second way in which TSRs can be called is through the MemMan function TsrCall (63). By using this function applications can let the TSR execute certain actions and exchange data with the TSR.</p>

<p>The header-table of the TSR file must contain the address of the routine which processes the TsrCall calls. For more info on this, see the chapter about the way stucture of TSR files. In case the TSR won’t be called through TsrCall, the routine must contain a simple RET instruction.</p>

<p>When writing routines which can be called through the MemMan TsrCall function, the following points have to be taken into consideration:</p>

<p>TSRs are always called with the interrupts diabled. The interrupts must preferrably be enabled as fast as possible. Therefore, it is advisable to start TSR routines with an EI instruction.</p>

<p>MemMan only passes the registers AF, BC, DE and HL are uchanged to the TSR. Note here that register BC is used to indicate the TsrID of the TSR, hence register BC can’t be used for input.</p>

<p>The segment-status of memory-banks 0, 2 and 3 remains unchanged when calling the TSR. In page 1, the segment in which the TSR is resident will be enabled. TSRs may, when they are called through TsrCall, use all available CurSeg and Use functions, to temporary select other segments.</p>

<p>At the moment the TSR is called via TsrCall one of MemMan’s internal stacks becomes active. This stack is situated in page 3 and is 160 bytes in size. This will be sufficient for most applications. Note however that this stack is also used during the execution of MemMan functions and eventual occurring interrupts. The available stack space is therefor always less than 160 bytes.</p>

<p>The TSR may only be left by jumping back to the TSR manager. The return-address to the manager is situated at the top of the stack, so executing a RET instruction will in most cases suffice. No flag-values need to be passed to the manager, only the registers AF, BC, DE and HL are passed back unchanged to the program which executed TsrCall.</p>


<p class="page">30</p>


<h2>Function calls by TSRs</h2>

<p>MemMan functions can be called in three ways. Through the EXTBIO hook (address #FFCA), through the function handler in page 3, and by directly calling one of the so-called ‘fast’ routines. It is strongly advised to avoid calls through the EXTBIO hook as much as possible. A call to EXTBIO can - when a lot of extensions are linked to the hook - uses a lot of stack space and is processed rather slow. Also, when calling EXTBIO the stack is required to be in page 3. When calling MemMan functions through the function handler it is also permitted for the stack to be in page 2.<br />
It is strongly advised to request the function handler’s address in the TSR’s initialization routine. This can be done by calling the Info (50) function through the EXTBIO hook. The other MemMan function calls can then be called from the function handler, instead of through the EXTBIO hook.<br />
TSR programs may never use the function IniChk (30). Not during initialization, not during a call via a hook or the function TsrCall.</p>


<h2>Calls to the Main-ROM</h2>

<p>Calling routines in the BIOS-ROM is no problem at all. For this the interslot-call routine on address #1C or #30 can be used. When a TSR is called from a hook, usually the BIOS-ROM will already be active in page 0. It is however possible that a (DOS) application already has bent the hook and switched its own routines in page 0. It is therefor not safe to expect the BIOS-ROM always to be active and being able to be called with a simple CALL instruction.</p>

<p>However, when a TSR is linked to a hook with which Basic statements can be expended, one can expect there are no DOS programs active on the same hook. So in that case, routines in the BIOS-ROM can be called through a simple call.</p>

<p>To call routines which are situated in the Basic-ROM - which is located at both page 0 and 1 -, one needs to use a special MemMan function: BasicCall. This function switches the segment in which the TSR is located temporarily away and places the Basic-ROM in page 1.<br />
When for example a Basic-ROM routine - like for example a Math-Pack function - in page 0 is called by means of an interslot call, the system will crash. That is because Basic-ROM routines like that also call subroutines in page 1. At that moment, clearly the Basic-ROM must also be active in page 1.<br />
Memman’s BasicCall-function is fit to solve such problems. Before calling the desired routine in the Basic-ROM, the ROM will be switched into page 1, so that calls to every location in the Basic-ROM will be executed correctly.<br />
The specifications of the BasicCall function can be found in the function specifications of MemMan, at the Info function.</p>


<p class="page">31</p>


<h1>TSR files: Background</h1>

<p>When developing MemMan 2 and the TSR file structure, the idea was to make TSRs both easy to develop as well as easy to use. Everyone who can create assembly programs for the MSX, should also be able to write TSRs, and everyone who can use MSX programs, should also be able to install TSRs. We think that MemMan 2 reasonably well satisfies these basic principles. However, a TSR still differs from a normal assembly program on several ways.</p>


<h2>REL-Tabel</h2>

<p>The TSRs can be loaded by TsrLoad on every random place in page 1 (address range #4000 to #7FFF). To do that, the TSR loaded uses a table with all program-relative addresses. This table is automatically placed into the TSR file by the program LinkTsr.</p>

<p>The necessary information to be able to load machinecode on a random address is derived from a so-called relocatable file. TSRs must therefor be programmed with an assembler which can create ‘relocatable’ files, ‘.REL’-files. Assemblers which can do this are amongst others GEN80 from HiSoft’s DEVPAC2 packet and M80 from Ascii’s MSX-DOS tools.</p>

<p>A linker is usually used to link several REL files to one COM-file which must be started from a fixed address. All information concerning the necessary changes within the code is at that moment used by the linker and won’t be available in the COM-file.</p>

<p>In order to retain that information MST created the abovementioned TSR linker: LinkTsr or LT.COM. This linker links several REL-files, just like a normal linker would do. The TSR linker however stores all program-relative addresses and places these in a separate table within the final TSR file. Creating the REL-table is done entirely automatically, the exact structure and position of the REL-table is of no importance.</p>


<h2>Initialization code</h2>

<p>Every program has a piece of initialization code, and so have most TSRs. This code is only used once and is pretty much obsolete after that. In order to be able to easily remove the initialization code after usage the TSR loader uses a trick. The initialization code is always placed at the end of the TSR program. Right before the TsrLoader connects the TSR to the hooks, the initialization code is being called. After executing that code, the memory which was occupied by it will be freed again to be used in other TSRs. The necessary amount of memory will that way be limited to a minimum.</p>


<p class="page">32</p>


<h2>Hook-table</h2>

<p>The TSRs can be linked to the hooks in the system memory. Within the TSR file a table must be put in which it mentions which hooks are used by the TSR and to which routine it should jump if one of those hooks is called. Just like the REL-table the hook-table is used by the Loader during the TSR’s installation. These tables won’t be contained in the TSR’s final code and therefor won’t use any memory in the TSR program segment. It is not possible to bend additional hooks after the TSR installation.</p>

<p>The hook-table starts with two bytes which indicate the table’s length. Then determining the table length these two bytes are also counted in. The hook-bending data is placed after the length word. Every element in the hook table is four bytes long. The first two bytes of the element indicate the address of the to-be-bent hook, and the next two bytes indicate the address of the routine which should be called when the hook is called.</p>


<h2>Header table</h2>

<p>Every TSR starts with a special table: the so-called file header. Depending on this header the TsrLoader can determine the position of the TSR’s program code and the tables in the file.</p>

<p>Every TSR listing is therefor supposed to start with the header table. The contents of this table is as follows:</p>

<pre>
	defb 'MST TSR',13,10	;TSR file ID
	defb 'MSTs TSRname'	;TSR naam
	defb 26			;End of text mark
	defw 0002		;Versie nummer voor TsrLoad
	defw tsrStart		;Base-address
	defw init		;Start initialization code
	defw kill		;Destruction code
	defw talk		;Interaction code
	defw tsrLen		;Length of TSR code
	defw iniLen		;Length of init code
</pre>

<p>The meaning of the elements in the header table is as follows:</p>

<ul>
<li><b>MST TSR file ID, 9 bytes</b><br />
This identification text lets TsrLoad recognize if it is handling a TSR file. Hence, this string may not freely be chosen by the TSR programmer.</li>

<li><b>TSR name, 12 bytes</b><br />
An as unique as possible ID-text chosen by the programmer. Applications can communicate with the TSR by using this name. Unused positions must be filled with spaces.</li>
</ul>


<p class="page">33</p>


<ul>
<li><b>End of text mark, 1 byte</b><br />
Finally there should always be Control-Z (^Z), in case the TYPE commando is let loose on the TSR program code.</li>

<li><b>Mandatory TSR-Loader version number, 2 bytes</b><br />
The loader checks this number to avoid an older loader reading a file which has a noncompatible structure. The TSR loader is upwards compatible, so that TSRs of a previous MemMan version can also be installed. Users can then suffice with replacing the loader and keep using the same TSRs.<br />
The version numer is 0001 in case the TSR only calls MemMan 2.1 functions. In case it also uses the specific MemMan 2.2. functions, the version number 0002 has to be placed in the header.</li>

<li><b>TSR program code base address, 2 bytes</b><br />
This is the address of the first byte of the TSR program code. This is always the first byte after the TSR file’s header. This value is used by the loader to adapt the program-relative addresses.</li>

<li><b>Initialization address, 2 bytes</b><br />
Is called during the installation of the TSR. The init-routine MUST be placed at the end of the TSR, so that the loader can easily free the occupied space after the TSR has been installed.</li>
</ul>

<p>After calling the initroutine must return a flag in register A. The definition of this flag register is as follows:</p>

<pre>
Bit   Function
 0    0 = Initialization succeeded
      1 = Initialization failed
 1    0 = No intro text
      1 = Pointer to intro-text in DE
2..7  Reserved, always 0
</pre>

<p>In case the TSR initialization routine indicates with bit 0 of the A register that the installation has failed, the TSR loader will remove the entire TSR. If the TSR indicates with bit 1 that there is an intro text, this is displayed by the TSR-Loader. TSRs themselves may never print text on the screen. This makes it possible to in the future also print the intro text in a graphical environment. Also the repressing of intro texts will then be easier. The intro-text is to be ended with a 0-byte.</p>

<p>The hooks will only be initialized after calling the initialization routine.</p>

<ul>
<li><b>Destruction address, 2 bytes</b><br />
Is called by the program TsrKill when removing the TSR. This routine is supposed to free the memory - segments or heap space - which is requested at MemMan. At the moment this routine is called the hooks have already been uncoupled.</li>
</ul>

<p class="page">34</p>


<ul>
<li><b>Interaction address, 2 bytes</b><br />
Is called by applications, through MemMan’s TsrCall function</li>

<li><b>TSR code length, 2 bytes</b><br />
This length concerns the TSR program code, without the initialization routine</li>

<li><b>Initialization routine length, 2 bytes</b><br />
The initialization routine is located at the very end of the TSR, and will upon initialization of the TSR be put in the same segment as the TSR code itself. The space the initialization routine occupies will be freed afterwards.</li>
</ul>


<h2>File Structure</h2>

<p>Every TSR program consists of parts which all have to be placed in a fixed
position in the source file. These parts are:</p>

<ul>
<li>Header table</li>
<li>TSR program code</li>
<li>TSR initialization code</li>
<li>Hook table</li>
</ul>

<p>This order has to be followed strictly. In most cases the entire TSR will
only consist of one REL-file which is linked in one pass. In that case the
programmer only has to take care that the elements are placed in the right order
in the source listing. In case the TSR is built from multiple REL files, they
are loaded and linked in the specified order, the TSR linker does not check for
this.</p>

<p>The file TSRFRAME.GEN on the TSR development disk contains the framework of a
TSR listing. If you use this framework as a basis when writing a new TSR it is
easy to retain the correct structure.</p>


<p class="page">35</p>




<?php addFooter(); ?>
</body>
</html>