<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>The YJK screen modes</title>
  <?php addStyles(); ?>
  <link rel="stylesheet" type="text/css" href="yjk.css" />
  <script type="module" src="vector.js"></script>
  <script type="module" src="visualizer.js"></script>
  <script type="module">
    import { Visualizer } from "./visualizer.js";
    new Visualizer(document.querySelector('.visualizer'));
  </script>
</head>
<body>
<?php addHeader(); ?>

<h1 id="colour-space">The YJK screen modes</h1>

<figure class="visualizer tool">
  <figcaption>Interactive YJK colour space visualisation</figcaption>
  <p class="charts">
    <canvas class="jk" width="384" height="384"></canvas>
    <canvas class="y" width="32" height="384"></canvas>
  </p>
  <p class="controls">
    <span class="yjk group">
      <label>Y <input class="y" type="number" min="0" max="31" size="3" value="16" /></label>
      <label>J <input class="j" type="number" min="-32" max="31" size="3" /></label>
      <label>K <input class="k" type="number" min="-32" max="31" size="3" /></label>
    </span>
    <span class="rgb group">
      <label>R <input class="r" type="number" min="0" max="31" size="3" /></label>
      <label>G <input class="g" type="number" min="0" max="31" size="3" /></label>
      <label>B <input class="b" type="number" min="0" max="31" size="3" /></label>
    </span>
  </p>
  <p class="options">
    <label><input class="range" id="range" type="checkbox" /> Clip range</label>
    <label><input class="yae" type="checkbox" /> YAE mode</label>
  </p>
</figure>

<p>An exploration of the YJK screen modes of the MSX2+.</p>

<ul>
  <li><a href="#introduction">Introduction</a></li>
  <li><a href="#selecting">Selecting the YJK modes</a></li>
  <li><a href="#encoding">The encoding of YJK</a></li>
  <li><a href="#conversion">Conversion between YJK and RGB</a></li>
  <li><a href="#drawing">Drawing techniques</a></li>
  <li><a href="#comparison">Comparison to Y′UV</a></li>
</ul>


<h2 id="introduction">Introduction</h2>

<p>
  The Yamaha V9958 <abbr title="Video Display Processor">VDP</abbr> used in the
  MSX2+ and MSX turbo R adds two high colour display modes which use a different
  colour encoding than traditional RGB, called YJK and YJK+YAE. These modes
  expand the colour count to 19268 and 12499 + 16 respectively, at the cost of
  colour attribute clash between groups of 4×1 pixels.
</p>

<p>
  The YJK mode is MSX-BASIC’s SCREEN 12. It can show up to 19268 colours, and is
  particularly suited for photographic images because these are generally fairly
  unaffected by colour attribute clash. See
  <a href="http://tomseditor.com/gallery/browse?platform=msx&amp;format=screen12">art gallery</a>.
</p>

<p>
  The YJK+YAE mode is MSX-BASIC’s SCREEN 10 and 11. It can show up to 12499 YJK
  colours, and 16 palette colours (out of 512). Since the palette colours are set
  per-pixel they can be used to hide colour bleeding, while the YJK colours can
  be used to make the picture more colourful. Due to this YJK+YAE is more versatile
  in situations when you also want to display a user interface, like in a game. See
  <a href="http://tomseditor.com/gallery/browse?platform=msx&amp;format=screen10">art gallery</a>.
</p>

<p>
  An additional benefit of these new screen modes have compared to SCREEN 8 is
  that their sprites make use of the palette, rather than a limited set of
  predefined colours.
</p>



<h2 id="selecting">Selecting the YJK modes</h2>

<p>
  The MSX2+ BIOS <a href="http://map.grauw.nl/resources/msxbios.php#CHGMOD">CHGMOD</a>
  routine can be called with the MSX-BASIC SCREEN number in register A.
</p>

<p>
  On the VDP the YJK mode is selected by following the procedure to select
  SCREEN 8 (G7), and then setting the YJK bit of register 25. To select the
  YJK+YAE mode, additionally set the YAE bit.
</p>

<figure>
  <table>
    <caption>VDP register 25</caption>
    <tr><th></th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th><th>0</th></tr>
    <tr><th>r#25</th><td>0</td><td>CMD</td><td>VDS</td><td>YAE</td><td>YJK</td><td>WTE</td><td>MSK</td><td>SP2</td></tr>
  </table>
</figure>

