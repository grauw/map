<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>MSX Basic tips and tricks</h1>

<div class="updates">
<h2>Latest updates:</h2>

<p><em>2005-02-10</em><br />
Initial version.</p>
</div>

<p>This article contains several tips and tricks for the Basic programmer. Note that this is just a start, a stub, I will not actively seek for new stuff to write there (although if I encounter a good tip incidentally I will add it - if I remember to do so). So people who have additional tips are encouraged to send a mail, and I will add them to the article...</p>

<ul>
<li><a href="#fornextgoto">Jumping out of a <code>FOR</code> loop without increasing the <code>FOR/NEXT</code> stack</a></li>
<li><a href="#speedtips">Speed opportunities in MSX Basic</a></li>
<li><a href="#ramtips">Reducing RAM usage</a></li>
<li><a href="#nestorpreter">Konamiman’s NestorPreTer</a></li>
<li><a href="#usefulpokes">Useful pokes</a></li>
</ul>



<h2 id="fornextgoto">Jumping out of a <code>FOR</code> loop without increasing the <code>FOR/NEXT</code> stack</h2>

<p>When you have a <code>FOR/NEXT</code> loop, Basic will place a counter on an internal stack. This counter is removed when the loop ends, however if you jump out of a loop like in the following example, the counter will never be removed. If you repeat this often enough, the stack will overflow and Basic will quit the program with an error:</p>

<pre class="code">10 FOR I=0 TO 1000
20 IF STRIG(0) THEN GOTO 40
30 NEXT
40 GOTO 10
</pre>

<p>This can be avoided by ending the loop manually before jumping away, like this:</p>

<pre class="code">20 IF STRIG(0) THEN I=1000:NEXT:GOTO 40</pre>

<p>Alternatively, you can place the <code>FOR/NEXT</code> in a subroutine use <code>RETURN</code> to exit from it, because any remaining stack will be cleaned up by the <code>RETURN</code> command. This is in theory actually also a good programming practice, resembling the <code>break</code> command in many C-style languages.</p>

<p><em>(contributors: [D-Tail])</em></p>


<h2 id="speedtips">Speed opportunities in MSX Basic</h2>

<p>There are several little tricks to make Basic run faster. Here are a number of them:</p>

<ul>
<li>Use <code>DEFINT</code> for the variables where you only use integer values (whole values). This is pretty much the biggest gain in speed you can get. For example, if your program only uses integers, use <code>DEFINT A-Z</code>.</li>
<li>Sometimes, specifying the type directly on variables (using <code>%</code> for integers) is even faster than <code>DEFINT</code>. For example, <code>DEFINT I:FOR I=0 TO 9000:NEXT I</code> takes 533 TIME ticks to complete. <code>FOR I%=0 TO 9000:NEXT I%</code> takes 509 TIME ticks. In another test however I didn’t observe a difference, so this doesn’t always make a difference.</li>
<li>In a <code>FOR/NEXT</code> loop, you can specify the variable with <code>NEXT</code>, like: <code>FOR I=0 TO 1:NEXT I</code>. It is however faster to write <code>FOR I=0 TO 1:NEXT</code>, without the <code>I</code>.</li>
<li>If you remove spaces from the sourcecode as much as possible, it will also be faster (and more difficult to read).</li>
<li>An <code>IF 1 THEN GOTO 1000</code> can be abbreviated in two ways: <code>IF 1 THEN 1000</code> and <code>IF 1 GOTO 1000</code>. Of the two, the latter is faster.</li>
</ul>

<h3>Speed measuring</h3>

<p>Measuring the speed of a Basic routine can be done as follows:</p>

<pre class="code">10 TIME=0
20 '... (put code here)
30 PRINT TIME
</pre>

<p>The unit of the shown result is <dfn>interrupts</dfn>, which depending on the display frequency (PAL or NTSC) is either 1/50th or 1/60th of a second. You can find out which frequency your MSX runs on by typing <code>PRINT VDP(10) AND 2</code>. If the answer is ‘2’, then the frequency is 50Hz, if the answer is ‘0’, then it is 60Hz.</p>


