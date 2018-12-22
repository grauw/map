<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Sources - MSX Assembly Page</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>(Source) code depository</h1>

<p>This is the MAP’s source code depository. It is divided in two main sections: <a href="#code">Code examples</a>, which contains several examples of how to code stuff, usually with an explaining text. And secondly, the <a href="#source">Source code</a> section, which contains sources from entire programs, some very well known. If you discover any errors or know a better/faster way to handle things shown in our code examples, please mail us about it.</p>

<ul>
<li id="code">Code examples
  <ul>
  <li id="code_vdp">VDP routines
    <ul>
    <li><a href="/sources/docopy.php">Execute a VDP command</a> <span class="map">MAP</span></li>
    <li><a href="/sources/vdp_detection.php">Detect VDP version</a> <span class="map">MAP</span></li>
    <li><a href="/sources/vdp_rout.php">A shitload of VDP routines</a> <span class="map">MAP</span></li>
    </ul>
  </li>
  <li id="code_disk">Disk routines
    <ul>
    <li><a href="/sources/load_screen.php">Load a file into the VRAM</a> <span class="map">MAP</span></li>
    </ul>
  </li>
  <li id="code_math">Math routines
    <ul>
    <li><a href="/articles/mult_div_shifts.php#mult">Multiplications</a> <span class="map">MAP</span></li>
    <li><a href="/articles/mult_div_shifts.php#div">Divisions</a> <span class="map">MAP</span></li>
    </ul>
  </li>
  <li id="code_slot">Slot/mapper routines
    <ul>
    <li><a href="/sources/raminpage1.php">Switch RAM/ROM in page 1</a> <span class="map">MAP</span></li>
    <li><a href="/sources/callbios.php">Calling the BIOS from MSX-DOS</a> <span class="map">MAP</span></li>
    </ul>
  </li>
  </ul>
</li>
<li id="extsources">External sources (non-MAP)
  <ul>
  <li id="ext_other">Misc
    <ul>
    <li><a href="http://baze.au.com/misc/z80bits.html">Z80 Bits</a> · collection of Z80 routines (<a href="/sources/external/z80bits.html">mirror</a>)</li>
    </ul>
  </li>
  </ul>
</li>
<li id="source">Source code
  <ul>
  <li><a href="http://www.msxarchive.nl/pub/msx/programming/asm/sources/">Funet source code repository</a></li>
  <li><a href="http://www.msxarchive.nl/pub/msx/mirrors/msx2.com/sources/">Funet msx2.com mirror source repository</a></li>
  <li><a href="https://bitbucket.org/konamiman/msx/overview">Konamiman's MSX software repository</a> · NestorBasic and more</li>
  </ul>
</li>
</ul>




<?php addFooter(); ?>
</body>
</html>