<figure>
  <table>
    <caption>Combination of YJK and YAE data</caption>
    <tr><th>YJK</th><th>YAE</th><th>VRAM data</th></tr>
    <tr><td rowspan="2">0</td><td>0</td><td rowspan="2">Via the conventional colour palette</td></tr>
    <tr><td>1</td></tr>
    <tr><td rowspan="2">1</td><td>0</td><td>A=0: Via the RGB → YJK conversion table</td></tr>
    <tr><td>1</td><td>A=1: Via the colour palette</td></tr>
  </table>
</figure>

<p>
  Since a number of MSX2 computers exist that do have a V9958 but no BIOS
  support, as well modded MSX2 computers with their VDP replaced, consider using
  <a href="http://map.grauw.nl/resources/msxbios.php#CHGMOD">CHGMOD</a> to
  switch to SCREEN 8 and then setting the YJK and YAE bits in r#25
  manually. The other bits can be left at 0.
</p>

<p>
  In MSX-BASIC, SCREEN 12 and 11 have no special support for drawing in YJK
  other than using 8-bit colour operations. However SCREEN 10 is special,
  it gives a palette-colour view of YJK+YAE and allows you to draw on it like
  in SCREEN 5. Switching between SCREEN 10 and 11 will not clear the screen.
</p>


<figure class="floatright">
  <a href="https://www.deviantart.com/teruchan/art/super-new-Gulliver-s-Travels-133313733"><img src="colorbleed.png" /></a>
  <figcaption>Pure red and pure black is a difficult combination for YJK.<br />
  Artwork: Gulliver by Teruchan</figcaption>
</figure>

<h2 id="encoding">The encoding of YJK</h2>

<p>
  YJK breaks down into three components. The Y component specifies brightness (luma)
  and a little bit of blue. The J and K components contain most of the colour
  information (chroma), expressed as a difference between Y and red and green,
  respectively. The concept behind this encoding is that the human eye is more
  sensitive to brightness than colour, and the colour resolution can therefore be
  reduced with relatively limited impact on the perceived result.
</p>

<p>
  Use the visualisation widget above to get a feel of the YJK colour space.
  You can interact with this widget to view the various colour ramps available.
  The horizontal axis is the J value, the vertical axis is K. The column on the
  right controls the Y amount. All colours in the Y column can be used in the
  same four-pixel group. As you increase Y the colour becomes brighter, but
  notice that it becomes slightly more blue as well. This can be seen well in
  the grayish hue when both J and K are zero.
</p>

<p>
  In YJK mode the VDP stores the J and K components in 6 bits as a two’s complement
  signed value (-32 to 31). These are shared between 4 adjacent pixels. The Y component
  is a 5-bit unsigned value (0 to 31). This one can be specified per-pixel.
</p>

<figure>
  <table>
    <caption>YJK (SCREEN 12)</caption>
    <tr><th></th><th>C7</th><th>C6</th><th>C5</th><th>C4</th><th>C3</th><th>C2</th><th>C1</th><th>C0</th></tr>
    <tr><td>1 dot</td><td colspan="5">Y<sub>1</sub></td><td colspan="3">K<sub>low</sub></td></tr>
    <tr><td>1 dot</td><td colspan="5">Y<sub>2</sub></td><td colspan="3">K<sub>high</sub></td></tr>
    <tr><td>1 dot</td><td colspan="5">Y<sub>3</sub></td><td colspan="3">J<sub>low</sub></td></tr>
    <tr><td>1 dot</td><td colspan="5">Y<sub>4</sub></td><td colspan="3">J<sub>high</sub></td></tr>
  </table>
</figure>

<p>
  In YJK+YAE mode the VDP still stores the J and K components in 6 bits as a
  two’s complement signed value (-32 to 31). However the Y component can now
  only specify even values (0, 2, 4 .. 30), as its least significant bit is
  used for the attribute bit A. If the A bit is set, the top four bits of
  the Y component specify a palette colour to use instead.
</p>

<figure>
  <table>
    <caption>YJK+YAE (SCREEN 10-11)</caption>
    <tr><th></th><th>C7</th><th>C6</th><th>C5</th><th>C4</th><th>C3</th><th>C2</th><th>C1</th><th>C0</th></tr>
    <tr><td>1 dot</td><td colspan="4">Y<sub>1</sub></td><td>A</td><td colspan="3">K<sub>low</sub></td></tr>
    <tr><td>1 dot</td><td colspan="4">Y<sub>2</sub></td><td>A</td><td colspan="3">K<sub>high</sub></td></tr>
    <tr><td>1 dot</td><td colspan="4">Y<sub>3</sub></td><td>A</td><td colspan="3">J<sub>low</sub></td></tr>
    <tr><td>1 dot</td><td colspan="4">Y<sub>4</sub></td><td>A</td><td colspan="3">J<sub>high</sub></td></tr>
  </table>