<h2 id="ramtips">Reducing RAM usage</h2>

<p>What follows are a number of methods to decrease the size (and also increase the speed) of an MSX Basic program. Note that many of these things greatly reduce the readibility of your source.</p>

<ul>
<li>Remove <code>REM</code> and <code>'</code> comments and remarks.</li>
<li>Remove all spaces, unless it creates ambiguity (i.e. do not remove spaces in <code>AX OR BX</code> because Basic will then read the resulting <code>AXORBX</code> as <code>A XOR BX</code>).</li>
<li>Make the variable names as small as possible (that is, 1 character).</li>
<li>If you don’t use <code>OPEN</code>, set <code>MAXFILES=0</code>.</li>
<li>Instead of <code>DATA</code> statements, use BIN files loaded with <code>BLOAD</code>.</li>
<li>Remove arrays you don’t use anymore from memory using the <code>ERASE</code> command.</li>
<li>If you use the <code>CLEAR</code> command, make sure you allocate the minimum amount of memory necessary for your strings. Similarly, if you create arrays with DIM, make sure you allocate the correct amount.</li>
<li>Declare integer variables as integers using <code>DEFINT</code>.</li>
</ul>

<p>Additional tips for KUN-BASIC or any of its variants (XBasic/NestorBASIC):</p>

<ul>
<li>Split up your TURBO blocks, if possible. They are compiled into memory at once, and thus having smaller blocks means less memory needed for the compiled code.</li>
<li>Check if NestorBASIC functions 55-57 are useful for you (note: I have no clue as to what they do).</li>
<li>For more tips take a look at <a href="http://www.mccw.hetlab.tk/93/nestor/en.html">NestorTIPS for NestorBASIC</a> on MCCW 93, written by Nestor himself.</li>
</ul>

<p><em>(contributors: DarQ, flyguille, NYYRIKKI and manuel)</em></p>



<h2 id="nestorpreter">Konamiman’s NestorPreTer</h2>

<p>Konamiman has created a program called <a href="http://www.konamiman.com/msx/msx-e.html#nestorpreter">NestorPreTer</a>, with which you can get around many of the limitations of MSX Basic. With NestorPreTer, you can for example use labels instead of line numbers, have longer variable names, and create macros. NestorPreTer then converts that into real optimized MSX Basic code.</p>


<h2 id="usefulpokes">Useful pokes</h2>

<p>The following pokes can be useful to the Basic programmer:</p>

<table>
	<tr>
		<th>Poke</th>
		<th>Function</th>
	</tr>
	<tr><!-- note: spaces in the pokes are nonbreaking spaces, enter them using ALT+0160... -->
		<td>POKE &amp;HFBB0,1</td>
		<td>Enables you to use the CTRL-SHIFT-CODE-GRAPH key combination to quit a program even if you normally couldn’t. Especially useful for KUN-BASIC programs or programs with an ON STOP GOSUB handler.</td>
	</tr>
	<tr>
		<td>POKE &amp;HFBB1,1</td>
		<td>Disable CTRL-STOP.</td>
	</tr>
	<tr>
		<td>POKE &amp;HF677,&amp;Hxx<br />
		    POKE &amp;HF676,&amp;Hyy + 1<br />
			POKE &amp;Hxxyy,0</td>
		<td>Changes Basic load address to the given value of &amp;Hxxyy (where you can fill in xxyy to e.g. &amp;HC000). The next program that is loaded will run from that address instead of &amp;H8000 (the default). Useful for hybride programming where you want to use the address &amp;H8000-&amp;HBFFF for assembly code or data. A loader could for example check whether these values are set, and if not, set them and reload itself.</td>
	</tr>
</table>


<p class="signed">Grauw</p>


<?php addFooter(); ?>
</body>
</html>