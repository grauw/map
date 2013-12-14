<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>JoyNet standard</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>


<h1>JoyNet standard</h1>

<div class="updates">
	<h2>Latest updates:</h2>

	<p><em>2007-07-02</em><br />
	<a href="#joywave">joywave.zip</a> and a newer version of <a href="#snafu">snafu.zip</a> were recovered from the depths of the internet thanks to <a href="http://www.icongames.com.br/msxfiles/" title="The MSX Files">SLotman</a>.</p>

	<p><em>2007-06-29</em><br />
	The JoyNet standard has moved to the MSX Assembly Page and has been cleaned up thoroughly. An effort was made to restore broken links. I also merged in text from MSX Core Club’s JoyNet page, which is no longer available on the internet.</p>
</div>

<p>The official specification page is <a href="http://map.grauw.nl/resources/joynet/">http://map.grauw.nl/resources/joynet/</a>.</p>

<p>JoyNet is a joystick port-based ring network standard that was created collaboratively on the <a href="http://lists.stack.nl/mailman/listinfo/msx">MSX Mailinglist</a> in 1999 (<a href="http://www.mail-archive.com/msx@stack.nl/info.html">archives</a>). It is compatible with the <a href="http://bifi.msxnet.org/msxnet/konami/cable/">F1-Spirit 3D Special network cable</a> when two computers are connected…</p>

<p>Thanks go to <em>Maarten ter Huurne, Alex Wulms, Sean Young, Werner 
Augusto Roder Kai, Patrick Lina, Maico Arts, Jeroen Smael, Laurens 
Holst</em> and all other people who contributed to the development 
of this standard.</p>

<p>Discussions about JoyNet are mainly being held on the 
<a href="http://lists.stack.nl/mailman/listinfo/msx">MSX Mailinglist</a>. 
If you have any additions, modifications, questions or replies concerning 
the information on this page, then send an email either to the MSX Mailinglist
or to the MAP’s contact-address.</p>

<h2 id="toc">Table of Contents</h2>

<ol>
	<li><a href="#schematics">JoyNet schematics</a>
		<ol>
			<li><a href="#cable">The JoyNet cable</a></li>
			<li><a href="#alternative">An alternative cable</a></li>
			<li><a href="#pc">JoyNet to PC cable</a></li>
		</ol>
	</li>
	<li><a href="#guidelines">JoyNet protocol guidelines</a></li>
	<li><a href="#suggestions">Opinions and Suggestions</a>
		<ol>
			<li><a href="#speed">The speed of JoyNet</a></li>
			<li><a href="#protocol-ideas">Some ideas for protocols</a></li>
			<li><a href="#interrupt">The interrupt-problem</a></li>
		</ol>
	</li>
	<li><a href="#q-and-a">Questions and answers</a>
		<ol>
			<li><a href="#sync-async">Synchonous or asynchronous</a></li>
			<li><a href="#alternate-ways">Alternative ways of communicating</a></li>
		</ol>
	</li>
	<li><a href="#software">Software</a>
		<ol>
			<li><a href="#tester">Test program</a></li>
			<li><a href="#tetrisclone">Tetris clone</a></li>
			<li><a href="#snafu">Snafu (1998)</a></li>
			<li><a href="#joywave">Joywave (1999)</a></li>
			<li><a href="#f16">F-16 Fighting Falcon (1984)</a></li>
			<li><a href="#connect">Connect (1990)</a></li>
			<li><a href="#f1spirit3d">F1 Spirit 3D Special (1991)</a></li>
			<li><a href="#magicallabyrinth">Magical Labyrinth (1995)</a></li>
			<li><a href="#wannabe">Wannabe-JoyNet games</a></li>
		</ol>
	</li>
</ol>


<h2 id="schematics">JoyNet schematics</h2>

<h3 id="cable">The JoyNet cable</h3>

<p>This section is normative.</p>

<p>A JoyNet network is a ring network between MSX computers via the joystick port. For every computer connected, one cable is needed. This cable has a DB9 connector on one end, and two DIN5 connectors on the other end (one male, one female). Both cables from the DB9 connector to the DIN5 connectors SHOULD be of equal size.</p>

<p>Following is a parts list for one JoyNet cable. Note that in order to link two MSX computers with standard JoyNet cables (as opposed to an Konami F1 Spirit 3D-style cable), you will need two cables.</p>

<ul>
	<li>One DB-9 female connector</li>
	<li>One DIN-5 180 female connector</li>
	<li>One DIN-5 180 male connector</li>
	<li>Eight pieces of flexible insulated thin wire</li>
</ul>

