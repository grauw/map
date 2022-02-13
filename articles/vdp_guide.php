<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>VDP programming guide</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>


<h1>VDP programming guide</h1>

<p>This article aims to document most VDP programming loopholes you may encounter. Below is a list of tips and answers to questions, which may be useful either before programming a certain VDP-related routine, or afterwards to hunt down bugs (should’ve read it beforehand after all, eh ;)). The screensplit related tips are located in <a href="/articles/split_guide.php">a separate article</a>. If you have any suggestions, please submit them to us!</p>

<ul>
<li>Q: <a href="#r18cmd">r#18 in combination with VDP commands corrupts VRAM?</a></li>
<li>Q: <a href="#r18disp">What about screensplits with the help of r#18?</a></li>
<li>Q: <a href="#vdpstrange">VDP does lots of strange things, how come?</a></li>
<li>Q: <a href="#screen9">Where did screen 9 go?</a></li>
<li>Q: <a href="#r24">Where did r#24 go?</a></li>
<li>Q: <a href="#screen8col">What is there to say about screen 8’s palette?</a></li>
</ul>

<h2 id="r18cmd">Q: r#18 in combination with VDP commands corrupts VRAM?</h2>

<p>A: Yes. If you use the screen position adjust register while executing a copy
command, it will corrupt the byte the VDP command is currently processing. This
occurs regardless of whether you have the sprites or screen enabled. So, if that
is the case, you should wait with setting r#18 until the VDP’s CE bit indicates
the current command is finished.</p>


<h2 id="r18disp">Q: What about screensplits with the help of r#18?</h2>

<p>A: Once again, this register behaves a bit strangely when you disable the sprites. During the display cycle, if you move the screen to the left using r#18, the entire current line is drawn in the background color. This only happens when the sprites are disabled. So if you’re creating a screensplit with the help of r#18, watch out for this.</p>


<h2 id="vdpstrange">Q: VDP does lots of random strange things, how come?</h2>

<p>A: Do you DI during the register OUTs? Is there a poll loop during which the ints are continuously disabled, hence messing up your screensplits? It has probably something to do with the interrupts.</p>


<h2 id="screen9">Q: Where did screen 9 go?</h2>

<p>A: On this topic, ASCII’s official MSX Magazine says:
<q xml:lang="ja">SCREEN9は、韓国のMSX2にのみ搭載されたハングル表示専用モードで、国内のMSXと同様にMSXPLAYerでは搭載していません。</q>
It <a href="https://www.deepl.com/">translates</a> to: “SCREEN9 is a dedicated mode for displaying
Hangul (Korean characters), which was only available on the Korean MSX2, and is not available on the
MSXPLAYer as well as the domestic (Japanese) MSX.” Under the hood this Hangul mode actually uses
the SCREEN 6 bitmap mode, similar to the Japanese Kanji modes. The MSX2+ screen mode numbering
continued with SCREEN 10-12.</p>


<h2 id="r24">Q: Where did r#24 go?</h2>

<p>It is unknown. Maybe Yamaha had a V9948 prototype in development which used this register, so they
kept it reserved, and the V9958 continued with registers 25-27. But no evidence of the existence of
this chip has been found other than a rather obvious blank in the Yamaha’s numbering of the chip name
(V9938 vs V9958) and the ID in status register s#1 (0 vs 2).</p>


<h2 id="screen8col">What is there to say about screen 8’s colours?</h2>

<p>A: Screen 8’s colours are composed of Red and Green, with ranges of 0-7, and Blue, with a range of 0-3. Red and Green’s colours are divided over a gliding scale. So, if you were to map these 3-bit colours to 8-bit colour information, you would get steps of (255/7), or in other words: 0, 36, 73, 109, 146, 182, 219, 255. In Assembly, this can by the way easiest be calculated by shifting and OR-ing bits 0-2 as follows: xxxxx210 --> 21021021 (although a table may be faster :)). Anyways, the real subject of this Q&amp;A is the colour Blue. This one does NOT operate on a gliding scale from 0-3 (so no 255/3 stuff), but, just like the other two colours, also from 0-7. It then maps its four colours as follows to that range: 0->0, 1->2, 2->4, 3->7. There is a small test program below for you to experiment with, if you want. Anyways, because of this, gray colours can be really gray and not blue-ish or yellow-ish teints.</p>

<p>Another issue is that although the voltages the VDP outputs increase linearly, the actual intensity of the colours displayed has an exponential curve (thanks to Maarten ter Huurne, btw). To cope for this, you have to apply gamma correction to the colours. A television or an MSX monitor generally has a gamma of 2.5, while on a PC the usual colourspace is sRGB nowadays, with a gamma of 2.2. So, in order to get the correct colors displayed on your PC, you’ll have to apply a gamma correction of 2.2 / 2.5 = 0.88 to the palette. Paint Shop Pro can do this fairly easily.</p>

<p>Many who designed or converted graphics on the PC have probably not considered these two ‘complications’, and instead used a gliding blue scale and no gamma correction, which would yield somewhat inaccurate results. I have however put a <a href="downloads/articles/sc8_palette_srgb.zip">proper palette</a> online for your convenience. It used to be a ‘wrong’ one too, so if you downloaded it before, do it again.</p>

<pre>10 SCREEN 8:SETPAGE 1,1:LINE (0,0)-(255,211),&amp;B11111111,BF
20 SCREEN 1:KEY OFF:COLOR 15,4,0:COLOR=(4,5,5,5)  'change to (4,4,4,4), etc
30 VDP(0)=0:VDP(2)=6
40 IF INKEY$="" GOTO 40
50 VDP(0)=14:VDP(2)=63
60 IF INKEY$="" GOTO 60
70 GOTO 30
</pre>


<p><br /><em>As you can see, this article is still being worked on. If you have any ideas for good Q&amp;A’s, please let us know and we will add them.</em></p>




<p>~Grauw</p>




<?php addFooter(); ?>
</body>
</html>