</figure>

<p>
  The palette is still specified as 9 bits, with 3 bits per component. However
  the V9958’s DAC is 15-bit, so there must be some kind of mapping in place.
  Indeed, the 3-bit RGB palette component values map to 5 bits as follows:
</p>

<figure>
  <table>
    <caption>3-bit to 5-bit conversion</caption>
    <tr><th>V9938</th><th>V9958</th></tr>
    <tr><td>0</td><td>0</td></tr>
    <tr><td>1</td><td>4</td></tr>
    <tr><td>2</td><td>9</td></tr>
    <tr><td>3</td><td>13</td></tr>
    <tr><td>4</td><td>18</td></tr>
    <tr><td>5</td><td>22</td></tr>
    <tr><td>6</td><td>27</td></tr>
    <tr><td>7</td><td>31</td></tr>
  </table>
</figure>

<figure>
  <figcaption>3-bit to 5-bit conversion</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow>
        <msub><mi>c</mi><mi>out</mi></msub>
        <mo>=</mo>
        <mo>⌊</mo>
        <mn>4.5</mn>
        <mo>&#x2062;</mo>
        <msub><mi>c</mi><mi>in</mi></msub>
        <mo>⌋</mo>
      </mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow>
        <msub><mi>c</mi><mi>out</mi></msub>
        <mo>=</mo>
        <msub><mi>c</mi><mi>in</mi></msub>
        <mo>&lt;&lt;</mo>
        <mn>2</mn>
        <mo>OR</mo>
        <msub><mi>c</mi><mi>in</mi></msub>
        <mo>>></mo>
        <mn>1</mn>
      </mrow>
    </math>
  </p>
</figure>

<p>This applies to all screen modes, by the way.</p>


<h2 id="conversion">Conversion between YJK and RGB</h2>

<p>
  The Y, J and K values specify 17 bits of information in total. The V9958
  converts these to 15-bit RGB with 5 bits per colour component. The
  <a href="/resources/video/yamaha_v9958.pdf">V9958 manual</a> describes the
  following conversion formulas for YJK. The formulas for YJK+YAE are the same,
  but the least significant bit of Y is always zero so all its values are even.
</p>

<figure>
  <figcaption>YJK to RGB</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>r</mi> <mo>=</mo> <mi>y</mi> <mo>+</mo> <mi>j</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>g</mi> <mo>=</mo> <mi>y</mi> <mo>+</mo> <mi>k</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>b</mi> <mo>=</mo>
        <mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>5</mn><mo>&#x2062;</mo><mi>y</mi> <mo>-</mo> <mn>2</mn><mo>&#x2062;</mo><mi>j</mi> <mo>-</mo> <mi>k</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>4</mn></mrow>
        </mfrac>
      </mrow>
    </math>
  </p>
</figure>

<figure>
  <figcaption>RGB to YJK</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>y</mi> <mo>=</mo>
        <mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>4</mn><mo>&#x2062;</mo><mi>b</mi> <mo>+</mo> <mn>2</mn><mo>&#x2062;</mo><mi>r</mi> <mo>+</mo> <mi>g</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>8</mn></mrow>
        </mfrac>
      </mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>j</mi> <mo>=</mo> <mi>r</mi> <mo>-</mo> <mi>y</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>k</mi> <mo>=</mo> <mi>g</mi> <mo>-</mo> <mi>y</mi></mrow>
    </math>
  </p>
</figure>

<p>
  Indeed those are fine formulas and perfect mathematical inverses of each other.
  However they do not take into account that the VDP both rounds and clips the
  result of the YJK to RGB conversion.
</p>


<h3 id="rounding">Rounding</h3>

<p>
  Let’s consider the rounding first. The y, j, k and r, g, b values are all
  integers, so when the blue value is calculated, it is rounded down to the
  nearest integer value (“floor”). To compensate for this in the RGB to YJK
  formula, you need to round up (“ceil”) the value resulting from the y.
</p>