<p>There is no specified minimum or maximum length of the cable. Common sense suggests that shorter is better. Maarten ter Huurne has run some tests with cables of 2m between DB9 and DIN5 connectors (resulting in a total loop length of 8m). In these tests, while continuously sending 16k-blocks using his protocol, only after 2500 times of sending an error occurred. Refer to the
<a href="#suggestions">Opinions and suggestions</a> section for more details.</p>

<p>The three ends of this cable are denoted MSX, SEND and RECV, as follows:</p>

<pre>MSX (DB9 /f)
    -->
SEND (DIN5 180 /m)
RECV (DIN5 180 /f)
</pre>

<p>The MSX (DB9 /f) connector is connected as follows:</p>

<pre>pin - connection
  1 - RECV pin 1
  2 - RECV pin 2
  3 - SEND pin 3
  4 - nc
  5 - nc
  6 - SEND pin 1
  7 - SEND pin 2
  8 - RECV pin 3
  9 - SEND / RECV pin 5
</pre>

<p>The SEND (DIN5 180 /m) connector is connected as follows:</p>

<pre>pin - connection
  1 - MSX pin 6
  2 - MSX pin 7
  3 - MSX pin 3
  4 - nc
  5 - MSX pin 9
</pre>

<p>The RECV (DIN5 180 /f) connector is connected as follows:</p>

<pre>pin - connection
  1 - MSX pin 1
  2 - MSX pin 2
  3 - MSX pin 8
  4 - nc
  5 - MSX pin 9
</pre>

<p>An explaining diagram:</p>

<p><img src="joynetscheme.gif" width="400" height="150" /></p>



<h3 id="alternative">An alternative cable</h3>

<p>This section is normative.</p>

<p>The JoyNet cable is designed to form a ring network, but if you
connect two JoyNet cables, you get a cable that is identical to 
<a href="http://bifi.msxnet.org/msxnet/konami/cable/">Konami’s F1-Spirit 3D Special cable</a> 
(but different from the one used for of Blokslag, Zeeslag etc.).
When you only wish to connect 2 MSX-computers, this alternative cable can 
be used as well. Note however that 
the cable described in the section above is preferred, as it can form a network 
with more than two computers.</p>

<p>The two ends of this cable are denoted MSX1 and MSX2, as follows:</p>

<pre>MSX1 (DS9 /f)
    -->
MSX2 (DS9 /f)
</pre>

<p>The MSX1 (DB9 /f) connector is connected as follows:</p>

<pre>pin - connection
  1 - MSX2 pin 6
  2 - MSX2 pin 7
  3 - MSX2 pin 8
  4 - nc
  5 - nc
  6 - MSX2 pin 1
  7 - MSX2 pin 2
  8 - MSX2 pin 3
  9 - MSX2 pin 9
</pre>

<p>The MSX2 (DB9 /f) connector is connected as follows:</p>

<pre>pin - connection
  1 - MSX1 pin 6
  2 - MSX1 pin 7
  3 - MSX1 pin 8
  4 - nc
  5 - nc
  6 - MSX1 pin 1
  7 - MSX1 pin 2
  8 - MSX1 pin 3
  9 - MSX1 pin 9
</pre>

<p>An explaining diagram:</p>

<p><img src="joynetalt.gif" width="325" height="150" /></p>



<h3 id="pc">JoyNet to PC cable</h3>

<p>This section is normative.</p>

<p>A cable to connect a PC to a JoyNet network via the parallel port 
is also described. This cable can be used for many things, for example 
for JoyNet emulation on emulators, or for transferring data between an 
MSX and a PC.</p>

<p>The three ends of this cable are denoted PC, SEND and RECV, as follows:</p>

<pre>PC (DB25 /m)
    -->
SEND (DIN5 180 /m)
RECV (DIN5 180 /f)
</pre>

<p>The PC (DB25 /m) connector is connected as follows:</p>

<pre>  pin - connection
    2 - SEND pin 1
    3 - SEND pin 2
    4 - RECV pin 3
  xxx - nc
   10 - SEND pin 3
   11 - nc
   12 - RECV pin 2
   13 - RECV pin 1
  xxx - nc
18-25 - SEND / RECV pin 5
</pre>

<p>The SEND (DIN5 180 /m) connector is connected as follows:</p>

<pre>pin - connection
  1 - PC pin 2
  2 - PC pin 3
  3 - PC pin 10
  4 - nc
  5 - PC pin 18-25
</pre>

<p>The RECV (DIN5 180 /f) connector is connected as follows:</p>

