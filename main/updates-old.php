<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>Older Updates</h1>

<p><em>2005-03-18</em><br />
Added information about memory mapper, PPI and subslot select register to <a href="/resources/msx_io_ports.php">I/O ports overview</a>.</p>

<p><em>2005-02-10</em><br />
Added stub article with <a href="/articles/basic_tips_tricks.php">MSX Basic tips &amp; tricks</a>.</p>

<p><em>2005-01-03</em><br />
Added code of method to <a href="/sources/callbios.php">call SUBROM from MSX-DOS</a>. Additionally, added some slot-management related addresses to the <a href="/resources/msxsystemvars.php">System Variables overview</a>.</p>

<p><em>2004-10-15</em><br />
Added info about the #6F register for the <a href="/resources/msx_io_ports.php#gfx9000">Gfx9000’s v7040 chip</a>.</p>

<p><em>2004-09-12</em><br />
Added <a href="/resources/z80instr.php">Z80 instruction set reference</a>. Also, linked to Funet source code repositories, and linkified <abbr title="(MSX-) Disk Operating System version 2">DOS2</abbr> reference table of contents.</p>

<p><em>2004-07-25</em><br />
Fixed <a href="/articles/mult_div_shifts.php">Mult32 routine</a>.</p>

<p><em>2004-06-23</em><br />
Added <a href="/logs/">log functions</a> with more detailed <abbr title="User Agent">UA</abbr> stats.</p>

<p><em>2004-05-26</em><br />
Updated <a href="/articles/keymatrix.php">key matrices article</a> again, and updated the <a href="/resources/msx_io_ports.php">I/O ports overview</a> with <abbr title="Programmable Sound Generator">PSG</abbr> ports.</p>

<p><em>2004-05-25</em><br />
Hosting all resources ourselves now, amongst others because unfortunately many of the documentation files on funet are broken. Also updated <a href="/articles/keymatrix.php">key matrices article</a>.</p>

<p><em>2004-05-24</em><br />
Added a stub article about <a href="/resources/engine/t9769b/">the T9769B</a>.</p>

<p><em>2004-04-21</em><br />
Added MARMSX's 19268 colors on <abbr title="Machines with Software eXchangeability">MSX</abbr> 2+ article to <a href="/articles/#extarticles">external articles</a>.</p>

<p><em>2004-04-09</em><br />
Redesigned site structure somewhat. If you linked or bookmarked one of the section indices, please update your links. Also added a <a href="/main/styles.php">style changer</a>.</p>

<p><em>2004-03-03</em><br />
On capable browsers (Firefox), the <abbr title="MSX Assembly Page">MAP</abbr> is now using true <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>.</p>

<p><em>2004-02-17</em><br />
Added Panasonic FS-A1FM's Modem <abbr title="Read Only Memory">ROM</abbr> info in <a href="/resources/msx_io_ports.php">I/O ports overview</a>. Also added link to MARMSX tools.</p>

<p><em>2004-02-09</em><br />
Got rid of the ?p= style linking. This should improve the indexing of the <abbr title="MSX Assembly Page">MAP</abbr> by search engines such as <a href="http://www.google.com/">Google</a>.</p>

<p><em>2004-02-06</em><br />
In the <a href="/articles/mult_div_shifts.php">Multiplications and divisions article</a>, replaced the square root routine with a new (faster) one, thanks to Ricardo Bittencourt. Also added a link to the <abbr title="Machines with Software eXchangeability">MSX</abbr> Banzai <abbr title="Graphics 9000">Gfx9000</abbr> programmer's manual and Development <abbr title="Frequently Asked Questions">FAQ</abbr> in the external articles section. Finally, added the ‘Z80 Bits’ article kindly provided by Petr Petyovsky from the Sinclair scene, also in the external articles section.</p>