<figure>
  <figcaption>YJK to RGB (rounded)</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>r</mi> <mo>=</mo> <mi>y</mi> <mo>+</mo> <mi>j</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>g</mi> <mo>=</mo> <mi>y</mi> <mo>+</mo> <mi>k</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>b</mi> <mo>=</mo> <mo>⌊</mo>
        <mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>5</mn><mo>&#x2062;</mo><mi>y</mi> <mo>-</mo> <mn>2</mn><mo>&#x2062;</mo><mi>j</mi> <mo>-</mo> <mi>k</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>4</mn></mrow>
        </mfrac> <mo>⌋</mo>
      </mrow>
    </math>
  </p>
</figure>

<figure>
  <figcaption>RGB to YJK (rounded)</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>y</mi> <mo>=</mo>
        <mo>⌈</mo><mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>4</mn><mo>&#x2062;</mo><mi>b</mi> <mo>+</mo> <mn>2</mn><mo>&#x2062;</mo><mi>r</mi> <mo>+</mo> <mi>g</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>8</mn></mrow>
        </mfrac><mo>⌉</mo>
      </mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>j</mi> <mo>=</mo> <mi>r</mi> <mo>-</mo> <mi>y</mi></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>k</mi> <mo>=</mo> <mi>g</mi> <mo>-</mo> <mi>y</mi></mrow>
    </math>
  </p>
</figure>

<figure>
  <figcaption>RGB to YJK+YAE (rounded)</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>y</mi> <mo>=</mo>
        <mn>2</mn><mo>&#x2062;</mo><mo>⌈</mo><mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>4</mn><mo>&#x2062;</mo><mi>b</mi> <mo>+</mo> <mn>2</mn><mo>&#x2062;</mo><mi>r</mi> <mo>+</mo> <mi>g</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>16</mn></mrow>
        </mfrac><mo>⌉</mo>
      </mrow>
    </math>
  </p>
</figure>

<p>
  Using these formula you can express exactly half of what 15-bit RGB allows;
  16384 out of 32768 colours (50%), and 8192 for YJK+YAE (25%). Each
  representable RGB value maps to one unique YJK value and vice versa. If you
  want to keep things simple, stop here and stick to these 16384 colours.
</p>


<h3 id="clipping">Clipping</h3>

<p>
  As we know though YJK mode can generate 19268 colours. Where did the remaining
  2884 colours go? YJK’s 17 bits allow for 131072 different values, but most of
  these fall outside the range of 15-bit RGB. This is called “out of gamut”.
  Values that are out of range are clipped to [0, 31].
</p>

<figure>
  <figcaption>YJK to RGB (clipped)</figcaption>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>r</mi> <mo>=</mo>
        <mi>clamp</mi><mo>&#x2061;</mo><mrow><mo>(</mo><mrow><mi>y</mi> <mo>+</mo> <mi>j</mi><mo>,</mo>
        <mn>0</mn><mo>,</mo> <mn>31</mn></mrow><mo>)</mo></mrow></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>g</mi> <mo>=</mo>
        <mi>clamp</mi><mo>&#x2061;</mo><mrow><mo>(</mo><mrow><mi>y</mi> <mo>+</mo> <mi>k</mi><mo>,</mo>
        <mn>0</mn><mo>,</mo> <mn>31</mn></mrow><mo>)</mo></mrow></mrow>
    </math>
  </p>
  <p>
    <math xmlns="http://www.w3.org/1998/Math/MathML">
      <mrow><mi>b</mi> <mo>=</mo>
        <mi>clamp</mi><mo>&#x2061;</mo><mrow><mo>(</mo><mrow><mo>⌊</mo>
        <mfrac>
          <mrow><mphantom mathsize="0"><mo>(</mo></mphantom><mn>5</mn><mo>&#x2062;</mo><mi>y</mi> <mo>-</mo> <mn>2</mn><mo>&#x2062;</mo><mi>j</mi> <mo>-</mo> <mi>k</mi><mphantom mathsize="0"><mo>)</mo></mphantom></mrow>
          <mrow><mphantom mathsize="0"><mo>/</mo></mphantom> <mn>4</mn></mrow>
        </mfrac> <mo>⌋</mo><mo>,</mo>
        <mn>0</mn><mo>,</mo> <mn>31</mn></mrow><mo>)</mo></mrow>
      </mrow>
    </math>
  </p>
</figure>

<p>
  As a side effect of this clipping, 2884 colours which could not be represented
  by the previous YJK formulas become available. For example, take the colour
  (0, 24, 31). Without clipping this could not be expressed, since applying the
  previous RGB to YJK to RGB formula will yield (0, 24, 32). Due to the clipping
  of the blue component though, this colour is available to us after all.
</p>