<pre>pin - connection
  1 - PC pin 13
  2 - PC pin 12
  3 - PC pin 4
  4 - nc
  5 - PC pin 18-25
</pre>

<p>An explaining diagram:</p>

<p><img src="joynet2pc.gif" width="450" height="150" /></p>



<h2 id="guidelines">JoyNet protocol guidelines</h2>

<p>This section is normative.</p>

<p>This specification does not specify any JoyNet communication protocol. JoyNet
is a hardware standard, and delegates standardisation of a protocol to
a possible secondary standard. As long as the hardware follows JoyNet, 
the compatibility between two programs using the same protocol is guaranteed.</p>

<p>There are many ways to establish communication 
between computers, and the appliccable algorythm and the protocol may vary 
from case to case. So each programmer can use and designate the pins any
way he wants (e.g. <abbr title="Data 0">D0</abbr>, <abbr title="Acknowledge">ACK</abbr>,
<abbr title="Clock">CLK</abbr>, <abbr title="Clear to Send">CTS</abbr>, 
<abbr title="Input 0">IN0</abbr>, etc.).</p>

<p>However, there are still some guidelines which every protocol should deal with:</p>

<ul>
	<li>A protocol should implement a means of detecting the connection
		and how many computers are in the network.</li>
	<li>A protocol should be able to use JoyNet connected to joystick port 1 as well as 
		port 2, so that computers with problems on one of the 
		joystick-ports would still be able to use the software and JoyNet.</li>
	<li>A protocol should not hang the computer when the cable is 
		disconnected.</li>
</ul>



<h2 id="suggestions">Opinions and suggestions</h2>

<p>This section is informative.</p>

<p>For a lot of discussion about JoyNet, you can consult the 
<a href="http://www.mail-archive.com/search?l=msx%40stack.nl&amp;q=joynet">MSX mailinglist archives</a>.</p>

<p>Some <a href="alwintips.txt">additional thoughts</a> by Alwin Henseler.</p>

<p>MARMSX wrote an article in Portuguese about the <a href="http://www.eng.uerj.br/~marcelo/msx/artigos/joynetbasica.pdf">JoyNet Basics article</a> (<a href="joynetbasica.pdf">mirror</a>).</p>



<h3 id="speed">The speed of JoyNet</h3>

<p>Some test-results of <cite>Maarten ter Huurne</cite> using his own protocol.</p>

<blockquote cite="http://www.mail-archive.com/msx@stack.nl/msg02059.html">
	<p>I just made some routines for sending data between my PC and my 
	turbo R. The routines are as optimized as I could get them.</p>

	<p>Results:</p>
	
	<table>
		<tr>
			<th>PC → turbo R (R800 mode)</th>
			<td>14 kilobyte per second</td>
		</tr>
		<tr>
			<th>turbo R (R800 mode) → PC</th>
			<td>12 kilobyte per second</td>
		</tr>
		<tr>
			<th>PC → turbo R (Z80 mode)</th>
			<td>3.6 kilobyte per second</td>
		</tr>
		<tr>
			<th>turbo R (Z80 mode) → PC</th>
			<td>3.2 kilobyte per second</td>
		</tr>
	</table>	

	<p>To estimate the number of errors, I transferred the same 16K data 
	back and forth a lot of times. After 2500 transfers, an error occurred. 
	So I was able to send 16K * 2 * 2500 = 80,000K before the first error. 
	I think it’s safe to say that a 32 bit CRC is overkill… However, to 
	backup a harddisk, some simple error detection is necessary.</p>
</blockquote>

<p>Please keep in mind here that because Maarten used a PC for testing on one end, 
these speeds are likely closer to top speed than when two MSX computers would connect, 
for the PC can poll many times faster than the MSX resulting in better 
response times. Also, this is done with the JoyNet->PC-cable, so the conditions 
are different. But I still think this is a reasonable estimate.</p>

<p>Another thing to note is that MtH’s protocol uses 1 bit per transfer. 
If you are only communicating between 2 computers, it is possible to use a 
2-bit protocol, which will result in higher transfer rates.</p>


<h3 id="protocol-ideas">Some ideas for protocols</h3>

<p>Here we will suggest 4 protocols, one handshake-protocol and three 
transfer-protocols.</p>

<p><em>This section is incomplete.</em></p>


<h3 id="interrupt">The interrupt-problem</h3>

<p>When implementing a protocol, you will definitely come across the 
interrupt-problem. The problem here is, that on the MSX BIOS its interrupt
handler the pins of the joystickport are being reset.</p>

