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

<p><em>2004-09-12</em><br />
Added Z80 instruction set reference (<a href="/resources/z80instr.php">link</a>). Also, linked to Funet source code repositories, and linkified <acronym title="(MSX-) Disk Operating System version 2">DOS2</acronym> reference table of contents.</p>

<p><em>2004-07-25</em><br />
Fixed Mult32 routine (<a href="/articles/mult_div_shifts.php">link</a>).</p>

<p><em>2004-06-23</em><br />
Added log functions with more detailed <abbr title="User Agent">UA</abbr> stats (<a href="/logs/">link</a>).</p>

<p><em>2004-05-26</em><br />
Updated key matrices article again (<a href="/articles/keymatrix.php">link</a>), and updated the I/O ports overview with <abbr title="Programmable Sound Generator">PSG</abbr> ports (<a href="/resources/msx_io_ports.php">link</a>).</p>

<p><em>2004-05-25</em><br />
Hosting all resources ourselves now, amongst others because unfortunately many of the documentation files on funet are broken. Also updated key matrices article (<a href="/articles/keymatrix.php">link</a>).</p>

<p><em>2004-05-24</em><br />
Added a stub article about the T9769B (<a href="/resources/engine/t9769b/">link</a>).</p>

<p><em>2004-04-21</em><br />
Added MARMSX's 19268 colors on <abbr title="Machines with Software eXchangeability">MSX</abbr> 2+ article to external articles (<a href="/articles/#extarticles">link</a>).</p>

<p><em>2004-04-09</em><br />
Redesigned site structure somewhat. If you linked or bookmarked one of the section indices, please update your links. Also added a style changer (<a href="/main/styles.php">link</a>).</p>

<p><em>2004-03-03</em><br />
On capable browsers (Firefox), the <acronym title="MSX Assembly Page">MAP</acronym> is now using true <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>.</p>

<p><em>2004-02-17</em><br />
Added Panasonic FS-A1FM's Modem <acronym title="Read Only Memory">ROM</acronym> info in I/O ports overview (<a href="/resources/msx_io_ports.php">link</a>). Also added link to MARMSX tools.</p>

<p><em>2004-02-09</em><br />
Got rid of the ?p= style linking. This should improve the indexing of the <acronym title="MSX Assembly Page">MAP</acronym> by search engines such as <a href="http://www.google.com/">Google</a>.</p>

<p><em>2004-02-06</em><br />
In the 'Multiplications and divisions using shifts' article (<a href="/articles/mult_div_shifts.php">link</a>), replaced the square root routine with a new (faster) one, thanks to Ricardo Bittencourt. Also added a link to the <abbr title="Machines with Software eXchangeability">MSX</abbr> Banzai <abbr title="Graphics 9000">Gfx9000</abbr> programmer's manual and Development <acronym title="Frequently Asked Questions">FAQ</acronym> in the external articles section. Finally, added the 'Z80 Bits' article kindly provided by Petr Petyovsky from the Sinclair scene, also in the external articles section.</p>

<p><em>2004-02-01</em><br />
Updated the 'Multiplications and divisions using shifts' article (<a href="/articles/mult_div_shifts.php">link</a>) with the following: fixed bugs in Div16 and renamed it to Div15 because the divider could only be 15 bits max; there is a new Div16 available offering support for all 16 bits. Also changed Mult12 unrolled version's routine name to Mult12U, and optimized the ld l,0 here aswell. Furthermore, added a square root Sqr16 routine by Arjan Bakker (based on the one published in <abbr title="MSX Computer &amp; Club Magazine">MCCM</abbr>). And finally, re-calculated all timing figures to include M1 wait states</p>

<p><em>2004-01-19</em><br />
Applied gamma correction to the screen 8 palette from yesterday's update, to make it <abbr title="Standard Red Green &amp; Blue">sRGB</abbr>, and updated the article again (<a href="/articles/vdp_guide.php#screen8col">link</a>). Thanks to Maarten ter Huurne.</p>

<p><em>2004-01-18</em><br />
Replaced the screen 8 palette file with one with the 'proper' colours for Blue. Also wrote a little explanation why in the <abbr title="Video Display Processor">VDP</abbr> programming guide article (<a href="/articles/vdp_guide.php#screen8col">link</a>). Updated the downloads section aswell with some new tools.</p>

<p><em>2003-10-04</em><br />
Added the Japanese keyboard layout (<a href="/articles/keymatrix.php#jap">link</a>). Thanks to Manuel Bilderbeek.</p>

<p><em>2003-08-27</em><br />
Updated the keyboard matrices article, and added the Russian keyboard layout (<a href="/articles/keymatrix.php">link</a>). For that, many thanks to Stanislav Borutsky.</p>

<p><em>2003-08-05</em><br />
Added an 'external articles' section and put up a couple of links to amongst others interesting articles on <abbr title="MCCM Web">MCCW</abbr>.</p>

<p><em>2003-07-15</em><br />
Wrote a resource about I/O ports on <abbr title="Machines with Software eXchangeability">MSX</abbr> (<a href="/resources/msx_io_ports.php">link</a>). Updated the resources section with a fair number of new documentation and added mirrors. Linked to a couple more sites in the links section. Also made the tables look a little prettier.</p>

<p><em>2003-04-24</em><br />
Updated the fast loops article (<a href="/articles/fast_loops.php">link</a>), added notice to the screensplit programming guide (<a href="/articles/split_guide.php">link</a>).</p>

<p><em>2003-04-23</em><br />
Official release of the <abbr title="Machines with Software eXchangeability">MSX</abbr> Assembly Page. Also removed the inactive forum section and replaced it with a new links section.</p>

<p><em>2003-04-05</em><br />
Did some work on the downloads section, introduced '<acronym title="MSX Assembly Page">MAP</acronym>' bullets (<img src="/css/mapbullet.gif" alt="MAP bullet"/>) to indicate MAP-authored documents.</p>

<p><em>2003-02-18</em><br />
Added article about playing samples on the PSG.</p>

<p><em>2003-02-03</em><br />
Added <abbr title="Machines with Software eXchangeability">MSX</abbr>-<acronym title="Disk Operating System">DOS</acronym>2 documentation. Updated <abbr title="Video Display Processor">VDP</abbr> commands speed test article.</p>

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