<p><em>2004-02-01</em><br />
Updated the <a href="/articles/mult_div_shifts.php">Multiplications and divisions article</a> with the following: fixed bugs in Div16 and renamed it to Div15 because the divider could only be 15 bits max; there is a new Div16 available offering support for all 16 bits. Also changed Mult12 unrolled version's routine name to Mult12U, and optimized the ld l,0 here aswell. Furthermore, added a square root Sqr16 routine by Arjan Bakker (based on the one published in <abbr title="MSX Computer &amp; Club Magazine">MCCM</abbr>). And finally, re-calculated all timing figures to include M1 wait states</p>

<p><em>2004-01-19</em><br />
Applied gamma correction to the <a href="/articles/vdp_guide.php#screen8col">screen 8 palette</a> from yesterday’s update, to make it <abbr title="Standard Red Green &amp; Blue">sRGB</abbr>, and updated the article again. Thanks to Maarten ter Huurne.</p>

<p><em>2004-01-18</em><br />
Replaced the screen 8 palette file with one with the ‘proper’ colours for Blue. Also wrote a little explanation why in the <a href="/articles/vdp_guide.php#screen8col"><abbr title="Video Display Processor">VDP</abbr> programming guide</a>. Updated the downloads section aswell with some new tools.</p>

<p><em>2003-10-04</em><br />
Added the <a href="/articles/keymatrix.php#jap">Japanese keyboard layout</a>. Thanks to Manuel Bilderbeek.</p>

<p><em>2003-08-27</em><br />
Updated the <a href="/articles/keymatrix.php">keyboard matrices article</a>, and added the Russian keyboard layout. For that, many thanks to Stanislav Borutsky.</p>

<p><em>2003-08-05</em><br />
Added an ‘external articles’ section and put up a couple of links to amongst others interesting articles on <abbr title="MCCM Web">MCCW</abbr>.</p>

<p><em>2003-07-15</em><br />
Wrote a <a href="/resources/msx_io_ports.php">resource about I/O ports</a> on <abbr title="Machines with Software eXchangeability">MSX</abbr>. Updated the resources section with a fair number of new documentation and added mirrors. Linked to a couple more sites in the links section. Also made the tables look a little prettier.</p>

<p><em>2003-04-24</em><br />
Updated the <a href="/articles/fast_loops.php">fast loops article</a>, added notice to the <a href="/articles/split_guide.php">screensplit programming guide</a>.</p>

<p><em>2003-04-23</em><br />
Official release of the <abbr title="Machines with Software eXchangeability">MSX</abbr> Assembly Page. Also removed the inactive forum section and replaced it with a new links section.</p>

<p><em>2003-04-05</em><br />
Did some work on the downloads section, introduced ‘<abbr title="MSX Assembly Page">MAP</abbr> bullets’ (<img src="/css/mapbullet.gif" alt="MAP bullet"/>) to indicate MAP-authored documents.</p>

<p><em>2003-02-18</em><br />
Added article about playing samples on the PSG.</p>

<p><em>2003-02-03</em><br />
Added <abbr title="Machines with Software eXchangeability">MSX</abbr>-<abbr title="Disk Operating System">DOS</abbr>2 documentation. Updated <abbr title="Video Display Processor">VDP</abbr> commands speed test article.</p>

<p><em>2003-01-22</em><br />
Updated the <abbr title="Video Display Processor">VDP</abbr> commands speed tests article, added downloads section.</p>

<p><em>2003-01-14</em><br />
Finished the screen split programming guide and the <abbr title="Video Display Processor">VDP</abbr> programming tutorial. Also put up BiFi's profile and made a couple of minor corrections.</p>

<p><em>2002-12-30</em><br />
New: a <abbr title="Video Display Processor">VDP</abbr> programming tutorial, a keymatrices article, a switch RAM in page 1 source, links to hardware application manuals (<abbr>OPL4</abbr> &amp; <abbr>v9990</abbr>), and a list of planned articles. Also rewrote the disclaimer and did some work on the layout.</p>

<p><em>2002-11-30</em><br />
Updated multiplications &amp; divisions article.</p>




<?php addFooter(); ?>
</body>
</html>