<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Z80 Programming techniques - Loops</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Z80 Programming techniques - Loops</h1>

<div class="updates">
<h2>Latest updates:</h2>

<p><em>2005-08-11</em><br />
Optimized DoLDIR routine even more, yet another 5 ticks faster! (thanks Arnold Metselaar).</p>

<p><em>2004-01-22</em><br />
Optimized DoLDIR routine more, 5 ticks faster now, and corrected a small error (thanks GuyveR800).</p>

<p><em>2003-04-24</em><br />
Wrote a faster DoLDIR routine, corrected speed calculations, uses JP PE for 0-check now.</p>
</div>

<p>Here I will discuss two methods to drastically increase the execution speed of different kinds of loops in assembly.</p>

<ol>
<li><a href="#fastloops">Fast 16-bit loops</a>
	<ul>
	<li><a href="#varlength">Variable length loops</a></li>
	</ul>
</li>
<li><a href="#unrolling">Unrolling OTIRs and such</a>
	<ul>
	<li><a href="#unrollingldir">Making LDIR 21% faster</a></li>
	</ul>
</li>
</ol>


<h2 id="fastloops">Fast 16-bit loops</h2>

<p>Most often, you see 16-bit loops used like this:</p>

<pre>
	ld de,nnnn
loop:	...			; --- do something ---
	dec de
	ld a,d
	or e
	jp nz,loop
</pre>

<p>However there’s a much faster way to loop. In fact, you can loop 16 bit loops virtually as fast as 8 bit loop. Surprised??? Well, I’ll explain.</p>

<p>When you use a standard Z80 8-bit loop command like DJNZ, or OTIR, etc. the value of B is decreased until it reaches 0. If you want to loop 256 times, you can set the value of B to 0. Well, now the big thought behind this method is that you first loop the lsb amount of loops, then b reaches 0 (which means loop 256 times), and then you repeat that loop msb times. For example, if you want to loop 260 times, first you loop 4 times, and then you repeat that loop to get another 256 loops.</p>

<p>An explaining example (522 loops):</p>

<pre>
	ld b,10			;The LSB of the loop is 10
	ld d,3			;The MSB of the loop + the first loop is 3
loop:	...			; --- do something ---
	djnz loop
	dec d
	jp nz,loop
</pre>

<p>This will loop 522 times. If you want to loop 512 times, use b=0, d=2 and if you want to loop 511 times use b=255, d=2. In general, the rule is as follows: b is the lsb, and d is the msb increased by 1 UNLESS b equals 0 (otherwise you will loop 256 times too often).</p>

<p>Let’s compare the speed of this loop with a ‘common’ 16-bit loop. The common one takes 4 instructions to loop, and those add up to a total of <b>28 T-states</b> per loop. Now take this ‘fast’ loop. This one only uses 1 instructions to loop, and per loop the time spent is <b>14 T-states</b>, just like a normal 8-bit loop. Once every 256 loops, it also executes the 16-bit loop instructions. However also in that case, the time the loop uses is still less than the time a ‘normal’ loop takes: <b>25 T-states</b>.</p>

<p>Now this example utilizes fixed values. However it doesn’t really make clear how often the loop loops. So you should put the actual amount of loops in a comment next to it.</p>

<h3 id="varlength">Variable length loops</h3>

<p>If you want to use fast loops using a variable value (for example given as a parameter), you can calculate the correct values. This can be done using a conditional increase of the MSB. However, that requires a compare and a jump et al, which doesn’t make it pretty to read and such, and besides, it can simply be done faster. You see, you can also utilize a small calculation which does exactly the same, it goes like this (source value is in de, result will be in ‘db’):</p>

<pre>
	dec de			;Mystery fast loop calculus
	ld b,e
	inc b
	inc d
</pre>

<p>That’ll only take you like 22 T-states to precalculate the value. And compared to ‘normal’ 16-bit loops, you’ll regain that loss already after a loop or two.</p>

<p>So, to summarize, a full-fledged fast 16-bit loop looks like this:</p>

<pre>
	dec de			;Number of loops is in DE
	ld b,e			;Calculate DB value (destroys B, D and E)
	inc b
	inc d
loop:	...			; --- do something ---
	djnz loop
	dec d
	jp nz,loop
</pre>





<h2 id="unrolling">Unrolling OTIRs and such</h2>

<p>When you want to send a block from your memory to a certain port, you can use the OTIR instruction. With this instruction you can specify a number of loops. This is for example used a lot in routines which execute VDP commandos, where the part which actually sends the VDP command usually looks like this:</p>

