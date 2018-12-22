<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Older Updates - MSX Assembly Page</title>
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>Older Updates</h1>

<p><em>2015-07-14</em><br />
Added <a href="/resources/">MSX datasheet chapters</a> translated
by FRS, Takamichi and sandervn.</p>

<p><em>2015-03-05</em><br />
Added detailed R800 timing information to the
<a href="/resources/z80instr.php">Z80 instruction set overview</a>.</p>

<p><em>2015-01-20</em><br />
<a href="/articles/fast_loops.php">Fast loops</a>: Faster “mystery calculus”,
thanks to Urusergi.</p>

<p><em>2014-12-07</em><br />
Added <a href="/resources/sound/mp3player.pdf">Sunrise MP3 Player</a>
documentation courtesy Dennis Koller and Sander van Nunen.</p>

<p><em>2014-11-20</em><br />
<a href="/articles/fast_loops.php">Fast loops</a>: Corrected timing
calculations, replaced outdated example, disable interrupts in FastLDIR, and
copy editing.</p>

<p><em>2014-08-16</em><br />
Added <a href="/articles/vdp-vram-timing/vdp-timing-2.html">V9938 VRAM timings,
part II</a> by team <a href="http://openmsx.org/">openMSX</a>.</p>

<p><em>2014-07-26</em><br />
Added <a href="/articles/vdp-vram-timing/vdp-timing.html">V9938 VRAM timings</a>
article by the <a href="http://openmsx.org/">openMSX</a> team.
Highly detailed insights in the inner workings of the VDP.</p>

<p><em>2014-07-18</em><br />
Added <a href="/resources/sound/msxaudio_keyboard.php">MSX-AUDIO music
keyboard</a> documentation.</p>

<p><em>2014-07-04</em><br />
Added <a href="/resources/midi/ym2148.php">Yamaha YM2148</a> documentation. This
is the Yamaha FM Sound Synthesizer Unit’s MIDI interface.</p>

<p><em>2014-05-29</em><br />
Added <a href="/resources/hbi55.php">Sony HBI-55 / Yamaha UDC-01</a> 4kB SRAM
data cartridge documentation.</p>

<p><em>2014-05-22</em><br />
Added <a href="/sources/vdp_detection.php">VDP version detection</a> source code.</p>

<p><em>2014-05-20</em><br />
Translated <a href="/articles/dos-error-handling.php">MSX-DOS 1 disk error handling</a> article by Ramon van der Winkel.</p>

<p><em>2014-05-14</em><br />
Translated <a href="/articles/interrupts.php">Interrupts</a> article by Ramon van der Winkel.</p>

<p><em>2014-05-10</em><br />
Added <a href="/resources/#opm">OPM</a> and <a href="/resources/#sn76489">SN76489</a> resources.</p>

<p><em>2014-04-03</em><br />
Added links to Nestor Soriano (Konamiman)’s great
<a href="/resources/#msxbios">MSX2 Technical Handbook
transscription</a>, and some clean-up.</p>

<p><em>2014-02-08</em><br />
Added link to Eugeny Brychkov’s excellent
<a href="/resources/#v9938">V9938 application manual
transscription</a>.</p>

<p><em>2013-01-13</em><br />
Added an English translation of the MSX Datapack Vol. 3’s
<a href="/resources/midi/msx-midi.php">MSX-MIDI</a> documentation.</p>

<p><em>2010-07-19</em><br />
<a href="/articles/keymatrix.php">Key matrices:</a> Added more information on
models with Yes/No keys and Pioneer PX-7 keys, thanks Manuel Bilderbeek and
Sean Young.</p>

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
The MSX Assembly Page’s address has changed to
<a href="http://map.grauw.nl/">http://map.grauw.nl/</a>. Source is now
accessible in a <a href="https://bitbucket.org/grauw/map">public repository</a>, and
introducing a <a href="/contributing/">Contributing</a> section.</p>

<p><em>2007-06-29</em><br />
Moved <a href="/resources/joynet/">JoyNet documentation</a> to the MAP, and
cleaned up, updated and merged text. Updated Funet links, added MSX mailinglist
archive links.</p>

