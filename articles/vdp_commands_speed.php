<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>VDP commands ~ speed measurements</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>VDP commands ~ speed measurements</h1>

<p>Hi all!</p>

<p>This article explains in some detail how fast the VDP’s command execution is, and how you can speed it up. It has some rather accurate tables with measurement data on how much bytes the VDP can approximately process within the timeframe of one interrupt under different circumstances. By using these tables, you can calculate on beforehand whether for example a cool effect can be done or not. Also, near the end of this article there are a couple of programming tips.</p>

<p>This article was originally written for the Track diskmagazine I and the rest of the Datax crew produced back then. It was also published in XSW-Magazine later on. Since I think this is a quite valuable resource, I now put it online at the MAP. For this purpose I translated the original article to English, and while I was at it I re-edited it and also added some additional notes.</p>

<p>You can <a href="/downloads/articles/testcopy.lzh">download a speed test tool here</a> with which you can make measurements yourself.</p>

<ul>
	<li><a href="#introduction">Introduction</a></li>
	<li><a href="#well-known">The well-known methods</a></li>
	<li><a href="#unknown">The unknown (?) speedup method</a></li>
	<li><a href="#smaller">Smaller copies are slower</a></li>
	<li><a href="#50vs60">The difference between 50/60 Hertz</a></li>
	<li><a href="#speedtests">The speed tests</a></li>
	<li><a href="#copyresults">The tables for the copies</a></li>
	<li><a href="#fillresults">The tables for the fills</a></li>
	<li><a href="#applications">Applications of the tables</a></li>
	<li><a href="#notes">Some additional notes</a></li>
	<li><a href="#tests">The tests</a></li>
</ul>

<h2 id="introduction">Introduction</h2>

<p>In this edition of ‘ML with LH’ I will discuss the videoprocessor’s speed when executing its commands, and how to boost it. This might result in monitor problems in case it is monochrome (SCART-connections don’t always work flawless either, but you can fix that by smudging some peanutbutter into the input).</p>

<p>[Note: the latter was an ‘addition’ to my article by Alex Ganzeveld... which I wasn’t aware of ;). Okay, enough jokes.]</p>

<p>The videoprocessor loses a lot of time with the construction of the image, and while it is at that job it’s only got very little spare time to execute commands with. That’s why the best way to speed up the VDP is to decrease the amount of time the VDP uses to do that.</p>


<h2 id="well-known">The well-known methods</h2>

<p>The VDP’s two ‘official’ speedup methods are probably already known to you, these are:</p>

<ol type="1">
<li>Disabling the screen by resetting bit 6 of register 1</li>
<li>Disabling the display of the sprites by setting bit 1 of register 8 (vdp(9) in Basic).</li>
</ol>

<p>However, there are also a couple of other methods, which all come down to decreasing the amount of time the VDP has to put in its other tasks.</p>


<h2 id="unknown">The unknown (?) speedup method</h2>

<p>One of the other ways to speed the VDP up a little is a variant of the abovementioned ‘official’ method nr. 1, disabling the screen. To be more specific, I’m talking about partially disabling the screen here. It’s easiest to simply reset bit 7 of register 9 (vdp(10) in Basic), which will make the screen 192 lines higher instead of 212. That way the VDP has to put 20 lines less on screen, and has therefor more time left for executing commands like a fill or a copy. The screen remains fairly large (like on MSX1) and it’s a very low-maintenance solution, you only need to change one single bit and after that won’t have to look at it again. Another additional result of this is that - in case of a game - the area where the action takes place becomes smaller, so the copies themselves will also be smaller, resulting in some additional speed.</p>

<p>However, you can also ‘shorten’ the screen from (and to) every possible horizontal line by using a screensplit and disabling the screen on certain lines.</p>

<p>If you for example have a game which uses the larger part of the screen for the field, where a statusbar is located at the bottom (like SD-Snatcher or Pumpkin Adventure), and if you usually would disable the screen in its entirety when flipping to the next field to speedup the screen buildup, you could also use the abovementioned method and only disable the top part of the screen, being the field, but leave the bottom part, the status bar, visible. That’ll probably look better while it will still provide additional speed.</p>


<h2 id="smaller">Smaller copies are slower</h2>

