<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page - Resources</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>Resources</h1>

<p>This is our collection of online MSX resources. Some are authored, translated or transcribed by the MAP maintainers, and can only be found here exclusively. Therefore, please do not spread those without our permission, but link to the MAP instead. If you have something not listed here which contains new information, feel free to send us an email.</p>

<ul>
<li id="osdocs">OS documentation
  <ul>
  <li id="msxbios">MSX BIOS documentation
    <ul>
    <li class="map"><a href="/resources/msxbios.php">MSX BIOS calls</a></li>
    <li class="map"><a href="/resources/subrom.php">MSX SUBROM BIOS calls</a></li>
    <li class="map"><a href="/resources/msxsystemvars.php">System variables</a> <em>(work in progress)</em></li>
    </ul>
  </li>
  <li id="dos2">DOS2 documentation
    <ul>
    <li><a href="/resources/dos2info.lzh">ASCII MSX-DOS2 documentation</a>
      <ul>
      <li>MSX-DOS2 commands reference · (not programming-related)</li>
      <li><a href="/resources/dos2_environment.php">MSX-DOS2 environment reference</a></li>
      <li><a href="/resources/dos2_functioncalls.php">MSX-DOS2 function call reference</a></li>
      </ul>
    </li>
    </ul>
  </li>
  </ul>