<p><em>2006-12-07</em><br />
Added Tanni’s ‘<a href="/articles/taste_of_vhdl.php">A taste of VHDL</a>’ tutorial.</p>

<p><em>2005-10-05</em><br />
<a href="/articles/vdp_guide.php">VDP programming guide</a>: Update r#18 Q: it
only happens with sprites disabled.</p>

<p><em>2005-08-28</em><br />
<a href="/articles/mult_div_shifts.php">Multiplications, divisions and shifts:</a>
The MCCW article
<a href="http://www.mccw.hetlab.tk/92/Multiplication/en.html">Multiplication on
a Z80</a> describes a very fast multiplication method.</p>

<p><em>2005-08-11</em><br />
<a href="/articles/fast_loops.php">Fast loops</a>: Optimized FastLDIR routine
even more, yet another 5 ticks faster! (thanks Arnold Metselaar).</p>

<p><em>2005-06-01</em><br />
Added information to the PSG samples article about its logarithmic volume scale, and how to play <a href="/articles/psg_sample.php">8-bit samples on the PSG</a>. Thanks go to Arturo Ragozini for pointing this out.</p>

<p><em>2005-05-12</em><br />
Fixed cut-off values in some timings in the
<a href="/resources/z80instr.php">Z80 instruction set overview</a>, and added
undocumented and R800 instructions and timings. Also optimized the
<a href="/articles/mult_div_shifts.php">Div16</a> routine, it is only a humble
7 T-states faster than it was before, but can now be unrolled to be up to 234
T-states faster! It is also 15 bytes smaller. Thanks go to Flyguille.</p>

<p><em>2005-05-01</em><br />
<a href="/articles/mult_div_shifts.php">Multiplications, divisions and shifts:</a>
Optimized the Mult32 routine, it is now 96 T-states faster and three bytes
smaller. Thanks to Colin Douglas Howell.</p>

<p><em>2005-04-25</em><br />
<a href="/articles/mult_div_shifts.php">Multiplications, divisions and shifts:</a>
Changed <code>ld hl,0</code> to <code>ld l,0</code> in Mult12, and removed it
altogether in the Mult16 routine. Thanks to Sjoerd Mastijn for the tip :).</p>

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
Fixed <a href="/articles/mult_div_shifts.php">Mult32 routine</a>, thanks to
Nyyrikki for pointing me to a bit that didn’t make sense.</p>

<p><em>2004-06-23</em><br />
Added <a href="/logs/">log functions</a> with more detailed <abbr title="User Agent">UA</abbr> stats.</p>

<p><em>2004-05-31</em><br />
<a href="/articles/keymatrix.php">Key matrices:</a> Updated Spanish /
Argentinian keyboard layout and added a keyboard version no. 6 (again thanks to
Flyguille).</p>

<p><em>2004-05-26</em><br />
Updated <a href="/articles/keymatrix.php">key matrices article</a> with
information about the keyboard layout bit in PSG I/O port A, and updated the
<a href="/resources/msx_io_ports.php">I/O ports overview</a> with
<abbr title="Programmable Sound Generator">PSG</abbr> ports.</p>

<p><em>2004-05-25</em><br />
Hosting all resources ourselves now, amongst others because unfortunately many
of the documentation files on funet are broken. Also updated
<a href="/articles/keymatrix.php">key matrices article</a>, adding the Spanish /
Argentinian keyboard layout (thanks to Flyguille) and added more detailed
information for the Japanese keyboards (JIS vs. ANSI).</p>

<p><em>2004-05-24</em><br />
Added a stub article about <a href="/resources/engine/t9769b/">the T9769B</a>.</p>

<p><em>2004-04-21</em><br />
Added MARMSX's 19268 colors on <abbr title="Machines with Software eXchangeability">MSX</abbr> 2+ article to <a href="/articles/#extarticles">external articles</a>.</p>

<p><em>2004-04-09</em><br />
Redesigned site structure somewhat. If you linked or bookmarked one of the section indices, please update your links. Also added a style changer.</p>

<p><em>2004-03-03</em><br />
On capable browsers (Firefox), the <abbr title="MSX Assembly Page">MAP</abbr> is now using true <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>.</p>