<p>One thing you should really keep in mind is that smaller copies are a lot slower than large copies. I’ll give you a couple of figures, you can verify them with my test program, and do some more detailed measurements. If you are using a tilemap for something, you are usually using tiles of 8x8 pixels, or 16x16 ones. Well, take the case that you are running at 60Hz, with sprites disabled, and using HMMM copies. With a single copy, you can relocate 3616 bytes in the timeframe of 1 interrupt. With 8x8 copies however, you can only copy 2080 bytes, and with 16x16 copies you can do 2944 bytes. These are quite astonashing numbers, 8x8 copies are 42% slower than 1 large copy, and 16x16 copies are 19% slower!</p>

<p>Some more tests made apparant that the ‘loss’ in speed is mainly dependant on the X size and in a lesser degree on the Y size. So if you have the choice, a 32x8 copy should for example be preferred over a 8x32 one. But the key factor in gaining speed is the size, so just try to make the copies as large as possible. When designing a game this might be a reason to favor 16x16 tiles over 8x8 tiles.</p>

<p>So how could tilebased games like Ys and Akin/Coredump be so damn fast then when they’re using 8x8 tiles? Well, in order to do that you must combine a number of speedup tactics. First off, only copy the necessary tiles. If there’s a patch of grass on the ground, and next to it there’s more grass, then you won’t have to redraw all of the grass, only the tiles which change need to be redrawn. Secondly, when you have to draw a ‘clear’ tile (in 1 single color), use an HMMV instead of an HMMM. You’d be surprised how often clear tiles are used, especially if the graphics designer keeps it in mind. And finally, try to apply some form of caching to your tiles. Store commonly used groups of tiles on an alternate page, or copy them from elsewhere on the visible field if they are on it. That way you’ll be able to use larger copies. One final note on this subject; when applying these techniques, try to preprocess the data to the largest extent possible, because if you do it all in realtime valuable time gets lost. And some stuff can simply not be done in realtime, like pattern matching, you probably even need a PC to do the preprocessing.</p>


<h2 id="50vs60">The difference between 50/60 Hertz</h2>

<p>Often games seem to work faster when running on 60 Hz. The sprites move faster, the music is played faster aswell. However, when executing VDP-commands on 60 Hz it seems as if they are significantly slower. In the worst-case scenario of LMMM the speed even drops to below 1000 bytes/interrupt. Now this can very easily be explained. These measurements were taken in number of bytes per interrupt. Since there are a 20% more interrupts (60 per minute instead of 50 per minute) it’s also logical the number of bytes per interrupt drops with 20%.</p>

<p>However, aside from that, there also is some <i>real</i> slowdown when using 60 Hz. At 50Hertz, the number of bytes per minute is not 20% more than at 60 Hertz, as one would expect, but roughly 26% more! Also, as more and more display features are disabled, with ultimately a blank screen, the difference drops back to the expected 20%... This can not simply be explained by measurement errors, because the difference of 6% is a couple of times larger than the accuracy. So, the conclusion is that when running at 60 Hz the VDP has got more work to do per displayed line, and has therefore less spare time for the execution of commands, which means they become slower.</p>


<h2 id="speedtests">The speed tests</h2>

<p>I did a couple of tests about the speed of two types of VDP commands, being the copy and the fill (both in aswell low as highspeed versions). I tested the speed of these commands with the sprites on and off, and with 212, 192 or 0 displayed lines. All data has been tested on aswell 50 as 60 Hertz, so you can easily decide which table to look at, depending on which frequency you want your game or demo to run on. I have also added the YMMM test results which weren’t present in the original article.</p>

<p>First off, a short legenda:</p>

<p>First of all the official name of the tested command is mentioned, and next to it is the term ‘accuracy’, which (wonder wonder) indicates the accuracy of the measurements. To be more specific, it indicates on what boundary the value is rounded down. An accuracy of 32 means for example that the real value, for example 107 (in an imaginary case) will be rounded down to 96, which is a multiple of 32. The other way around, a given value of 96 means that the real value can be up to 31 bytes higher.</p>

<p>Next: Spr means sprites, which can be either enabled or disabled (on/off), Lin indicates the number of lines displayed, either 212 or 192, and --Blank-- indicates the screen is entirely blanked out. This is effectively the same as Lin being set to 0 and Spr being set to off.</p>

<p>Further, there’s Speed. This number indicates how many bytes the VDP’s command can process per interrupt. So in case of LMMM and HMMM this is the number of bytes it can copy, and in LMMV/HMMV’s case this is the number of bytes it can fill. These values are valid for ALL screens from 5 to 12 (and on v9958, I guess aswell for the MSX1 screen modes).</p>

