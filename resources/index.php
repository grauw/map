<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Resources - MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body id="msxasm">
<?php addHeader(); ?>



<h1>Resources</h1>

<p>This is our collection of online MSX resources. Some are authored, translated
or transcribed by the MAP maintainers, and can only be found here exclusively.
Therefore, please do not spread those without our permission, but link to the
MAP instead. If you have something not listed here which contains new
information, feel free to send us an email.</p>

<ul>
  <li id="msxbios">MSX BIOS documentation
    <ul>
    <li class="map"><a href="/resources/msxbios.php">MSX BIOS calls</a></li>
    <li class="map"><a href="/resources/subrom.php">MSX SUBROM BIOS calls</a></li>
    <li class="map"><a href="/resources/msxsystemvars.php">System variables</a> <em>(work in progress)</em></li>
    <li><a href="http://www.konamiman.com/msx/msx2th/th-ap.txt">MSX2 Technical Handbook appendices</a> · by Nestor Soriano (Konamiman)</li>
    </ul>
  </li>
  <li id="dos2">DOS2 documentation
    <ul>
    <li><a href="/resources/dos2info.lzh">ASCII MSX-DOS2 documentation</a>
      <ul>
      <li>MSX-DOS2 commands reference · not programming-related</li>
      <li><a href="/resources/dos2_environment.php">MSX-DOS2 environment reference</a></li>
      <li><a href="/resources/dos2_functioncalls.php">MSX-DOS2 function call reference</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="system">System documentation
    <ul>
    <li class="map"><a href="/resources/msx_io_ports.php">MSX I/O ports overview</a></li>
    <li><a href="http://www.konamiman.com/msx/msx-e.html#msx2th">MSX2 Technical Handbook</a> · by Nestor Soriano (Konamiman)</li>
    <li><a href="http://bifi.msxnet.org/msxnet/tech/megaroms">Megabit ROM Cartridges mapper types</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
    </ul>
  </li>
  <li id="processors">Processors
    <ul>
    <li class="map"><a href="/resources/cpu_comparison.php">Z80/R800/Z180/Z380 comparison</a></li>
    <li id="z80">Z80
      <ul>
	  <li class="map"><a href="/resources/z80instr.php">Z80 instruction set overview</a></li>
      <li><a href="/resources/cpu/z80.pdf">Zilog Z80 user’s manual</a></li>
      <li><a href="http://www.myquest.nl/z80undocumented/z80-documented.pdf">The Undocumented Z80 Documented</a> · by Sean Young, Jan Wilmans</li>
      <li><a href="http://www.z80.info/zaks.html">Programming the Z80</a> · by Rodnay Zaks</li>
      </ul>
    </li>
    <li id="z180">Z180
      <ul>
      <li><a href="/resources/cpu/z8018x.pdf">Zilog Z180 user’s manual</a></li>
      </ul>
    </li>
    <li id="z380">Z380
      <ul>
      <li><a href="/resources/cpu/z380.pdf">Zilog Z380 product specification</a></li>
      <li><a href="/resources/cpu/z380um.pdf">Zilog Z380 user’s manual</a></li>
      <li><a href="/resources/cpu/z380qa.pdf">Zilog Z380 questions and answers</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="video">Video Chips
    <ul>
    <li id="tms9918">MSX1 VDP
      <ul>
      <li><a href="/resources/video/texasinstruments_tms9918.pdf">Texas Instruments TMS9918A application manual</a></li>
      <li><a href="/resources/video/ti-vdp-programmers-guide.pdf">Texas Instruments VDP Programmer’s Guide</a></li>
      <li><a href="http://bifi.msxnet.org/msxnet/tech/tms9918a.txt">Sean Young’s TMS9918A documentation</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
      </ul>
    </li>
    <li id="v9938">MSX2 VDP
      <ul>
      <li><a href="http://www.ccas.ru/brychkov/MSX/V9938_programmers_guide.pdf">Yamaha V9938 Application Manual</a> · transscribed and edited by Eugeny Brychkov</li>
      <li class="map"><a href="/resources/video/v9938/v9938.xhtml">Yamaha V9938 Application Manual</a> · transscribed <em>(incomplete)</em></li>
      <li><a href="http://www.msxarchive.nl/pub/msx/docs/datasheets/v9938.pdf">Yamaha V9938 Application Manual</a> · scans</li>
      </ul>
    </li>
    <li id="v9958">MSX2+ / turboR VDP
      <ul>
      <li><a href="/resources/video/yamaha_v9958.pdf">Yamaha V9958 Application Manual</a> · scans</li>
      </ul>
    </li>
    <li id="v9990">Graphics9000
      <ul>
      <li><a href="/resources/video/yamaha_v9990.pdf">Yamaha V9990 application manual</a></li>
      <li><a href="http://msxbanzai.tni.nl/v9990/manual.html">Yamaha V9990 E-VDP-III Programmers Manual</a> · by MSX Banzai! (unofficial)</li>
      <li><a href="/resources/video/v9manual.pdf">Sunrise Video9000 application manual</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="sound">Sound Chips
    <ul>
    <li id="psg">PSG
      <ul>
      <li><a href="/resources/sound/generalinstrument_ay-3-8910.pdf">General Instrument AY-3-8910 application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2149.pdf">Yamaha YM2149 (SSG) application manual</a> (PSG clone)</li>
      </ul>
    </li>
    <li id="scc">Konami SCC
      <ul>
      <li><a href="http://www.msxnet.org/tech/scc">Sean Young’s msxnet.org SCC section</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
      <li><a href="http://www.msxnet.org/tech/soundcartridge">Sean Young’s msxnet.org SCC+ section</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
      </ul>
    </li>
    <li id="opll">MSX-Music / FM-PAC
      <ul>
      <li><a href="/resources/sound/yamaha_ym2413.pdf">Yamaha YM2413 (OPLL) application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2413_ds.pdf">Yamaha YM2413 (OPLL) datasheet</a></li>
      </ul>
    </li>
    <li id="opl1">MSX-Audio / Music Module
      <ul>
      <li><a href="/resources/sound/yamaha_y8950.pdf">Yamaha Y8950 (MSX-AUDIO) application manual</a></li>
      <li><a href="/resources/sound/yamaha_y8950_ds.pdf">Yamaha Y8950 (MSX-AUDIO) datasheet</a></li>
      <li><a href="/resources/sound/yamaha_ym3526.pdf">Yamaha YM3526 (OPL) datasheet</a></li>
      </ul>
    </li>
    <li id="opl4">MoonSound
      <ul>
      <li><a href="/resources/sound/yamaha_opl4.pdf">Yamaha YMF278B (OPL4) application manual</a></li>
      <li><a href="/resources/sound/yamaha_ymf278b.pdf">Yamaha YMF278B (OPL4) datasheet</a></li>
      <li><a href="/resources/sound/yamaha_yac513.pdf">Yamaha YAC513 2-Channel Floating D/A Converter datasheet</a></li>
      </ul>
    </li>
    <li id="opm">SFG-01 / SFG-05 (Yamaha CX5M’s FM sound unit)
      <ul>
      <li><a href="/resources/sound/yamaha_ym2151_synthesis.pdf">Yamaha YM2151 (OPM) application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2151_datasheet.pdf">Yamaha YM2151 (OPM) datasheet</a></li>
      <li><a href="http://www.cx5m.net/hardware/">More info at CX5M.net</a></li>
      </ul>
    </li>
    <li id="sn76489">Franky / PlaySoniq
      <ul>
      <li><a href="/resources/sound/texas_instruments_sn76489an.pdf">Texas Instruments SN76489 application manual</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="msxengine">MSX Engine
    <ul>
    <li><a href="/resources/engine/yamaha_s3527.pdf" hreflang="ja">Yamaha S3527 MSX-System application manual</a> (Japanese)</li>
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
    <li><a href="/resources/disk/westerndigital_wd279x02.pdf">Western Digital WD2793-02 FDC</a> · used in most MSX2’s</li>
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
    <li id="midi">MIDI
      <ul>
      <li class="map"><a href="/resources/midi/msx-midi.php">MSX-MIDI</a> · MSX Datapack Vol. 3 Section 5, English</li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="dd_other">Other
    <ul>
    <li id="ppi">PPI / i8255 / Programmable Peripheral Interface
      <ul>
      <li><a href="/resources/ppi/intel_82c55a.pdf">Intel 82C55A CHMOS PPI</a></li>
      <li><a href="/resources/ppi/chipsi8255.pdf">i8255 introduction</a></li>
      </ul>
    </li>
    <li id="rtc">RTC / MSX2 clock chip
      <ul>
      <li><a href="/resources/rtc/ricoh_rp5c01.pdf">Ricoh RP/RF5C01A application manual</a></li>
      </ul>
    </li>
    <li id="mapper">ROM / RAM memory
      <ul>
      <li class="map"><a href="/resources/msx_io_ports.php#zemina-memory">Zemina GoldenBox technical info</a></li>
      <li><a href="http://www.hqunix.com/wordpress/?page_id=554">Zemina GoldenBox manual</a> · by <a href="http://hqunix.com/wordpress/">Chronos</a></li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="software">Software documentation
    <ul>
    <li id="memman">MemMan (by MST)
      <ul>
      <li class="map"><a href="/resources/tsrdev_en.php">MemMan v2.32 TSR Development Kit</a></li>
      </ul>
    </li>
    </ul>
  </li>
</ul>





<?php addFooter(); ?>
</body>
</html>