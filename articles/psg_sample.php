<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Playing samples on the PSG</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Playing samples on the PSG</h1>

<p>I wrote a question about playing samples on the PSG to the MSX Mailinglist once, and Ricardo Bittencourt replied with an explanation of various techniques, which I have quoted below. After that the article continues, describing the logarithmic nature of the PSG volume, and how to utilise it to achieve 8-bit samples on the PSG.</p>

<p>Table of contents:</p>

<ul>
<li><a href="#ricardo">Ricardo’s explanation</a></li>
<li><a href="#logvolume">Logarithmic volume scale</a></li>
<li><a href="#8bitsamples">Playing better samples on the PSG</a></li>
</ul>


<h2 id="ricardo">Ricardo’s explanation</h2>

<blockquote>
<p>
<b>From:</b> Ricardo Bittencourt Vidigal Leitao<br />
<b>To:</b> MSX Mailinglist<br />
<b>Date:</b> monday, june 22nd 1998, 18:58<br />
<b>Subject:</b> Re: A question about the PSG &amp; samples
</p>

<p>On Mon, 22 Jun 1998, Laurens Holst wrote:</p>

<blockquote>
<p>=== How to replay samples via the PSG??? ===</p>
</blockquote>

<p>You have to use an undocumented feature of the PSG. When you select a period of 0 in the register 6, the noise produced is just like the noise when you select 1 in the same register. But this does not apply to the square wave generators. When you write a 0 to registers 0 and 1, what’s happening is that you TURN OFF THE OSCILLATORS. Since the PSG uses active low logic, the signal on the output is set to “1” and doesn’t change with time. Now comes the trick. This “1” is affected by the register 8 (volume register). This way, if you change the value of register 8 very quickly, you can modulate the output and generate a nice 4-bit PCM. This method is used in the game “Aleste 2”.</p>

<p>I made a program to test this feature, it’s called “readwav” and it can play .WAV files of 11 kHz. It can be found at <a href="http://www.lsi.usp.br/~ricardo/msx.htm">http://www.lsi.usp.br/~ricardo/msx.htm</a> (note: this page apparantly doesn’t exist anymore, it has <a href="http://www.700km.com.br/mundobizarro/">moved</a>, but I can’t find the program on the new page). The maximum wave size is about 50kb but Walter “Marujo” made a new version that plays files up to 100kb, I’ll try to add it to the home page as soon as possible. There is no source code included, but my original assembly source doesn’t have any comments, the best you can do is disassemble it by hand (it has only 512 bytes anyway). Oh, this 11 kHz is arbitrary; by removing a void-loop in the middle of the code you can reach up to 35 kHz.</p>

<p>Please note this is not the only way to generate samples on MSX1. You can also use the keyclick to generate 1-bit PCM (used in the game “Super Laydock” for example).</p>

<p>Another undocumented feature of the PSG permits a variation on the first method. Most people think the lower bits of register 7 are used to set the volume of a channel to zero. This is not true, the bit actually controls the oscillator. So, by disabling a channel in register 7, you can write any values you want in registers 1 and 0 and still use the initial method (btw, this is used in “Oh Shit”).</p>

<p>A last method is to select a sound with a very low frequency, and change the volume faster than this frequency. This method is not used in any MSX game that I know, since it is very inaccurate. But it’s used a lot in the Sega Master System, in games like “Afterburner”. The Sega Master System, for those who don’t know, is a videogame system heavily based on the MSX. It uses a Z80 and a sound chip with the same characteristics as the AY-3-8910 (but it doesn’t have envelopes).</p>

<p>- Ricardo Bittencourt</p>
</blockquote>

<p>Note that the example Ricardo gives uses processor-dependant timing. I myself wrote a sample player for a printer port DAC (‘SiMPL’) once, which ‘calibrated’ itself first before playing a sample, making it work independantly of the processor’s speed. I basically did that by playing a ‘silent’ sample a number of times at different rates during fixed intervals, and measuring at what rate it could fit the desired number of samples within the interval. Actually it was funnier to use a nonsilent sample (a sine wave instead) ^_^.</p>

<h2 id="logvolume">Logarithmic volume scale</h2>

<p>One thing that this email fails to mention is that the volume control of the PSG operates on a logarithmic scale. Every 2 volume decrements cut the output volume in half. Because of this, you cannot just take the most significant 4 bits of an existing sample and send it to the PSG. Instead, you have to map the values to a logarithmic scale. The formula for this scale is:</p>

<table class="spacycells">
<tr>
<th>Formula (MathML)</th>
<th>Formula (non-MathML)</th>
</tr>
<tr>
<td>
<math xmlns="http://www.w3.org/1998/Math/MathML" display="block">
  <mrow>
    <mi>y</mi>
    <mo>=</mo>
    <msup>
      <mn>2</mn>
      <mrow>
        <mo>-</mo>
        <mfenced>
          <mrow>
            <mfrac>
              <mrow>
                <mn>15</mn>
                <mo>−</mo>
                <mi>n</mi>
              </mrow>
              <mn>2</mn>
            </mfrac>
          </mrow>
        </mfenced>
      </mrow>
    </msup>
  </mrow>