<p>Finally, 50/60 Hertz, this is related to Speed and shows the difference in number of bytes between both interrupt modes.</p>


<h2 id="copyresults">The tables for the copies</h2>

<p>Speed is indicated in bytes per interrupt.</p>

<pre>
     LMMM  accuracy: 16              HMMM  accuracy: 32              YMMM  accuracy: 32

 Spr / Lin  - Speed 50/60Hz      Spr / Lin  - Speed 50/60Hz      Spr / Lin  - Speed 50/60Hz

  on / 212  -  1232 /  976        on / 212  -  3552 / 2784        on / 212  -  4192 / 3168
  on / 192  -  1264 / 1008        on / 192  -  3616 / 2880        on / 192  -  4384 / 3360
 off / 212  -  1584 / 1312       off / 212  -  4384 / 3616       off / 212  -  5856 / 4832
 off / 192  -  1584 / 1312       off / 192  -  4384 / 3684       off / 192  -  5856 / 4864
 --Blank--  -  1600 / 1344       --Blank--  -  4512 / 3776       --Blank--  -  6112 / 5120
</pre>

<p>When we analyze these tables a bit, several conclusions can be drawn:</p>

<p>- First of all, a highspeed copy (HMMM) is a little more than 2.8, meaning almost 3 times as fast as a lowspeed copy! An YMMM copy is even faster, it’s 3.4 times as fast.</p>

<p>- Secondly, did you notice that disabling the sprites during a copy-command matters a huge lot? Say disabling the screen gives a speedup of 100%. Compared to that, disabling the sprites gives you a speedup 87%!!! So, by simply disabling the sprites you can already gain almost as much VDP-processor power as by disabling the entire screen!!!</p>

<p>- From the previous you MIGHT conclude that the sprites use up 87% of the display process and that the building of the screen itself only uses 13% of the time. I don’t know if that’s a 100% correct though.</p>

<p>- In case of a copy it matters very little whether you’ve got the screen set to either 212 or 192 lines. With the sprites enabled, the difference it a bit more, 64 bytes in case of a HMMV, which is a half line in screen 5.</p>


<h2 id="fillresults">The tables for the fills</h2>

<pre>
     LMMV  accuracy: 16              HMMV  accuracy: 64

 Spr / Lin  - Speed 50/60Hz      Spr / Lin  - Speed 50/60Hz

  on / 212  -  1696 / 1344        on / 212  -  7040 / 5632
  on / 192  -  1728 / 1392        on / 192  -  7168 / 5760
 off / 212  -  1840 / 1488       off / 212  -  7232 / 5888
 off / 192  -  1856 / 1504       off / 192  -  7360 / 5952
 --Blank--  -  2128 / 1776       --Blank--  -  8448 / 7040
</pre>

<p>Some conclusions we can draw by analyzing the fill-command tables a little:</p>

<p>- First of all we’ll ofcourse compare the speed divisions here aswell, and what do we see? A highspeed fill is FOUR TIMES AS FAST as a lowspeed fill!!! (w00t ;p) Also, a highspeed fill is twice as fast as a highspeed copy, so ‘copying’ blank (single-colored) areas with a fill instead of a copy is definately worth the effort.</p>

<p>- In case of HMMV the maximum byterate at 60 Hz is equal to the minimum at 50 Hz. Once more you can see there’s a huge difference in byterate if you want to keep synchronized with the interrupts. This is also the reason why the Japanese Takeru-release of Unknow Reality by NOP was called off - it didn’t work on 60 Hz. So if possible, program for the worst case, being 60Hz.</p>

<p>- Here, switching the screen height from 212 to 192 lines definately does matter - relatively spoken. This in contrary to the copy’s case. If you state that disabling the sprites results in a speedup of 100%, disabling the bottom 20 lines only already gives you a gain percentage of 66% in comparison! The fun part about this (well, ofcourse as far as you consider this fun ;)) is that you can ‘add’ those tweaks, so that you get an even higher speed (say, 166% compared to disabling the sprites only). Anyways, from this we can conclude that in case of the LMMV and HMMV commands - in contrary to both copy’s - the screen buildup slows down the command more than the sprites do.</p>

<p>- However, actually the gain in speed isn’t that much, speed increases on the copy front were much more dramatic. Compared to the total amount of bytes the largest speedup you can get with HMMV while still displaying the screen is with 320 bytes, while the total amount of bytes is then 7040; percentage-wise, it’s only a 4,5% speed increase. Although this will barely give you those two additional lines in screen 5 you might just need, it’s hardly worth the trouble - and the disadvantages.</p>

