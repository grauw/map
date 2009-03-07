<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Scrolling on MSX - MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>Scrolling on MSX</h1>

<div class="updates" style="display:none;">
<h2>Latest updates:</h2>

<p><em>yyyy-mm-dd</em><br />
...</p>
</div>

<p>Scrolling is a feature that is an essential part of many games, however due to hardware limitations it is not a trivial thing to do on MSX. Even for experienced programmers, depending on the requirements of course, it may grow into quite a complex problem.</p>

<p>This article describes different scenarios, problems that you may encounter and their solutions. It addresses scenarios on the Yamaha v9938 (MSX2 VDP), the Yamaha v9958 (MSX2+ VDP) and the Yamaha v9990 (Sunrise Graphics9000).</p>

<ul>
	<li><a href="#tiles">An introduction to tiles</a></li>
	<li><a href="#hardware-vs-software">Hardware vs. software scrolling</a>
	<ul>
		<li><a href="#hardware">Hardware scrolling</a>
		<ul>
			<li><a href="#hardware-v9938">v9938 – MSX2</a></li>
			<li><a href="#hardware-v9958">v9958 – MSX2+</a></li>
			<li><a href="#hardware-v9990">v9990 – Graphics9000</a></li>
		</ul>
		</li>
	</ul>
	</li>
	<li><a href="#software">Software scrolling</a>
	<ul>
		<li><a href="#software-optimising">Optimising software scrolling</a></li>
	</ul>
	</li>
	<li><a href="#more-on-hardware">More on hardware scrolling</a></li>
</ul>


<p>First, a little explanation about the very important concept of tiles...</p>

<h2 id="tiles">An introduction to tiles</h2>

<p><img src="scrolling/tiles.png" alt="Illustrating tiles concept" class="illustration" />
You will usually want to scroll through multiple screens worth of images. Storing all that data as bitmaps uses a lot of memory, and in practice you will want to use <dfn>tiles</dfn> instead. Basically, tiles are a compression technique to reduce the amount of data that has to be stored.</p>

<p>Tiles (also known as <dfn>patterns</dfn>) are rectangular building blocks for the field. They are taken from a <dfn>tile set</dfn> (a.k.a. <dfn>pattern generator table</dfn>) which is a collection of all tiles used in the field. The position of the tiles in the field is described in a <dfn>tile map</dfn> (a.k.a. <dfn>pattern name table</dfn>).</p>

<p>Common sizes for such tiles are 8×8 and 16×16, and tilesets usually contain 256 of them so that a tile number fits in one byte. A tile map can for example be 16 kB, describing a field of 128×128 tiles (with 8×8 tiles that is 1024×1024 pixels) or 32×512 tiles (256×4096 pixels).</p>

<p>The v9938’s screen 1, 2, 3 and 4, and the v9990’s P1 and P2 modes are also tile-/pattern-based screenmodes. But even when you are not using those modes, you will often still want to use tiles.</p>


<h2 id="hardware-vs-software">Hardware vs. software scrolling</h2>

<p>The available scrolling methods can be divided into two categories: ‘hardware scrolling’ and ‘software scrolling’, and a combination of them is also possible. <dfn>Hardware scrolling</dfn> means that you use scroll-registers provided by the hardware to move the contents of the screen around. <dfn>Software scrolling</dfn> means that you manually copy the contents of the screen.</p>


<h3 id="hardware">Hardware scrolling</h3>

<p>Usually, hardware scrolling is the best solution for scrolling, because it’s very fast. However, there are limitations as well. Hardware scrolling is for example always full-screen, although this can be worked around by means of a screensplit.</p>

<p>The following sections describe the scrolling capabilities of the different hardware:</p>

<h4 id="hardware-v9938">v9938 – MSX2</h4>

