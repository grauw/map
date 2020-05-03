<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Yamaha YM2164 OPP</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Yamaha YM2164 OPP</h1>

<p>While the Yamaha SFG-01 module for the CX5M computer series contained
the well-known YM2151 OPM, the SFG-05 module instead contained the
YM2164 OPP chip. Although for the most part equivalent to the YM2151,
there are a few differences in some of the control registers.</p>

<p>For the majority of functions, please refer to the
<a href="/resources/sound/yamaha_ym2151_synthesis.pdf">YM2151 OPM
application manual</a>. Below we will describe the differences.</p>

<h2 id="differences">Differences from the OPM</h2>

<p>Firstly, the <a href="/resources/sound/yamaha_ym2151_test.txt">test
register</a>. On the OPM the test register is at address 1. On the OPP,
the test register is at address 9. The one officially documented function
of the test register is the LFO reset function.</p>

<p>Secondly, timer B (CLKB). On the OPM it has a period of 1024 cycles.
On the OPP it has a period of 2048 cycles. Therefore any period value set
on the OPP should be shifted right by 1 bit relative to the OPM value.
Since the specified period is negated, make sure to shift in a “1” into
the leftmost bit when you do so.</p> 

<figure>
<p>
	<math xmlns="http://www.w3.org/1998/Math/MathML">
		<mrow>
			<msub>
				<mi>T</mi>
				<mi>B</mi>
			</msub>
			<mtext>(s)</mtext>
			<mo>=</mo>
			<mfrac>
				<mrow>
					<mphantom mathsize="0"><mo>(</mo></mphantom>
					<mn>2048</mn>
					<mo>*</mo>
					<mo>(</mo>
					<mrow>
						<mn>256</mn>
						<mo>-</mo>
						<mi>CLKB</mi>
					</mrow>
					<mo>)</mo>
					<mphantom mathsize="0"><mo>)</mo></mphantom>
				</mrow>
				<mrow>
					<mphantom mathsize="0"><mo>/</mo></mphantom>
					<mi>ϕM</mi>
				</mrow>
			</mfrac>
		</mrow>
	</math>
</p>

<p>
	<math xmlns="http://www.w3.org/1998/Math/MathML">
		<mi>ϕM</mi> <mo>=</mo> <mn>3579545</mn> <mo rspace="thickmathspace">&#x2062;</mo><mi>Hz</mi>
	</math>
</p>
</figure>

<p>Lastly, the OPP has 8 undocumented registers at addresses 0-7. These
are initialised to 10H by the SFG-05 BIOS. Their function is as of yet
unknown.</p>


<p class="signed">Grauw</p>




<?php addFooter(); ?>
</body>
</html>