</math>
</td>
<td>y = 2^-((15-n)/2)</td>
</tr>
</table>

<p>Where <math xmlns="http://www.w3.org/1998/Math/MathML" display="inline"><mi>n</mi></math> is the volume, a value from 0 … 15. There is one exception: 0. When the volume is zero, so is the output.</p>

<p>This corresponds to the following table:</p>

<table>
	<tr>
		<th>PSG volume</th>
		<th>DAC output</th>
		<th>8-bit sample</th>
	</tr>
	<tr>
		<td>0</td>
		<td>0</td>
		<td>0</td>
	</tr>
	<tr>
		<td>1</td>
		<td>0,0078125</td>
		<td>2</td>
	</tr>
	<tr>
		<td>2</td>
		<td>0,0110485</td>
		<td>3</td>
	</tr>
	<tr>
		<td>3</td>
		<td>0,015625</td>
		<td>4</td>
	</tr>
	<tr>
		<td>4</td>
		<td>0,0220971</td>
		<td>6</td>
	</tr>
	<tr>
		<td>5</td>
		<td>0,03125</td>
		<td>8</td>
	</tr>
	<tr>
		<td>6</td>
		<td>0,0441942</td>
		<td>11</td>
	</tr>
	<tr>
		<td>7</td>
		<td>0,0625</td>
		<td>16</td>
	</tr>
	<tr>
		<td>8</td>
		<td>0,0883883</td>
		<td>23</td>
	</tr>
	<tr>
		<td>9</td>
		<td>0,125</td>
		<td>32</td>
	</tr>
	<tr>
		<td>10</td>
		<td>0,1767767</td>
		<td>45</td>
	</tr>
	<tr>
		<td>11</td>
		<td>0,25</td>
		<td>64</td>
	</tr>
	<tr>
		<td>12</td>
		<td>0,3535534</td>
		<td>90</td>
	</tr>
	<tr>
		<td>13</td>
		<td>0,5</td>
		<td>128</td>
	</tr>
	<tr>
		<td>14</td>
		<td>0,7071068</td>
		<td>180</td>
	</tr>
	<tr>
		<td>15</td>
		<td>1</td>
		<td>255</td>
	</tr>
</table>

<p>Because of this logarithmic scale, I’d say the actual sample quality of the PSG, even though 4-bits, is really comparable to a 3- or perhaps even 2-bit linear DAC.</p>

<p><em>Thanks go to Arturo Ragozini for pointing this out.</em></p>


<h2 id="8bitsamples">Playing better samples on the PSG</h2>

<p>However, that same logarithmic scale can also work to our advantage. The PSG mixer in MSX machines is simple, the channels are simply added together, which allows us to combine the power of the three channels. By doing that, we can compensate for the lack of precision at e.g. the 0.5 output value of channel 1 (volume 13) by using the lower ranges of channel 2! For example, if you would want to output 0.51, you would generate an additional output of 0.01 on channel 2 (volume 2) which is then added to the first channel. When combining three channels this way, we can get 608 discrete sample values!</p>

<p>608 values, that’s about 9 bits of sample information. Not too shabby :). Note that the values are not evenly spaced apart so most of them will have deviations compared to a linear scale, ranging from small ones in the lower ranges to bigger ones in the top ranges. Because of that, the top range is much less useful, but it would probably distort anyway because of the high amplitude.</p>

<p>I created a C# program to calculate what combinations of volumes would have to be used, and to brute force check over what range the deviations would be the least. Without boring you with all the specific details, I have found that when running over a range from 0 to 1.328 (out of 3), the signal-to-noise ratio is the best. The resulting lookup table for that range, mapping 8-bit sample values to PSG channel volumes, is included in the replay routine below:</p>

<pre>;
; PSG sample replay routine
;
; hl = sample start address
; de = sample length
;
    exx
    ld c,#A1
    ld d,0
    exx