<p>- Another thing, screen 5 has 54272 pixels, which is 27136 bytes, and the fastest operation is HMMV during 50 Hz blank with its 8448 bytes/interrupt, so even with the fastest command possible (clearing the screen) it still takes 3.2 interrupts (64 ms) to process the entire screen.</p>


<h2 id="applications">Applications of the tables</h2>

<p>Now that we’re finished, what can you use the value Speed for? Well, I’ll give a few examples. Say, you want to know the maximum height of a horizontal scrolltext at 60 Hz by means of a copy, with sprites disabled. In that case, look at the speed of a highspeed copy, which is 3616 bytes per interrupt. The screen is 256 pixels wide, which translates to 128 bytes per line. Well then, a little division shows us that 3616/128 = 28.25, so in screen 5 a scroll’s height will be max. 28 pixels.</p>

<p>Please note though that these are very strict calculations. In order for this to happen, you will need to issue a new copy right at line 212, *before* the interrupt handler starts, since the handler will take up prescious time. Also, you need to start the new copy at line 212 (or right after whatever line the bottom of your copy is located at in case it’s not at the bottom of the screen), because if you don’t the screen buildup will catch up with the copy before it’s finished and you’ll notice a relocation to the left halfway your scroll. Also, the overhead of DoCopy’s polling and issueing of the next command needs to be very small. See my <a href="/sources/docopy.php">DoCopy source example</a> for the as far as I know fastest way of doing that.</p>


<h2 id="notes">Some additional notes</h2>

<p>There are a few other things which weren’t in the original article but which I would like to mention. First of all, I haven’t verified this yet, but I would advise you to execute VDP commands as much as possible during the VBLANK period (right after the interrupt, which should be kept as short as possible or be executed at a later time by using a line interrupt). They should execute a little faster then.</p>

<p>Secondly, until now I always assumed a framerate of 50 or 60 fps. However, what about using a lower framerate? It doesn’t look all that bad, and nowadays it’s even quite common in games on for example the PSX or the PC to have a framerate of about 30 fps. So it might just be a good idea to half your framerate to 25 or 30 fps, which might perhaps look a little less smooth (though your eye’s sampling frequency is only 24 fps, and that’s also what every movie runs at), but in exchange for that you might just be able to pull out some extra dazzling effects, or super-large sprites. However, you will need to flip pages in order to do that, because otherwise the screen display will catch up with your copy’s, and your screen buildup will show. There is a way to circumvent the usage of an additional page though, under the conditions that a. your framerate doesn’t get any lower than half the interrupt frequency, and b. your screen is being built up from the top to the bottom. If those are the case, then the tip is: as soon as the VDP starts out displaying at line 0, you start out doing your copy’s. The VDP won’t catch up with you then until after 2 interrupts. Mind you though, that this way you actually only get Display Cycle 1 + VBLANK period 1 + Display Cycle 2, which is not two full display cycles. Also, if my previous statement (about the VBLANK period being the fastest) is true, the gained speed might be not as much as expected. Page flipping will always be easier, and leave you more time for the copies.</p>

<p>I might put some more research into this and get more measurements about the latter two unknowns, being whether VBLANK is faster and how much can be done in the timeframe of the  trick I just described.</p>


<h2 id="tests">The tests</h2>

<p>Now all that’s left is a small remark on how the tests were done. This is the procedure I basically used:</p>

<ol type="1">
<li>Disable the interrupts first.<br />
    (we don’t want nasty interrupt-handlers to mess up our measurements)</li>
<li>Wait for the VBLANK period to start (by means of polling).</li>
<li>Issue the command.</li>
<li>Wait for the next VBLANK period to start.</li>
<li>Check if the command was executed within the timeframe of 1 interrupt.<br />
    (by checking whether the VDP is ready for the next command already)</li>
<li>If not, decrease the command’s size and repeat from step 2.</li>
<li>If so, the vdp’s speed is found, the end.</li>
</ol>

<p>I gradually increased the command’s size by changing the height of the copy/fill, and the accuracy was determined by its width. You can try it for yourself with the test tool linked to at the top of this article.</p>

<p>Well, that’s it.</p>

<p>~Grauw</p>




<?php addFooter(); ?>
</body>
</html>