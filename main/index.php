<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
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

<p><em>2014-04-03</em><br />
Add links to Nestor Soriano’s great
<a href="http://map.grauw.nl/resources/#msxbios">MSX2 Technical Handbook
transscription</a>, and some clean-up.</p>

<p><em>2014-02-08</em><br />
Add link to Eugeny Brychkov’s excellent
<a href="http://map.grauw.nl/resources/#v9938">v9938 application manual
transscription</a>.</p>

<p><em>2013-01-13</em><br />
Added an English translation of the MSX Datapack Vol. 3’s
<a href="/resources/midi/msx-midi.php">MSX-MIDI</a> documentation.</p>

<p><em>2009-08-23</em><br />
Added “<a href="/articles/scrolling.php">A guide to scrolling game
engines on MSX</a>” article. Also made the <a href="/articles/mult_div_shifts.php#div">16-bit
division routine</a> 120 T-states faster, thanks to Juha N.</p>

<p><em>2009-03-27</em><br />
Added Zemina memory extensions to the <a href="/resources/msx_io_ports.php">I/O ports overview</a> and
added link to Cronos’s <a href="http://www.hqunix.com/wordpress/?page_id=554">manual scan / translation</a>,
thanks to Manuel Bilderbeek. Also added a <a href="/articles/mult_div_shifts.php#divby9">division by 9</a>
routine, thanks to Ricardo Bittencourt.</p>

<p style="text-align: center">(<a href="/main/updates-old.php">Older updates</a>)</p>
<!-- Move outdated updates to updates-old.php!!! -->
</div>


<p>The goal of the <acronym title="MSX Assembly Page">MAP</acronym> is to be the
ultimate source of information for the
<abbr title="Machines with Software eXchangeability">MSX</abbr> programmer or
programmer-to-be. The main target is assembly language, because that’s what the
maintainers’ preferred programming language is, but most information will be
useful to users of other languages as well. The MAP is currently maintained by
<a href="/main/about/grauw.php">Grauw</a> and
<a href="/main/about/bifi.php">BiFi</a>.</p>


<h2>Where to start</h2>

<p>The site is divided into several sections, which you can select from at the
top.</p>

<p>The <a href="/articles/">Articles</a> section contains articles about
topics ranging from tutorials for beginners to advanced programming techniques.
<a href="/resources/">Resources</a> contains technical references and
datasheets. The <a href="/sources/">Sources</a> section contains both short
and common reusable routines, as well as the sources of several big well-known
programs. In the <a href="/links/">Links</a> section you will find links to
other development-related sites and tools. And finally, there is the
<a href="/contributing/">Contributing</a> section for those who want to help
improve the MAP.</p>

<p>Please note that <em>this site’s content may not be redistributed without the
permission of the MSX Assembly Page or the original author</em>. We have put a
lot of effort in collecting all this information and also wrote a large number
of the articles ourselves (the ones marked with a <img src="/css/mapbullet.gif"
alt="MAP" /> bullet), and we ask everyone to respect our efforts and author’s
rights. Of course linking to us is always allowed. For more legal information
read the <a href="/main/disclaimer.php">Disclaimer</a>.</p>

<p>The following documents be found in this section:</p>

<ul>
  <li><a href="/main/disclaimer.php">Disclaimer</a></li>
  <li><a href="/main/updates-old.php">Old updates</a></li>
  <li><a href="/main/styles.php">Style sheet selector</a></li>
</ul>


<h2>Comments</h2>

<p>If you would like to see something added to this site, or if you have any
comments about the content, feel free to email us about it! It is a tough job to
do this all by ourselves, and we can make mistakes, and we don’t always know
what’s best either. If you want to submit something for publication on this
site, you can email it to us as well. Our contact address is
<g:insertMail domain="grauw.nl" local-part="map">(enable JavaScript for email
link)</g:insertMail>.</p>

<p>If you want to contribute more directly to the map, like write articles about
a certain subject, or digitize some documents, or making editorial changes
yourself (which usually expedites the process of getting it online :)), we’d
really appreciate it. The <a href="/contributing/">Contributing</a> section
explains how to get started with the source code.</p>


<?php addFooter(); ?>
</body>
</html>
