<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Articles - MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Articles</h1>

<p>This is a collection of articles about MSX programming. Most are written by us, the MAP maintainers, and can only be found here exclusively. Those are marked with a <img src="/css/mapbullet.gif" alt="MAP bullet"/> bullet. Please do not spread them without our permission but instead link to the MAP. If you have comments of any kind, perhaps you’ve discovered an error or you came up with an improvement for one of the routines / algorithms, or perhaps you want to submit an article of your own, then send us an email!</p>

<p>A short explanation of the several sections, the <a href="#tutorials">Tutorials</a> contain articles targeted at the beginning Assembler / Basic / etc. programmer, and the <a href="#articles">Articles</a> section contains articles targeted at the more experienced Assembly programmer.</p>

<ul>
<li id="tutorials">Tutorials
  <ul>
  <li id="tut_asm">Assembly programming
    <ul>
    <li class="map"><a href="/articles/vdp_tut.php">VDP programming tutorial</a></li>
    </ul>
  </li>
  <li id="tut_basic">Basic programming (also Hybride)
    <ul>
	  <li class="map"><a href="/articles/basic_tips_tricks.php">MSX Basic tips &amp; tricks</a></li>
	</ul>
  </li>
  <li id="tut_vhdl"><abbr title="VHSIC Hardware Description Language">VHDL</abbr> programming
    <ul>
    <li><a href="/articles/taste_of_vhdl.php">A taste of <abbr>VHDL</abbr></a></li>
    </ul>
  </li>
  <li id="tut_cpp">C(++) programming</li>
  <li id="tut_tp">Turbo Pascal programming</li>
  </ul>
</li>
<li id="articles">Articles
  <ul>
  <li id="art_asm">Z80 Assembly programming
    <ul>
    <li class="map"><a href="/articles/fast_loops.php">Fast loops</a></li>
    <li class="map"><a href="/articles/mult_div_shifts.php">Multiplications, divisions and shifts</a></li>
    </ul>
  </li>
  <li id="art_vdp">VDP programming
    <ul>
    <li class="map"><a href="/articles/vdp_guide.php">VDP programming guide</a></li>
    <li class="map"><a href="/articles/split_guide.php">Screensplit programming guide</a></li>
    <li class="map"><a href="/articles/vdp_commands_speed.php">VDP commands ~ speed measurements</a></li>
    <li class="map"><a href="/articles/scrolling.php">A guide to scrolling game engines on MSX</a></li>
    </ul>
  </li>
  <li id="art_other">Other topics
    <ul>
    <li class="map"><a href="/articles/keymatrix.php">Keyboard matrices</a></li>
    <li class="map"><a href="/articles/psg_sample.php">Playing samples on the PSG</a></li>
    </ul>
  </li>
  </ul>
</li>
<li id="extarticles">External Articles (non-MAP)
  <ul>
  <li id="ext_mccw"><a href="http://www.mccw.hetlab.tk/">MCCW (MCCM web magazine)</a>
    <ul>
    <li><a href="http://www.mccw.hetlab.tk/91/KANJI-stuff/en.html">MSX-Kanji revealed</a></li>
    <li><a href="http://www.mccw.hetlab.tk/91/msx1demos1/en.html">23 steps to high resolution on MSX1, part 1</a></li>
    <li><a href="http://www.mccw.hetlab.tk/92/msx1demos2/en.html">23 steps to high resolution on MSX1, part 2</a></li>
    <li><a href="http://www.mccw.hetlab.tk/92/Multiplication/en.html">Multiplication on a Z80</a></li>
    <li><a href="http://www.mccw.hetlab.tk/93/trmidi/en.html">MIDI interface of the GT</a></li>
    <li><a href="http://www.mccw.hetlab.tk/93/assemblyline1/en.html">Assembly Line</a></li>
    <li><a href="http://www.mccw.hetlab.tk/93/nestor/en.html">NestorTIPS for NestorBASIC</a></li>
    <li><a href="http://www.mccw.hetlab.tk/93/rotator/en.html">The zooming rotator</a></li>
    </ul>
  </li>
  <li id="ext_msxbanzai"><a href="http://msxbanzai.tni.nl/">MSX Banzai</a>
    <ul>
    <li><a href="http://msxbanzai.tni.nl/v9990/manual.html">Yamaha V9990 E-VDP-III Programmers Manual</a> (unofficial)</li>
    <li><a href="http://msxbanzai.tni.nl/dev/faq.html">Development FAQ</a></li>
    </ul>
  </li>
  <li id="ext_davidh"><a href="http://msx.gnu-linux.net/">David Heremans</a>
    <ul>
    <li><a href="http://msx.gnu-linux.net/doomlike/doomlike.html">How to program Doom on MSX</a></li>
    </ul>
  </li>
  <li id="ext_marmsx"><a href="http://marmsx.msxall.com/english.php">MARMSX</a>
    <ul>
	<li><a href="http://marmsx.msxall.com/artigos/sc12en.pdf">19268 colors on MSX 2+</a></li>
    </ul>
  </li>
  </ul>
</li>
</ul>




<?php addFooter(); ?>
</body>
</html>