<p>
  If we calculate the number of colours affected by clipping, those which have
  one component of either 0 or 31, there are 32<sup>3</sup> - 30<sup>3</sup> = 5768
  of them. Half of them are already covered by unclipped colours, 5768 / 2 = 2884,
  meaning that all of the colours where any RGB component is 0 or 31 can be
  represented. Some of these have only one YJK representation, others up to 3463.
</p>

<p>
  You may notice no RGB to YJK formula is specified. This is because although
  colours whose components all fall within the [1, 30] range have a unique YJK
  representation which can be determined with the earlier formula, colours with
  one or more components of either 0 or 31 have multiple solutions.
</p>

<p>
  In order to deal with this, consider that an RGB value is a point in a
  3-dimensional (colour) space. For each potentially clipped component (0 or 31)
  a ray in the clip direction extends from the point, where two rays form a
  bounded plane, and three rays a volume. This colour space can be transformed
  to YJK with a matrix, and all YJK values overlapping this point, ray, plane
  or volume represent the same RGB colour.
</p>

<p>
  More on this in part 2, which will be a deep dive into the topic of image conversion.
</p>


<figure class="floatright">
  <a href="http://tomseditor.com/gallery/i/51671/house-by-windship"><img src="house.png" /></a>
  <figcaption>House by windship, rearranged by FRS (SC12)</figcaption>
</figure>

<figure class="floatright">
  <a href="http://tomseditor.com/gallery/i/40372/midnight-skyhigh-by"><img src="books.png" /></a>
  <figcaption title="おじいちゃんのほこりっぽい本が好き">I like grandpa’s dusty books by 京典, rearranged by FRS (SC12)</figcaption>
</figure>

<h2 id="drawing">Drawing techniques</h2>

<p>
  The YJK modes can be very nice for pixel art because of the wider range of colours
  that you an express with 15-bit RGB. Ever wanted that particular pastel colour
  that the V9938’s 9-bit RGB palette could not express? Or a smoother gradient?
  The V9958 can do in YJK. Additionally the high colour count allows you to
  create very colourful artwork.
</p>

<p>
  However on the flipside the colour restrictions of YJK make it a difficult mode
  to work with. Below you will find some tips on how to work with the constraints
  of the YJK modes.
</p>

<p>
  For pixel art I recommend to use the YJK+YAE mode. The availability of palette
  colours greatly increases your flexibility to work around the colour clash
  restrictions. The YJK mode is more suited for photographic material with
  smoother gradients and lower contrast.
</p>

<p>
  The simplest technique is to approach the art like you would a SCREEN 5 image.
  Draw the majority of the image using the 16 palette colours. Consider it a
  layer on top of the YJK layer. Then “punch holes” through this layer by
  introducing YJK colours in select places, adhering to the 4×1 pixel group
  restrictions. The easiest way to do this is by simply using only a single
  colour per pixel group. This already allows you to introduce many more colour
  details without needing extra palette colours for them, while avoiding the
  complexities of YJK.
</p>

<p>
  If you want to use multiple YJK colours within those 4 pixels, you need to pay
  attention to the colours available in the specific J, K combination for that
  quad. This requires a bit of planning, you’ll want to start by establishing a
  few useful colour ramps to reuse them througout the art piece. Choose colours
  from an Y ramp you like, for example using the tool at the top of this page,
  and then note them in a little scratch area for easy colour picking. Then
  whenever you need to draw e.g. some grassy bits, you can pick from the green
  ramp you’ve noted, while being mindful of the 4×1 grid.
</p>

<p>
  For a more cartoony drawing style in YJK mode, you could draw the artwork in
  grayscale, and then paint the colour on a separate colour modifier layer with
  a blurry brush, so that there are no hard colour transitions. This will convert
  to YJK well.
</p>

<p>
  Some additional tips:
</p>

<ul>
  <li>
    Align the vertical edges in your graphics to the 4×1 grid to minimise
    the effect of colour bleed.
  </li>
  <li>
    Use the out of gamut colours of the Y ramps to your advantage, their hue
    changes more than usual so they give some extra flexibility.
  </li>
  <li>
    In situations where you can’t use the colour you want, try to match its
    brightness so that the colour difference is harder to spot.
  </li>
  <li>
    The eye is sensitive to edges, so de-block visible edges of colour bleeding
    by adding detail or dithering in them.
  </li>
</ul>

<p>
  In the end to which degree you want to apply these techniques depends on how much
  time you want to invest. Please share your experiences and tips and tricks in the
  <a href="https://www.msx.org/forum/msx-talk/development/creating-pixel-art">msx.org
  pixel art thread</a>!