<pre>
	ld hl,commando		;the address where the VDP-commando is stored
	ld c,#9B		;the VDP port to write to
	ld b,15			;the number of loops (yes, ld bc,#0F9b is faster)
	otir
</pre>

<p>However, if you know in advance how many loops the otir will go through, and if this number of loops is a reasonable amount and you don’t care too much about wasting a little space, you can also use the OUTI instruction instead of the OTIR instruction. OUTI doesn’t loop automatically, but it does its work in 17 T-states, 5 T-states faster than OTIR which needs 22 T-states per loop. So if you just write the OTIR out using 15 OUTIs, it saves you 5 T-states per loop (except for the last one), a grand total of 70 T-states out of 325 (that’s about 22% faster). As an example, I’ll give you DoCopy (which executes a VDP-commando), which was made faster by using 15 OUTIs instead of an otir:</p>

<pre>
;
;DoCopy - Faster by using OUTIs.
;
DoCopy:	ld a,32
	di
	out (#99),a
	ld a,17+128
	ei
	out (#99),a
	ld c,#9B
VDPready:
	di
	ld a,2		;set s#2
	out (#99),a
	ld a,15+128
	out (#99),a
	ld a,(de)	;waste some time...
	in a,(#99)
	rra
	ld a,0		;set s#0, NO xor because that’ll clear the carry
	out (#99),a
	ld a,15+128
	ei
	out (#99),a
	jp c,VDPready
	outi		;15x OUTI
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	outi
	ret
</pre>

<p>To make this look a little more compact you can also replace the 15 OUTIs with</p>

<pre>
	DW	#A3ED,#A3ED,#A3ED,#A3ED		;15x OUTI (#ED #A3)
	DW	#A3ED,#A3ED,#A3ED,#A3ED
	DW	#A3ED,#A3ED,#A3ED,#A3ED
	DW	#A3ED,#A3ED,#A3ED
</pre>

<p>or, if your assembler supports a repeat instruction, something like</p>

<pre>
	REPEAT 15
	outi
	ENDR
</pre>

<p>On a sidenote, even though the OUTIs speed up the execution time of this routine, this DoCopy is still not the fastest one possible, since you can make the wait loop a lot shorter and faster (in other words, improve the response time) by using status register 2 as the default, instead of 0. However, to do that you need to use your own interrupt routine, which I won’t explain here ^_^.</p>

<h3 id="unrollingldir">Making LDIR 21% faster</h3>

<p>Now, on with the lesson. Aside from OTIR you can also expand other things. INIRs, LDIRs and LDDRs will also greatly benefit from this method, and you can also expand ‘normal’ loops which use DJNZs, JRs and JPs. The benefit gained in the latter case however is probably much less, since those loops take often longer and relatively seen the gain by removing the conditional jump will then be smaller. Also, if you expand those they will usually take up a lot more space and at the same time will become more error-prone because if you want to make a change you’ll have to change it x times (and if you forget only one of those... you’ve created a fresh bug).</p>

<p>In the case of LDIRs however, the number of loops is often too large to simply use an LDI that number of times. That would take up too much space. So, what we can do instead, is expanding only part of the loop. Say, we need to LDIR something 256 (#100) times. Instead of LDIR we could then for example write:</p>

<pre>
	ld bc,256
Loop:	REPEAT 16	;I’ll use repeat here (non-existant in compass) (yet?)
	ldi		; to make things a little shorter. It is the same
	ENDR		; as writing 16x ldi.
	jp pe,Loop	;Loop until bc = zero
</pre>

<p>This method is almost 21% faster than an LDIR. Relatively seen the JP PE (the parity flag is set to even as long as BC != 0) doesn’t cause too much additional overhead, and if you still think it does you can increase the number of LDIs to gain an additional few percents of speed, up till almost 24%.</p>

<p>However, as you might already have noticed, this will only work if the number of loops is a multiple of 16. If it’s not, the BC will never be 0 at the end of a string of 16 LDIs, so then we’ll get an endless loop, and later probably a reset (because at some point it’ll overwrite itself or other vital routines). That’s not what we want. If the number of loops is known in advance, it’s easiest to put some additional LDIs after the loop. However if the number of loops is unknown, or you simply want a fast but generic alternative for LDIR, you could try and detect when the last loop is started, and in that case let a ‘normal’ LDIR handle the last few loops. Well, that isn’t too hard, it can be handled using a few compare’s. A faster and slightly trickier method is to jump inside the string of LDIs depending on the modulus.</p>

<p>It is ofcourse possible to put all this code inline, but I would rather recommend you to make a subroutine out of it. Compared to the time an LDIR usually takes to execute, the overhead of the additional CALL and RET is rather negligible (unless it’s a short ldir inside a loop ofcourse), and it makes your code look a lot better and less bug-prone. In any case, here’s the code for a fast LDIR. I think 21% additional speed is really a lot, so I hope it’ll be of use ^_^.</p>

<pre>
;
;DoLDIR - About 21% faster alternative for large LDIRs
;
DoLDIR:	xor a
	sub c
	and 16-1
	add a,a
	ld (DoLDIR_SelfM+1),a
DoLDIR_SelfM:
	jr nz,$
DoLDIR_Loop:
	REPEAT 16
	ldi
	ENDR
	jp pe,DoLDIR_Loop
	ret
</pre>

<p>It first calculates the number of loops modulo the LDI string size, then uses a self modifying relative jump to jump to the correct starting position inside the LDI string. Again, if you want it to become a little faster, replace the 16’s with a higher value (must be a power of 2, and because of JR range limitations max. 64, which is 23% faster). Note by the way that because of the added initialisation, which takes 61 T-states (if used inline), it will only be faster with BC &gt; 12.</p>


<p>Well, that’s it.</p>


<p>~Grauw</p>




<?php addFooter(); ?>
</body>
</html>