<p><em>2004-02-17</em><br />
Added Panasonic FS-A1FM's Modem <abbr title="Read Only Memory">ROM</abbr> info in <a href="/resources/msx_io_ports.php">I/O ports overview</a>. Also added link to MARMSX tools.</p>

<p><em>2004-02-09</em><br />
Got rid of the ?p= style linking. This should improve the indexing of the <abbr title="MSX Assembly Page">MAP</abbr> by search engines such as <a href="http://www.google.com/">Google</a>.</p>

<p><em>2004-02-06</em><br />
In the <a href="/articles/mult_div_shifts.php">Multiplications and divisions
article</a>, replaced the square root routine with a new (faster) one, thanks to
Ricardo Bittencourt. Also added a link to the
<abbr title="Machines with Software eXchangeability">MSX</abbr> Banzai
<abbr title="Graphics 9000">Gfx9000</abbr> programmer's manual and Development
<abbr title="Frequently Asked Questions">FAQ</abbr> in the external articles
section. Finally, added the <a href="/sources/external/z80bits.html">Z80
Bits</a> article kindly provided by Petr Petyovsky from the Sinclair scene, also
in the external articles section.</p>

<p><em>2004-02-01</em><br />
Updated the <a href="/articles/mult_div_shifts.php">Multiplications and divisions article</a> with the following: fixed bugs in Div16 and renamed it to Div15 because the divider could only be 15 bits max; there is a new Div16 available offering support for all 16 bits. Also changed Mult12 unrolled version's routine name to Mult12U, and optimized the ld l,0 here aswell. Furthermore, added a square root Sqr16 routine by Arjan Bakker (based on the one published in <abbr title="MSX Computer &amp; Club Magazine">MCCM</abbr>). And finally, re-calculated all timing figures to include M1 wait states</p>

<p><em>2004-01-22</em><br />
<a href="/articles/fast_loops.php">Fast loops</a>: Optimized DoLDIR routine
more, 5 ticks faster now, and corrected a small error (thanks GuyveR800).</p>

<p><em>2004-01-19</em><br />
Applied gamma correction to the <a href="/articles/vdp_guide.php#screen8col">screen 8 palette</a> from yesterday’s update, to make it <abbr title="Standard Red Green &amp; Blue">sRGB</abbr>, and updated the article again. Thanks to Maarten ter Huurne.</p>

<p><em>2004-01-18</em><br />
Replaced the screen 8 palette file with one with the ‘proper’ colours for Blue. Also wrote a little explanation why in the <a href="/articles/vdp_guide.php#screen8col"><abbr title="Video Display Processor">VDP</abbr> programming guide</a>. Updated the downloads section as well with some new tools.</p>

<p><em>2003-10-04</em><br />
Added the <a href="/articles/keymatrix.php#jap">Japanese keyboard layout</a>. Thanks to Manuel Bilderbeek.</p>

<p><em>2003-09-06</em><br />
<a href="/articles/split_guide.php">Split programming guide</a>: Changed the
BITs in the polls to ANDs, added a macro to the blank line screensplit example.
Still didn’t fix the statements about HR.</p>

<p><em>2003-08-27</em><br />
Updated the <a href="/articles/keymatrix.php">keyboard matrices article</a>, and added the Russian keyboard layout. For that, many thanks to Stanislav Borutsky.</p>

<p><em>2003-08-05</em><br />
Added an ‘external articles’ section and put up a couple of links to amongst others interesting articles on <abbr title="MCCM Web">MCCW</abbr>.</p>

<p><em>2003-07-15</em><br />
Wrote a <a href="/resources/msx_io_ports.php">resource about I/O ports</a> on <abbr title="Machines with Software eXchangeability">MSX</abbr>. Updated the resources section with a fair number of new documentation and added mirrors. Linked to a couple more sites in the links section. Also made the tables look a little prettier.</p>

<p><em>2003-04-24</em><br />
Updated the <a href="/articles/fast_loops.php">fast loops article</a> (wrote a faster DoLDIR routine, corrected speed calculations, uses JP PE for
-0-check now), added notice to the <a href="/articles/split_guide.php">screensplit programming guide</a>.</p>

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