</p>


<h2 id="comparison">Comparison to Y′UV</h2>

<p>
  The YJK colour space is similar to the more common <a href="https://en.wikipedia.org/wiki/YUV">Y′UV</a>
  colour space, with 4×1 chroma subsampling like the Y′UV411 encoding. However
  they differ in the weights applied to the different colour components. Where
  Y′UV assigns weights to make the Y component express luma (brightness), YJK
  has swapped the weights for green and blue, meaning that Y does not only affect
  luma but also the amount of blue.
</p>

<p>
  This trait can be a bit unfortunate, as in natural scenes the amount of blue
  decreases under (sun)light, and increases in shade. Y′UV would work better
  in those situations. YJK is perhaps better suited for metallic, fluorescent
  and pastel colours.
</p>

<p>
  In an interesting article <a href="http://rs.gr8bit.ru/Documentation/Issues-on-YJK-colour-model-implemented-in-Yamaha-V9958-VDP-chip.pdf">“Issues
  on YJK colour model implemented in Yamaha V9958 VDP chip”</a>, Ricardo Cancho
  Niemietz elaborates why this is not ideal from the perspective of the
  luminance-chrominance colour model, and suggests that it must be an unintentional
  mistake of the Yamaha engineers. Assuming though that Yamaha’s engineers were
  smart people, and wouldn’t make a colour model inspired by YUV but deviate in
  such a detail without reason, let’s try to find that reason.
</p>

<p>
  In YJK’s 4-byte encoding there are six bits for J and K, but only five for Y.
  Due to this it can only represent half of the RGB colours, 2<sup>14</sup>
  instead of the 2<sup>15</sup> that 15-bit RGB can produce. Ideally Y would have
  6 bits as well to get the full range, but this doesn’t fit in the byte encoding
  (and certainly not in YJK+YAE). So which RGB colour component’s resolution do
  we reduce by one bit?
</p>

<p>
  The most logical answer here is blue, just like in SCREEN 8. Because our eyes
  are the least perceptive of blue, we won’t notice it as much. And indeed in YJK
  blue is effectively only 4-bit, in YJK+YAE effectively 3-bit. Had Yamaha
  gone for YUV, green would have gotten the least resolution, while it is the
  most visible colour, causing more banding in it. From this perspective, YJK
  spends its bits more effectively on the colours our eye perceive best.
</p>

<p>
  A final note on this; the Yamaha V9990 VDP has both an YJK and an YUV mode,
  so on that VDP you can use the mode of your choosing. The YUV mode works
  identical to YJK on the V9958 but with the weights for the G and B components
  swapped. The weights do not perfectly match the real Y’UV but it’s pretty close.
</p>

<p>Relevant links:</p>

<ul>
  <li><a href="/resources/video/yamaha_v9958.pdf">Yamaha V9958 application manual</a></li>
  <li><a href="https://www.msx.org/forum/msx-talk/software/enhanced-decoding-yjk-images">msx.org forum: Enhanced decoding of YJK images</a></li>
  <li><a href="https://www.msx.org/forum/msx-talk/development/creating-pixel-art">msx.org forum: Creating pixel art</a></li>
  <li><a href="http://rs.gr8bit.ru/Documentation/Issues-on-YJK-colour-model-implemented-in-Yamaha-V9958-VDP-chip.pdf">Issues on YJK colour model implemented in Yamaha V9958 VDP chip</a> by Ricardo Cancho Niemietz.</li>
  <li><a href="http://www.msx-plaza.eu/home.php?page=mccm/mccm72/schermen_eng">The MSX2+ Screens</a> by Alex Wulms (<a href="https://web.archive.org/web/20181001220537/http://www.msx-plaza.eu/home.php?page=mccm/mccm72/schermen_eng">mirror</a>), published in MCCM 72 (<a href="http://www.msxarchive.nl/pub/msx/mirrors/hanso/hwdoityourself/msxplus.pdf">original Dutch</a>).</li>
  <li><a href="http://tomseditor.com/gallery/browse?platform=msx&amp;format=screen10">Screen 10-11 art gallery</a> on Retro Gallery</li>
  <li><a href="http://tomseditor.com/gallery/browse?platform=msx&amp;format=screen12">Screen 12 art gallery</a> on Retro Gallery</li>
</ul>


<p class="signed">Grauw</p>

<?php addFooter(); ?>
</body>
</html>