</li>
<li id="devicedocs">Device documentation
  <ul>
  <li id="dd_general">General
    <ul>
    <li class="map"><a href="/resources/msx_io_ports.php">MSX I/O ports overview</a> <em>(work in progress)</em></li>
    </ul>
  </li>
  <li id="processors">Processors
    <ul>
    <li class="map"><a href="/resources/cpu_comparison.php">Z80/R800/Z180/Z380 comparison</a></li>
    <li id="z80">Z80
      <ul>
	  <li class="map"><a href="/resources/z80instr.php">Z80 instruction set overview</a></li>
      <li><a href="http://www.zilog.com/docs/z80/um0080.pdf">ZiLOG Z80 user's manual</a></li>
      <li><a href="http://www.myquest.nl/z80undocumented/z80-documented.pdf">The Undocumented Z80 Documented</a> · by Sean Young (now maintained by Jan Wilmans)</li>
      <li><a href="http://www.msxarchive.nl/pub/msx/mirrors/msx2.com/zaks/index-nf.htm">Programming the Z80</a> · by Rodnay Zaks (book, partially)</li>
      </ul>
    </li>
    <li id="z180">Z180
      <ul>
      <li><a href="http://www.zilog.com/docs/z180/um0050.pdf">ZiLOG Z180 user's manual</a></li>
      </ul>
    </li>
    <li id="z380">Z380
      <ul>
      <li><a href="http://www.zilog.com/docs/z380/z380.pdf">ZiLOG Z380 product specification</a></li>
      <li><a href="http://www.zilog.com/docs/z380/z380um.pdf">ZiLOG Z380 user's manual</a></li>
      <li><a href="http://www.zilog.com/docs/z380/z380qa.pdf">ZiLOG Z380 questions and answers</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="video">Video Chips
    <ul>
    <li id="tms9918">TMS9918A / TMS9928A / MSX1 VDP
      <ul>
      <li><a href="/resources/video/texasinstruments_tms9918.pdf">Texas Instruments TMS9918A application manual</a></li>
      </ul>
    </li>
    <li id="v9938">v9938 / MSX2 VDP
      <ul>
      <li class="map"><a href="/resources/video/v9938.xhtml">Yamaha v9938 Application Manual</a> · transscribed <em>(work in progress)</em></li>
      <li><a href="http://www.msxarchive.nl/pub/msx/docs/datasheets/v9938.pdf">Yamaha v9938 Application Manual</a></li>
      </ul>
    </li>
    <li id="v9958">v9958 / MSX2+ / turboR VDP
      <ul>
      <li class="map">Yamaha v9958 Application Manual · transscribed <em>(work in progress)</em></li>
      <li><a href="/resources/video/yamaha_v9958.pdf">Yamaha v9958 Application Manual</a></li>
      </ul>
    </li>
    <li id="v9990">v9990 / Graphics9000 (by Sunrise)
      <ul>
      <li><a href="/resources/video/yamaha_v9990.pdf">Yamaha v9990 application manual</a></li>
      <li><a href="http://msxbanzai.tni.nl/v9990/manual.html">Yamaha V9990 E-VDP-III Programmers Manual</a> · by MSX Banzai! (unofficial)</li>
      <li><a href="/resources/video/v9manual.pdf">Sunrise Video9000 application manual</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="soundchips">Sound Chips
    <ul>
    <li id="psg">AY3-8910 / PSG (MSX standard)
      <ul>
      <li><a href="/resources/sound/generalinstrument_ay-3-8910.pdf">General Instrument AY-3-8910 application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2149.pdf">Yamaha YM2149 (SSG)</a> (PSG clone)</li>
      </ul>
    </li>
    <li id="scc">SCC (custom sound chip by Konami)
      <ul>
      <li><a href="http://www.msxnet.org/tech/scc">Sean Young's msxnet.org SCC section</a></li>
      <li><a href="http://www.msxnet.org/tech/soundcartridge">Sean Young's msxnet.org SCC+ section</a></li>
      </ul>
    </li>
    <li id="opll">OPLL / MSX-Music / FM-PAC (MSX turboR standard)
      <ul>
      <li><a href="http://www.smspower.org/maxim/forumstuff/ym2413am/">Yamaha YM2413 (OPLL) application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2413.pdf">Yamaha YM2413 (OPLL) application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2413_ds.pdf">Yamaha YM2413 (OPLL) datasheet</a></li>
      <li>Yamaha YM2413B (OPLL) datasheet</li>
      </ul>
    </li>
    <li id="opl1">OPL1 / MSX-Audio / Music Module
      <ul>
      <li><a href="/resources/sound/yamaha_y8950.pdf">Yamaha Y8950 (MSX-AUDIO) application manual</a></li>
      <li><a href="/resources/sound/yamaha_y8950_ds.pdf">Yamaha Y8950 (MSX-AUDIO) datasheet</a></li>
      </ul>
    </li>
    <li id="opl4">OPL4 / MoonSound (by Sunrise)
      <ul>
      <li><a href="/resources/sound/yamaha_opl4.pdf">Yamaha OPL4 application manual</a></li>
      <li><a href="/resources/sound/yamaha_ymf278b.pdf">Yamaha OPL4 datasheet</a></li>
      <li><a href="/resources/sound/yamaha_yac513.pdf">Yamaha YAC513 2-Channel Floating D/A Converter datasheet</a></li>
      </ul>
    </li>
    <li id="dd_snd_other">Other
      <ul>
      <li>SiMPL / Covox · printer port DAC</li>
      <li>Key click</li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="msxengine">MSX Engine
    <ul>
    <li><a href="/resources/engine/yamaha_s3527.pdf">Yamaha S3527 MSX-System application manual</a> (Japanese)</li>
    <li><a href="/resources/engine/yamaha_s1985.pdf">Yamaha S1985 MSX-System II application manual</a></li>
    <li>T9769B · engine of several MSX2+ computers</li>
	  <ul>
	  <li class="map"><a href="/resources/engine/t9769b/">T9769B general notes</a></li>
	  </ul>
    <li>T9769C · turboR engine</li>
    <li>S1990 · turboR bus controller</li>
    </ul>
  </li>
  <li id="diskctl">Disk controllers
    <ul>
    <li><a href="/resources/disk/westerndigital_wd279x02.pdf">Western Digital WD2793-02 FDC</a> · used in most MSX2's</li>
    <li><a href="/resources/disk/toshiba_tc8566af.pdf">Toshiba TC8566AF FDC</a>  · used in Panasonic MSX computers</li>
    <li><a href="/viewer.php?f=/resources/disk/IDETECH.TXT">Sunrise IDE interface technical information</a> · 17/11/1998 version <i>(<a href="/resources/disk/IDETECH.TXT">plain text</a>)</i></li>
    <li><a href="/viewer.php?f=/resources/disk/IDESYS.TXT">Sunrise IDE interface technical system documentation</a> · 26/07/2000 version <i>(<a href="/resources/disk/IDESYS.TXT">plain text</a>)</i></li>
    <li><a href="/resources/disk/novaxis-scsi.pdf">Novaxis SCSI interface manual</a></li>
    </ul>
  </li>
  <li id="communication">Communication
    <ul>
    <li id="rs232">RS232</li>
    <li id="joynet">JoyNet
      <ul>
      <li><a href="/resources/joynet/">JoyNet standard documentation</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="dd_other">Other
    <ul>
    <li id="ppi">PPI / i8255 / Programmable Peripheral Interface
      <ul>
      <li>Note: doesn't seem to apply to MSX directly. Will write a better doc someday.</li>
      <li><a href="/resources/ppi/intel_82c55a.pdf">Intel 82C55A CHMOS PPI</a></li>
      <li><a href="/resources/ppi/chipsi8255.pdf">i8255 introduction</a></li>
      </ul>
    </li>
    <li id="rtc">RTC / MSX2 Clock Chip
      <ul>
      <li><a href="/resources/rtc/ricoh_rp5c01.pdf">Ricoh RP/RF5C01A application manual</a></li>
      </ul>
    </li>
    </ul>
  </li>
  </ul>
</li>
<li id="swdocs">Software documentation
  <ul>
  <li id="assemblers">Assemblers</li>
  <li id="compilers">Compilers</li>
  <li id="swd_other">Other Software
    <ul>
    <li id="memman">MemMan (by MST)
      <ul>
      <li class="map"><a href="/resources/tsrdev_en.php">MemMan v2.32 TSR Development Kit</a> <em>(work in progress)</em></li>
      </ul>
    </li>
    </ul>
  </li>
  </ul>
</li>
</ul>





<?php addFooter(); ?>
</body>
</html>