<p>The MSX2 only has a vertical scrolling register (r#23). That means that if you want to scroll smoothly on MSX2, you are limited to doing it vertically. Examples of games which use the vertical scrolling register are <em>Aleste</em>, <em>Quarth</em> and <em>Shrines of Enigma</em>. These are all vertically-oriented games, games which scroll horizontally or bi-directionally usually use software scrolling instead.</p>

<p>There is however a method to smoothly scroll horizontally on MSX2 using some hardware acceleration: the adjust register (r#18). With the adjust register, you can horizontally (and vertically) adjust the screen in 16 steps. This has some limits however, let’s sum up a few of them:</p>

<ul>
	<li>You can only scroll 16 pixels and need to perform additional software scrolling to be able to scroll more than that.</li>
	<li>The left and the right borders of the screen move along with the adjust register, causing the borders to ‘flip’. This effect can be masked using sprites.</li>
	<li>The adjust register is there for the user to center the screen on his display. By using this register for scrolling, you are ignoring the user’s settings.</li>
	<li>Changing the adjust register while performing a copy command causes VRAM corruption, see <a href="/articles/vdp_guide.php#r18cmd">this FAQ question</a>.</li>
</ul>

<p>Examples of games which use this are <em>Space Manbow</em> (in screen 4) and <em>Pentaro Odyssey</em>.</p>


<h4 id="hardware-v9958">v9958 – MSX2+</h4>

<p>In addition to the v9938’s vertical scrolling register, the v9958 can also do horizontal scrolling (r#26 and r#27). The horizontal scrolling can span both a single page or two pages. The scrolling is smooth on the left border of the screen, however the right border flips for every 8th pixel. There is a setting to mask this, but this will reduce the horizontal resolution to 248 pixels.</p>

<p>Examples of games which use the v9958 scrolling capabilities are <em>Sea Sardine</em>, <em>Sonyc</em>, <em>Space Manbow</em> (the border doesn’t flip like it does on MSX2) and <em>F1 Spirit 3D</em>.</p>


<h4 id="hardware-v9990">v9990 – Graphics9000</h4>

<p>The v9990 has the best hardware for scrolling. It has registers to scroll both horizontally and vertical accross multiple pages (r#17 to r#24), and in P1 mode even offers multilayer scrolling with 2 layers. In case your requirements are even higher, e.g. you want to scroll using more layers, software scrolling with the v9990’s copy commands is very fast as well.</p>


<h3 id="software">Software scrolling</h3>

<p>When software scrolling, you are not using the hardware scroll registers, but instead scroll by copying data on the screen. Due to the limitations that imposes, it will never look as good as hardware scrolling.</p>

<p>Software scrolling is usually done in 8 pixel steps for example. This is because in the pattern modes, the patterns are 8x8 pixels, and thus can only be moved in those units. And for the bitmap modes, the copy command is way too slow to scroll one pixel at a time, so 8 pixels are chosen because they have a good tradeoff between speed and looks. Additionally, due to performance optimisations bitmap mode scrolls usually don’t scroll very smoothly.</p>

<p>Software scrolling can be combined with hardware scrolling to achieve better performance or looks, e.g. the software scrolling can scroll in 8 pixel units, and the hardware scrolling can deal with scrolling the one-pixel units inbetween.</p>


<h4 id="software-optimising">Optimising software scrolling</h4>

<p><img src="scrolling/swscroll-opt1.png" alt="Illustrating selective copy optimisation" class="illustration" />
The most important technique to optimise a software scroll, is to do a <dfn>selective copy</dfn> – that is, only copy things that have changed. Instead of copying the whole screen 8 pixels at once, if you divide up the screen in 8×8 tiles and only copy the tiles where the new tile differs from the old one, you can reduce the amount of data that has to be copied greatly. This technique especially performs great when there are areas with lots of contiguous tiles such as roofs and grass, which is often the case.</p>

<p>Using this technique it is also relatively easy to create high-performance multilayer scrolling where the background layer doesn’t move.</p>

<p>Another way to gain performance would be to use the hardware scrolling capabilities; when scrolling vertically, you could use v9938’s vertical scrolling, while for per 8-pixel horizontal scrolling you could use the horizontal adjust to speed up every other step. When you are using multiple layers as described in the previous paragraph, you could count the tiles that would change in a scenario with and without additional hardware scroll, and only apply the hardware scroll if it improves performance.</p>

<p>Optimisation can also be found in performing larger copies, because <a href="/articles/vdp_commands_speed.php#smaller">smaller copies are slower</a>. A simple means to get bigger copies is to base your scroll routine on 16×16 tiles instead of 8×8 ones. More advanced techniques could involve sequence detection or caching.</p>

<p>Examples of these optimising methods are the Falcom <em>Ys</em> games, and Cas Cremer’s <em>Akin</em> and <em>Core Dump promo</em>. They are excellent examples of what kinds of performance can be achieved, even on a plain MSX2 without hardware-accelerated horizontal scrolling capability.</p>


<h2 id="examples">Some examples</h2>

<h3>Example 1</h3>

<p><em>Scenario:</em> a game has a player walking around a field which spans multiple screens. We want to be able to scroll smoothly in 4 directions. One step by the player corresponds to 8 pixels. The size of the tiles is 8×8. The used hardware is a v9958.</p>

<p></p>



<p class="signed">Grauw</p>




<?php addFooter(); ?>
</body>
</html>