Loop:
    ld a,(hl)
    inc hl
    exx
    ld e,a
    ld hl,PSG_SAMPLE_TABLE
    add hl,de
    ld b,(hl)
    inc h
    ld e,(hl)
    inc h
    ld h,(hl)
    ld a,8
    out (#A0),a     ; play as fast as possible
    inc a
    out (c),b
    out (#A0),a
    out (c),e
    inc a
    out (#A0),a
    out (c),h
    
    ld b,8          ; timing wait loop
WaitLoop:
    djnz WaitLoop

    exx
    dec de
    ld a,d
    or e
    jp nz,Loop
    ret

PSG_SAMPLE_TABLE:
    db 00,01,02,03,04,03,05,03,04,05,06,06,05,06,06,06
    db 06,06,07,06,07,08,08,08,07,07,09,07,09,09,08,08
    db 09,09,08,09,09,09,09,09,10,10,10,10,09,09,10,10
    db 10,10,09,10,11,11,11,11,11,11,11,11,10,10,10,11
    db 11,11,11,11,11,11,11,12,11,11,12,12,11,12,11,12
    db 12,12,12,11,12,11,12,12,12,12,11,12,12,12,12,11
    db 12,13,12,13,11,13,13,13,13,13,13,11,13,13,13,13
    db 13,13,13,12,13,13,13,12,12,13,12,13,13,13,13,13
    db 13,12,13,13,13,13,13,13,13,14,13,13,14,14,14,14
    db 14,14,13,14,14,13,14,14,14,14,14,14,13,14,14,14
    db 14,14,14,13,14,14,13,14,14,13,13,14,14,14,14,14
    db 14,14,14,14,13,14,14,13,14,14,14,14,14,14,13,14
    db 14,14,15,14,15,15,15,15,15,15,15,15,15,15,15,15
    db 14,15,15,15,15,15,15,14,15,15,15,15,15,15,15,15
    db 15,15,15,15,15,15,15,15,15,15,15,14,15,14,14,14
    db 14,14,15,15,14,15,15,14,15,15,15,15,15,15,15,14

    db 00,00,00,00,00,02,00,02,02,03,01,02,04,04,03,04
    db 04,05,04,05,05,02,03,04,06,06,01,06,02,03,06,07
    db 05,06,07,06,06,06,07,06,04,04,05,06,08,07,06,06
    db 07,06,08,07,03,04,03,04,04,05,05,05,08,09,09,07
    db 07,07,08,07,08,08,08,02,08,09,03,05,09,05,08,06
    db 06,07,06,10,07,09,08,07,08,08,09,08,08,09,08,10
    db 09,00,08,01,10,02,03,04,04,05,06,10,06,06,06,07
    db 06,07,07,10,08,08,07,11,11,08,11,08,09,09,09,08
    db 09,11,09,09,10,10,10,10,10,00,10,09,02,02,04,03
    db 04,04,11,05,05,11,07,07,07,07,07,08,10,08,08,08
    db 08,08,09,11,09,09,12,08,09,12,11,09,10,10,09,10
    db 10,10,10,09,11,10,10,12,10,10,11,11,11,10,12,11
    db 11,11,00,11,01,02,03,04,03,04,04,05,05,05,06,07
    db 12,07,07,07,08,07,08,12,08,08,08,09,08,09,09,09
    db 08,09,09,09,09,10,10,09,10,10,10,13,09,13,13,13
    db 13,13,10,11,13,11,10,13,11,11,11,11,11,10,10,12

    db 00,00,00,00,00,00,00,01,01,00,00,00,01,00,02,02
    db 03,02,01,04,01,01,01,01,03,04,00,05,01,01,04,01
    db 01,00,04,02,03,04,01,05,01,02,01,00,02,06,03,04
    db 01,05,06,04,00,00,02,02,03,02,03,04,06,02,03,02
    db 03,04,00,05,02,03,04,00,05,00,02,00,03,02,07,01
    db 02,00,04,00,03,07,00,05,02,03,08,04,05,00,06,07
    db 03,00,07,00,08,01,01,01,02,01,00,09,02,03,04,01
    db 05,03,04,07,01,02,06,01,02,05,04,06,02,03,04,07
    db 05,07,06,06,00,01,02,03,04,00,05,08,00,01,00,02
    db 02,03,00,03,04,03,00,01,02,03,04,00,09,02,03,04
    db 04,05,00,08,02,03,00,07,05,03,09,06,00,01,07,03
    db 04,04,05,08,10,06,06,08,07,07,00,00,01,08,09,04
    db 05,05,00,06,00,00,00,00,02,02,03,02,03,04,03,00
    db 01,02,03,04,00,05,02,06,04,04,05,00,06,02,03,04
    db 07,05,05,06,06,00,01,07,03,04,04,00,08,02,03,04
    db 04,05,07,00,06,01,08,07,04,05,05,06,06,09,09,11
</pre>

<p>In these values, each block of bytes corresponds to a PSG channel, and each index from 0…255 in one of these blocks bytes corresponds to a sample value point. The total maximum volume you should be able to generate with these is about 30% more than a single channel outputting at maximum volume. The speed can be optimized a little more by aligning the table to a multiple of 256 address, if you need it.</p>

<p>That should give you enough of a start to create nice PSG samples. For completeness’ sake, here is a link to download the C# program I created to find the optimal range with the least amount of errors: <a href="psg_sample/PSG_Sample.cs">PSG_Sample.cs</a>. If you want to output at a different volume, you can recalculate the table with it.</p>

<p><em>Again, thanks go to Arturo Ragozini for thinking this through.</em></p>




<?php addFooter(); ?>
</body>
</html>