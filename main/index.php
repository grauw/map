<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="description" content="The MSX Assembly Page is a central source for MSX programming information in various languages, though mainly assembly. It contains articles on several topics, programming resources, sources, software downloads and links to some other good MSX programming sites." />
  <meta name="keywords" content="MSX, Assembly, Basic, programming, byte, bit, word, ld, jp, fast loop, keyboard, samples, multiplication, division, RAM, ROM, BIOS, SUBROM, MSX-DOS, I/O, Port, Z80, R800, VDP, TMS9918, V9938, V9958, V9990, Graphics9000, Gfx9000, PSG, AY-3-8910, SCC, MSX-Music, FM-PAC, OPLL, YM2413, MSX-Audio, Music Module, OPL1, Y8950, Moonsound, OPL4, MSX Engine, S3527, S1985, S1990, Sunrise, IDE, Novaxis, SCSI, PPI, RTC, MemMan" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>

<h1>Introduction</h1>

<div class="updates">
<h2>Latest updates:</h2>

<p><em>2007-06-29</em><br />
Moved JoyNet documentation to the MAP, and cleaned up, updated and merged text (<a href="/resources/joynet/">link</a>). Updated Funet links, added MSX mailinglist archive links.</p>

<p><em>2006-12-07</em><br />
Added Tanni’s ‘A taste of VHDL’ tutorial (<a href="/articles/taste_of_vhdl.php">link</a>).</p>

<p><em>2005-06-01</em><br />
Added information to the PSG samples article about its logarithmic volume scale, and how to play 8-bit samples on the PSG (<a href="/articles/psg_sample.php">link</a>). Thanks go to Arturo Ragozini for pointing this out.</p>

<p><em>2005-05-12</em><br />
Fixed cut-off values in some timings in the Z80 instruction set overview, and added undocumented and R800 instructions and timings (<a href="/resources/z80instr.php">link</a>). Also optimized the Div16 routine, thanks to Flyguille (<a href="/articles/mult_div_shifts.php">link</a>).</p>

<p><em>2005-03-18</em><br />
Added information about memory mapper, PPI and subslot select register to I/O ports overview (<a href="/resources/msx_io_ports.php">link</a>).</p>

<p><em>2005-02-10</em><br />
Added stub article with MSX Basic tips &amp; tricks (<a href="/articles/basic_tips_tricks.php">link</a>).</p>

<p><em>2005-01-03</em><br />
Added code of method to call SUBROM from MSX-DOS (<a href="/sources/callbios.php">link</a>). Additionally, added some slot-management related addresses to the System Variables overview (<a href="/resources/msxsystemvars.php">link</a>).</p>

<p><em>2004-10-15</em><br />
Added info about the #6F register for the Gfx9000’s v7040 chip (<a href="/resources/msx_io_ports.php#gfx9000">link</a>).</p>

<p style="text-align: center">(<a href="/main/updates-old.php">Older updates</a>)</p>
<!-- Move outdated updates to updates-old.php!!! -->
</div>


<p>The goal of the <acronym title="MSX Assembly Page">MAP</acronym> is to be the ultimate source of information for the <abbr title="Machines with Software eXchangeability">MSX</abbr> programmer or programmer-to-be. The main target is assembly language, because that’s what the maintainers’ preferred programming language is, but most information will be useful to users of other languages as well. The MAP is currently maintained by <a href="/main/about/grauw.php">Grauw</a>, <a href="/main/about/bifi.php">BiFi</a> and GuyveR800.</p>


<h2>Where to start</h2>

<p>The site is divided into several sections, which you can select from at the top. 

The <a href="/articles.php">Articles</a> section contains several articles about several topics, ranging from tutorials for beginners to advanced programming techniques. <a href="/resources.php">Resources</a> contains a number of of technical references and datasheets. The <a href="/sources.php">Sources</a> section contains our collection of source code. This includes both short, common routines, which you might want to use in your program, aswell as the sources of several big well-known programs. In the <a href="/downloads.php">Download</a> section you will find several useful, even necessary, tools which are programming related. And finally, there is the <a href="/links.php">Links</a> section, with links to other development-related sites. Furthermore, if you have any MSX programming or MAP site related questions, you can ask them at the <a href="http://msxbanzai.tni.nl/dev/#msxdev">#msxdev @ Rizon IRC channel</a>.</p>

<p>Please note that <em>nothing of this page its content may be reproduced by any means without the prior permission of the MSX Assembly Page or the original author</em>. We have put a lot of effort in collecting all this information and also wrote a large number of the articles ourselves (being the ones marked with a <img src="/css/mapbullet.gif" alt="MAP bullet" /> bullet), and we ask everyone to respect our efforts and author’s rights. Ofcourse linking to us is always allowed. For more legal information read the <a href="/main/disclaimer.php">Disclaimer</a>.</p>

<p>The following documents be found in this section:</p>

<ul>
  <li><a href="/main/disclaimer.php">Disclaimer</a></li>
  <li><a href="/main/updates-old.php">Old updates</a></li>
  <li><a href="/main/planned.php">Planned articles</a></li>
  <li><a href="/main/styles.php">Style sheet selector</a></li>
  <!--<li><a href="/logs/">Statistics page</a></li>-->
  <li><a href="/main/moz-ff.php">Recommended browser: Firefox</a></li>
</ul>


<h2>Comments / Submit</h2>

<p>If you would like to see something added to this site, or if you have any comments about the content, feel free to email us about it! It is a tough job to do this all by ourselves, and we can make mistakes, and we don’t always know what’s best either. If you want to submit something for publication on this site, you can email it to us as well. Our contact address is <em>map&#64;tni.nl</em>.</p>

<p>If you want to contribute more directly to the map, like write articles about a certain subject, or digitize some documents, or making editorial changes yourself (which usually expedites the process of getting it online :)), we’d really appreciate it. The <a href="/main/contributing.php">Contributing</a> page explains how to get started with the source code.</p>


<br />
<p style="text-align: center">
  <!-- XHTML 1.1 compliance logo -->
  <a href="http://validator.w3.org/check/referer">
  <img style="border: 0;"
       src="http://www.w3.org/Icons/valid-xhtml11"
       width="88" height="31" alt="Valid XHTML 1.1!" /></a>

  <!-- Extreme Tracking logo -->
  <a href="http://t.extreme-dm.com/?login=msxasm">
  <img style="border: 0;"
       src="http://t1.extreme-dm.com/i.gif"
       width="41" height="38" alt="Extreme Tracker" /></a>

  <!-- CSS 2.1 compliance logo -->
  <a href="http://jigsaw.w3.org/css-validator/">
  <img style="border: 0;"
       src="http://jigsaw.w3.org/css-validator/images/vcss" 
       width="88" height="31" alt="Valid CSS!" />
  </a>
  <br />

This page is <a href="/main/moz-ff.php">best viewed</a> using Mozilla Firefox<br />

	<!-- Mozilla Firefox logo -->
	<a href="http://spreadfirefox.com/community/?q=affiliates&amp;id=341&amp;t=85">
	<img alt="Get Firefox!" title="Get Firefox!"
		style="border: 0; margin: 0.3em;" width="80" height="15"
		src="http://www.spreadfirefox.com/community/images/affiliates/Buttons/80x15/firefox_80x15.png"/>
	</a>

</p>

<p style="text-align: center;">MSX is a trademark of <a href="http://www.msxa.org/">MSX Association</a>.</p>



<?php addFooter(); ?>
</body>
</html>
