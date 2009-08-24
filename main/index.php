<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:g="http://www.grauw.nl/g" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="description" content="The MSX Assembly Page is a central source for MSX programming information in various languages, though mainly assembly. It contains articles on several topics, programming resources, sources, software downloads and links to some other good MSX programming sites." />
  <meta name="keywords" content="MSX, Assembly, Basic, programming, byte, bit, word, ld, jp, fast loop, keyboard, samples, multiplication, division, RAM, ROM, BIOS, SUBROM, MSX-DOS, I/O, Port, Z80, R800, VDP, TMS9918, V9938, V9958, V9990, Graphics9000, Gfx9000, PSG, AY-3-8910, SCC, MSX-Music, FM-PAC, OPLL, YM2413, MSX-Audio, Music Module, OPL1, Y8950, Moonsound, OPL4, MSX Engine, S3527, S1985, S1990, Sunrise, IDE, Novaxis, SCSI, PPI, RTC, MemMan" />
  <?php addStyles(); ?>
  <script type="text/javascript" src="/js/email.js"></script>
</head>
<body onload="putEmail();">
<?php addHeader(); ?>

<h1>Introduction</h1>

<div class="updates">
<h2>Latest updates:</h2>

<p><em>2009-08-23</em><br />
Added “<a href="/articles/scrolling.php">A guide to scrolling game
engines on MSX</a>” article. Also made the <a href="/articles/mult_div_shifts.php#div">16-bit
division routine</a> 120 T-states faster, thanks to Juha N.</p>

<p><em>2009-03-27</em><br />
Added Zemina memory extensions to the <a href="/resources/msx_io_ports.php">I/O ports overview</a> and
added link to Cronos’s <a href="http://www.hqunix.com/wordpress/?page_id=554">manual scan / translation</a>,
thanks to Manuel Bilderbeek. Also added a <a href="/articles/mult_div_shifts.php#divby9">division by 9</a>
routine, thanks to Ricardo Bittencourt.</p>

<p><em>2009-03-09</em><br />
The MSX Assembly Page’s address has changed to <a href="http://map.grauw.nl/">http://map.grauw.nl/</a>. Source is now accessible in a <a href="http://hg.grauw.nl/map">public repository</a>, and introducing a <a href="/contributing/">Contributing</a> section.</p>

<p><em>2007-06-29</em><br />
Moved <a href="/resources/joynet/">JoyNet documentation</a> to the MAP, and cleaned up, updated and merged text. Updated Funet links, added MSX mailinglist archive links.</p>

<p><em>2006-12-07</em><br />
Added Tanni’s ‘<a href="/articles/taste_of_vhdl.php">A taste of VHDL</a>’ tutorial.</p>

<p><em>2005-06-01</em><br />
Added information to the PSG samples article about its logarithmic volume scale, and how to play <a href="/articles/psg_sample.php">8-bit samples on the PSG</a>. Thanks go to Arturo Ragozini for pointing this out.</p>

<p style="text-align: center">(<a href="/main/updates-old.php">Older updates</a>)</p>
<!-- Move outdated updates to updates-old.php!!! -->
</div>


<p>The goal of the <acronym title="MSX Assembly Page">MAP</acronym> is to be the ultimate source of information for the <abbr title="Machines with Software eXchangeability">MSX</abbr> programmer or programmer-to-be. The main target is assembly language, because that’s what the maintainers’ preferred programming language is, but most information will be useful to users of other languages as well. The MAP is currently maintained by <a href="/main/about/grauw.php">Grauw</a> and <a href="/main/about/bifi.php">BiFi</a>.</p>


<h2>Where to start</h2>

<p>The site is divided into several sections, which you can select from at the top. 

The <a href="/articles/">Articles</a> section contains several articles about several topics, ranging from tutorials for beginners to advanced programming techniques. <a href="/resources/">Resources</a> contains a number of of technical references and datasheets. The <a href="/sources/">Sources</a> section contains our collection of source code. This includes both short, common routines, which you might want to use in your program, aswell as the sources of several big well-known programs. In the <a href="/downloads/">Download</a> section you will find several useful, even necessary, tools which are programming related. And finally, there are the <a href="/links/">Links</a> section, with links to other development-related sites, and the <a href="/contributing/">Contributing</a> section for those who want to help improve the MAP. Furthermore, if you have any MSX programming or MAP site related questions, you can ask them at the <a href="http://msxbanzai.tni.nl/dev/#msxdev">#msxdev @ Rizon IRC channel</a>.</p>

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


<h2>Comments</h2>

<p>If you would like to see something added to this site, or if you have any comments about the content, feel free to email us about it! It is a tough job to do this all by ourselves, and we can make mistakes, and we don’t always know what’s best either. If you want to submit something for publication on this site, you can email it to us as well. Our contact address is <g:insertMail domain="grauw.nl" local-part="map">(enable JavaScript for email link)</g:insertMail>.</p>

<p>If you want to contribute more directly to the map, like write articles about a certain subject, or digitize some documents, or making editorial changes yourself (which usually expedites the process of getting it online :)), we’d really appreciate it. The <a href="/contributing/">Contributing</a> section explains how to get started with the source code.</p>


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



<?php addFooter(); ?>
</body>
</html>