<p>One solution would be to turn off the MSX BIOS interrupt handling entirely. 
This however can not really be used in situations where you can not turn off the 
MSX BIOS’s interrupt handler, e.g. when creating a JoyNet driver for Basic.</p>

<p>Another solution would be to intercept the BIOS its joystick handling routines,
and annul them for joystick ports where a JoyNet connection is detected.</p>

<!--<p>I know 
two ways to prevent this, one simple one, which use is however quite 
limited, and one more difficult, but as soon it’s ready it is easier 
to implement into the rest of your program. Also, this second way can 
be used in Basic-programs.</p>-->


<h2 id="q-and-a">Questions and answers</h2>

<p>This section is informative.</p>

<h3 id="sync-async">Synchonous or asynchronous</h3>

<p><cite>Alwin</cite> wrote:</p>

<blockquote cite="http://www.mail-archive.com/msx@stack.nl/msg03894.html">
	<p>If JoyNet only standardises the cable, than that leaves the 
programmer free to choose for a synchronous or an asynchronous 
communication method.</p>
</blockquote>

<p><cite>Maarten ter Huurne</cite> responds:</p>

<blockquote cite="http://www.mail-archive.com/msx@stack.nl/msg02185.html">
	<p>It does.</p>
	
	<p>I just strongly recommend an delay-insensitive asynchronous communication
protocol, because that will give far less trouble. For example, it is
insensitive to cable lengths and it will run at any clock speed.</p>
</blockquote>

<h3 id="alternate-ways">Alternative ways of communicating</h3>

<p><cite>Alwin</cite> wrote:</p>

<blockquote cite="http://www.mail-archive.com/msx@stack.nl/msg03894.html">
	<p>I think you are both mistaken here. In synchronous communications, 
	the exact point in time at which the data signal(s) is sampled, is 
	determined by an ‘extra’ signal, an other signal, and with that, the 
	data stream is SYNCHRONISED with that other signal.</p>
</blockquote>

<p><cite>Maarten ter Huurne</cite> responds:</p>

<blockquote cite="http://www.mail-archive.com/msx@stack.nl/msg02185.html">
	<p>What you call an ‘extra’ signal, is just as much part of the signal as the
	data signals are. Dependant on the encoding, it may not even be possible to
	say “these bits are data and these bits are timing”.</p>
	
	<p>Take for example the encoding I proposed on this list a while ago:
	There are 2 signal bits: D0 and D1.</p>
	
	<p>Flipping of D0 means “a 0 is transmitted”.</p>
	
	<p>Flipping of D1 means “a 1 is transmitted”.</p>
</blockquote>

<p>And note that after that you can use the ACK-signal to notify the 
sender that the data is recieved.</p>


<h2 id="software">Software</h2>

<p>This section is informative.</p>

<h3 id="tester">Test program</h3>

<p>A JoyNet test-program (to test the cable) can be found on 
<a href="http://www.stack.nl/~mth/msx/hardware/">Maarten ter 
Huurne’s page</a> (<a href="http://web.archive.org/web/20021204054320/www.stack.nl/~mth/msx/joynet/">web.archive.org</a>). <a href="nettest1.txt">Source</a> and instructions how-to-use can also be 
found there.</p>


<h3 id="tetrisclone">Tetris clone</h3>

<p>Also, Maarten ter Huurne published the first beta of the 
JoyNet Tetris-clone he is making… It can once again be found 
on <a href="http://www.stack.nl/~mth/msx/joynet/">his JoyNet page</a> (<a href="http://web.archive.org/web/20021204054320/www.stack.nl/~mth/msx/joynet/">web.archive.org</a>).</p>


<h3 id="snafu">Snafu (1998)</h3>

<p><a href="snafu.zip">Download game with manual in English</a> - snafu.zip - 5 Kb (<a href="snafu-v1.zip">old version</a>)</p>

<p>This is a game like Tron or Laserbikes made by MSX Core Club. The name “Snafu”
originally came from an Intellivision version.
They made the first version specially for the MSX Jaú
’98 meeting (may 23,24). It was presented working just with two computers,
originally linked with two cables in both joystick ports, like the ones
used for F1 Spirit 3D Special. This first version is in BASIC with only
the communication routines in Assembly. <a href="joynet1.jpg">[picture]</a></p>

<p>For the MSX Jaú ’98+ (october 30, november 1,
2) we made a new version 100% in Assembly (except for the loader in BASIC…),
and we could test it with 4 MSX computers. <a href="jau98pp.jpg">[picture]</a></p>

<p>We repeated the presentation with 4 MSX computers at
the MSX Jaú ’99 meeting <a href="jau99-29.jpg">[picture]</a>,
and at the ExpoSAlt 2000 meeting we presented the game with 3 MSX computers.
Here is a video of the event: <a href="http://blip.tv/file/176053">link</a>,
<a href="http://dabble.com/node/9177273">link</a>.</p>

<p>Both versions support from 2 up to 14 MSX computers,
and only work in MSX computers with 3.58 Mhz clock.</p>

<p>MSX Core Club also has some <a href="http://mercury.spaceports.com/~coreclub/english/joyneten.htm">English JoyNet pages</a> (<a href="http://web.archive.org/web/20031205034044/http://mercury.spaceports.com/~coreclub/english/joyneten.htm">web.archive.org</a>).</p>


<h3 id="joywave">Joywave (1999)</h3>

<p><a href="JOYWAVE.ZIP">[Download]</a> - joywave.zip - 30 Kb</p>

<p>If you want to play big ".WAV" files on your MSX Turbo-R, but you don’t
have a hard disk, then this program is for you.
Using JoyWave, you can load a ".WAV" file directly from a PC connected
to your MSX through a Joynet cable.
Made by <a href="http://www.700km.com.br/mundobizarro/">Ricardo Bittencourt</a>, the author of <a href="http://en.wikipedia.org/wiki/BrMSX">BrMSX</a>.</p>


<h3 id="f16">F-16 Fighting Falcon (1984)</h3>

<p><a href="f16cart.jpg">[cartridge label]</a> - <a href="f16front.jpg">[box
front]</a> - <a href="f16back.jpg">[box back]</a> - <a href="f16man1.gif">[page 1]</a> - <a href="f16man2.gif">[page
2]</a> - <a href="f16man3.gif">[page 3]</a> - <a href="f16man4.gif">[page
4]</a> - <a href="f16man5.gif">[page 5]</a> - <a href="f16man67.gif">[pages
6 and 7]</a> - <a href="f16man8.gif">[page 8]</a></p>

<p>This is a combat flight simulator for MSX 1, published as a 16kb ROM cartridge.
To start the game you must press F1 or F2.
If you press F1 you select one player game (play against
computer), and then you can select the level with left and right and space
(or joystick at port 1).
If you press F2 you select two players game, to play
against an human opponent, and then you will need two MSX computers and
a JoyNet connection at the joystick port 2 of both MSX computers.</p>


<h3 id="connect">Connect (1990)</h3>

<p><a href="connect1.zip">[download files of disk 1 - 21 kb]</a>
- <a href="connect2.zip">[download files of disk 2 - 48 kb]</a></p>

<p>Connect is a software made to link only two MSX computers. One MSX computer
works as ‘master’ and the other as ‘slave’. It enables to the ‘master’
computer to acess the disk drives of the ‘slave’ computer. It was made
to enlarge the database of a MSX-based BBS from two up to four floppy disks,
because if you remember, at that time we didn’t have HD interfaces for
MSX. It was made by Ries Vriend. To run ‘Connect’ you will need a JoyNet
connection at the joystick port 2 of both MSX computers. But I didn’t tested
it yet because it’s all in Dutch… And I can’t understand Dutch…</p>


<h3 id="f1spirit3d">F1 Spirit 3D Special (1991)</h3>

<p>This is a two-disk formula one (F1) race game for MSX 2+ by Konami. 
You can play against computer in just a single race or
in a complete season, or select the combat mode to play against a human
opponent.</p>

<p>To play in "combat mode" you will need two MSX2+ computers
and a JoyNet connection at the joystick port 2 of both MSX computers.</p>

<p><a href="jau98pn.jpg">[picture of people at the MSX Jaú ’98+
meeting playing it in battle mode]</a></p>


<h3 id="wannabe">Wannabe-JoyNet games</h3>

<p>There are also a number of games that could use JoyNet, but unfortunately don’t.</p>

<h4>Triplex (199?)</h4>

<p>Triplex is a multiplayer Tetris game made for up to 15 players linked
through the MIDI interface of the Philips Music Module Cartridge (MSX Audio).
Possibly the communication routines could be changed, converting
it to the JoyNet standard.</p>

<h4>Magical Labyrinth (1995)</h4>

<p>Magical Labyrinth is a labyrinth game for up to 4 players made by Gigamix.
It is played in only one MSX with the screen splited into 4 parts, and
it needs an external hardware called "Ninja Tap Extended" to connect up
to 4 joysticks multiplexed into only one joystick port. It would be nice
if the people from Gigamix would make a JoyNet version of this game
for up to 4 MSX computers, but with full screen playing.</p>




<?php addFooter(); ?>
</body>
</html>