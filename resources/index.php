<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Resources - MSX Assembly Page</title>
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
    <li><a href="/resources/datapack/Vol3-7MSXExtendedBIOSSpecification.pdf">MSX Extended BIOS Specification</a> · MSX Datapack Vol. 3-7, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
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
    <li><a href="/resources/system/msxtech.pdf">MSX Technical Data Book</a></li>
    <li><a href="http://www.konamiman.com/msx/msx-e.html#msx2th">MSX2 Technical Handbook</a> · by Nestor Soriano (Konamiman) (<a href="http://ngs.no.coocan.jp/doc/wiki.cgi/TechHan" hreflang="ja">Japanese version</a>, <a href="https://translate.google.nl/translate?sl=ja&amp;tl=en&amp;u=http%3A%2F%2Fngs.no.coocan.jp%2Fdoc%2Fwiki.cgi%2FTechHan">via Google Translate</a>)</li>
    <li><a href="https://translate.google.nl/translate?sl=ja&amp;tl=en&amp;u=http%3A%2F%2Fdai3car.sakura.ne.jp%2Fmsxpage%2Fmsxtr_handbook%2Flates.html">MSX turboR Technical Handbook via Google Translate</a> (<a href="http://dai3car.sakura.ne.jp/msxpage/msxtr_handbook/lates.html" hreflang="ja">Japanese</a>, <a href="https://archive.org/download/MsxTurboR/MsxTurboRTechnicalHandBook.pdf" hreflang="ja">scans</a>)</li>
    <li><a href="https://translate.google.nl/translate?sl=ja&amp;tl=en&amp;u=http%3A%2F%2Fngs.no.coocan.jp%2Fdoc%2Fwiki.cgi%2Fdatapack">MSX Datapack via Google Translate</a> (<a href="http://ngs.no.coocan.jp/doc/wiki.cgi/datapack" hreflang="ja">Japanese</a>, scans <a href="https://archive.org/download/MSXDatapackVolume1/MSX-Datapack_Volume1_1991.pdf" hreflang="ja">1</a>, <a href="https://archive.org/download/MSXDatapackVolume2/MSX-Datapack_Volume2_1991.pdf" hreflang="ja">2</a>, <a href="https://archive.org/download/MSXDatapackVolume3_turboR/MSX-Datapack_Volume3_1991.pdf" hreflang="ja">3</a>, <a href="/resources/datapack/msxdatapack-disks.zip">disks</a>)</li>
    <li><a href="http://bifi.msxnet.org/msxnet/tech/megaroms">Megabit ROM Cartridges mapper types</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
    </ul>
  </li>
  <li id="processors">Processors
    <ul>
    <li id="z80">Z80
      <ul>
	  <li class="map"><a href="/resources/z80instr.php">Z80 / R800 instruction set overview</a></li>
      <li><a href="/resources/cpu/z80.pdf">Zilog Z80 user’s manual</a></li>
      <li><a href="http://www.myquest.nl/z80undocumented/z80-documented-v0.91.pdf">The Undocumented Z80 Documented</a> · by Sean Young, Jan Wilmans (<a href="http://www.myquest.nl/z80undocumented/">site</a>)</li>
      <li><a href="http://www.z80.info/zaks.html">Programming the Z80</a> · by Rodnay Zaks</li>
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
      <li><a href="http://www.ccas.ru/brychkov/MSX/V9938_programmers_guide.pdf">Yamaha V9938 MSX-VIDEO Application Manual</a> · transscribed and edited by Eugeny Brychkov</li>
      <li><a href="/resources/video/yamaha_v9938.pdf">Yamaha V9938 MSX-VIDEO Application Manual</a> · scans (<a href="http://www.msxarchive.nl/pub/msx/docs/datasheets/v9938.pdf">alt version</a>)</li>
      <li class="map"><a href="/resources/video/v9938/v9938.xhtml">Yamaha V9938 MSX-VIDEO Application Manual</a> · transscribed <em>(incomplete)</em></li>
      </ul>
    </li>
    <li id="v9958">MSX2+ / turboR VDP
      <ul>
      <li><a href="/resources/video/yamaha_v9958.pdf">Yamaha V9958 MSX-VIDEO Application Manual</a> · scans</li>
      <li><a href="/resources/video/yamaha_v9958_ocr.pdf">Yamaha V9958 MSX-VIDEO Application Manual</a> · transscribed</li>
      </ul>
    </li>
    <li id="v9990">Graphics9000
      <ul>
      <li><a href="/resources/video/yamaha_v9990.pdf">Yamaha V9990 E-VDP-III application manual</a></li>
      <li><a href="/resources/video/yamaha_v9978.pdf">Yamaha V9978 E-VDP-III datasheet</a></li>
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
      <li><a href="/resources/sound/yamaha_ym2149.pdf">Yamaha YM2149 SSG application manual</a></li>
      </ul>
    </li>
    <li id="scc">Konami SCC
      <ul>
      <li><a href="http://bifi.msxnet.org/msxnet/tech/scc">Sean Young’s msxnet.org SCC section</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
      <li><a href="http://bifi.msxnet.org/msxnet/tech/soundcartridge">Sean Young’s msxnet.org SCC+ section</a> · on <a href="http://bifi.msxnet.org/msxnet/tech/">msxnet</a></li>
      </ul>
    </li>
    <li id="opll">MSX-Music / FM-PAC
      <ul>
      <li><a href="/resources/sound/yamaha_ym2413.pdf">Yamaha YM2413 OPLL application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2413_frs.pdf">Yamaha YM2413 OPLL application manual with SFG-05 filter</a> · cleanup and improvement by FRS (<a href="http://frs.badcoffee.info/hardware/MSXfixes.html">more info</a>)</li>
      <li><a href="/resources/sound/yamaha_ym2413_ds.pdf">Yamaha YM2413 OPLL datasheet</a> (<a href="/resources/sound/yamaha_ym2413b_ds.pdf">YM2413B</a>)</li>
      <li><a href="/resources/datapack/Vol2-3.1MSX-MUSICHardware.pdf">MSX-MUSIC Hardware</a> · MSX Datapack Vol. 2-3.1, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li><a href="/resources/datapack/Vol2-3.2MSX-MUSICExtendedBASIC.pdf">MSX-MUSIC Extended BASIC</a> · MSX Datapack Vol. 2-3.2, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li><a href="/resources/datapack/Vol2-3.3FMBIOS.pdf">FM BIOS</a> · MSX Datapack Vol. 2-3.3, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      </ul>
    </li>
    <li id="opl1">MSX-Audio / Music Module
      <ul>
      <li><a href="/resources/sound/yamaha_y8950.pdf">Yamaha Y8950 MSX-AUDIO application manual</a></li>
      <li><a href="/resources/sound/yamaha_y8950_ds.pdf">Yamaha Y8950 MSX-AUDIO datasheet</a></li>
      <li><a href="/resources/sound/yamaha_y8950_test.txt">Yamaha Y8950 MSX-AUDIO test register info</a></li>
      <li><a href="/resources/sound/yamaha_ym3526.pdf">Yamaha YM3526 OPL datasheet</a></li>
      <li><a href="/resources/datapack/Vol2-4.1MSX-AUDIOHardware.pdf">MSX-AUDIO Hardware</a> · MSX Datapack Vol. 2-4.1, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li><a href="/resources/datapack/Vol2-4.2MSX-AUDIOBASICExpansion.pdf">MSX-AUDIO BASIC Expansion</a> · MSX Datapack Vol. 2-4.2, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li><a href="/resources/datapack/Vol2-4.3MSX-AUDIOExtendedBIOS.pdf">MSX-AUDIO Extended BIOS</a> · MSX Datapack Vol. 2-4.3, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li><a href="/resources/datapack/Vol2-4.4MSX-AUDIOMBIOS.pdf">MSX-AUDIO MBIOS</a> · MSX Datapack Vol. 2-4.4, by FRS, Takamichi &amp; sandervn (<a href="/resources/datapack/MSXDatapackTranslationREADME.pdf">credits</a>)</li>
      <li class="map"><a href="/resources/sound/msxaudio_keyboard.php">MSX-AUDIO music keyboard</a></li>
      </ul>
    </li>
    <li id="opl2">OPL2
      <ul>
      <li><a href="/resources/sound/yamaha_ym3812_ds.pdf">Yamaha YM3812 OPL2 datasheet</a></li>
      </ul>
    </li>
    <li id="opl3">OPL3
      <ul>
      <li><a href="/resources/sound/yamaha_ymf262.pdf">Yamaha YMF262 OPL3 application manual</a></li>
      <li><a href="/resources/sound/yamaha_ymf289b.pdf">Yamaha YMF289B OPL3-L application manual</a></li>
      </ul>
    </li>
    <li id="opl4">MoonSound
      <ul>
      <li><a href="/resources/sound/yamaha_opl4.pdf">Yamaha YMF278B OPL4 application manual</a></li>
      <li><a href="/resources/sound/yamaha_ymf278b.pdf">Yamaha YMF278B OPL4 datasheet</a></li>
      <li><a href="/resources/sound/yamaha_yac513.pdf">Yamaha YAC513 2-Channel Floating D/A Converter datasheet</a></li>
      </ul>
    </li>
    <li id="opm">FM Sound Synthesizer Unit (SFG-01 / SFG-05)
      <ul>
      <li><a href="/resources/sound/yamaha_ym2151_synthesis.pdf">Yamaha YM2151 OPM application manual</a></li>
      <li><a href="/resources/sound/yamaha_ym2151_datasheet.pdf">Yamaha YM2151 OPM datasheet</a></li>
      <li><a href="/resources/sound/yamaha_ym2151_test.txt">Yamaha YM2151 OPM test register info</a> · by Jarek Burczynski</li>
      <li class="map"><a href="/resources/sound/yamaha_ym2164.php">Yamaha YM2164 OPP info</a></li>
      <li><a href="/resources/sound/yamaha_sfg05_mbios.pdf">Yamaha SFG-05 Music BIOS reference manual</a></li>
      <li><a href="http://www.cx5m.net/hardware/">More info at CX5M.net</a></li>
      </ul>
    </li>
    <li id="sn76489">Franky / PlaySoniq / MMM
      <ul>
      <li><a href="/resources/sound/texas_instruments_sn76489an.pdf">Texas Instruments SN76489 application manual</a></li>
      <li><a href="/resources/sound/franky-9.pdf">Franky user manual</a> (<a href="http://supersoniqs.com/documentation/">website</a>)</li>
      <li><a href="/resources/sound/playsoniq-user-manual-v1-3.pdf">PlaySoniq user manual</a> (<a href="http://supersoniqs.com/documentation/">website</a>)</li>
      <li><a href="/resources/sound/musical-memory-mapper.pdf">Musical Memory Mapper application manual</a> (<a href="http://www.ebsoft.fr/shop/en/home/35-musical-memory-mapper.html">website</a>)</li>
      </ul>
    </li>
    <li id="mp3player">Sunrise MP3 Player
      <ul>
      <li><a href="/resources/sound/mp3player.pdf">Sunrise MP3 Player application manual</a> (<a href="/resources/sound/mp3player.doc">doc</a>)</li>
      </ul>
    </li>
    </ul>
  </li>
  <li id="msxengine">MSX Engine
    <ul>
    <li><a href="/resources/engine/yamaha_s3527_en.pdf">Yamaha S3527 MSX-System application manual</a>
        (<a href="/resources/engine/yamaha_s3527.pdf" hreflang="ja">Japanese version</a>)</li>
    <li><a href="/resources/engine/yamaha_s1985.pdf">Yamaha S1985 MSX-System II application manual</a></li>
    <li>T9769B · engine of several MSX2+ computers</li>
	  <ul>
	  <li class="map"><a href="/resources/engine/t9769b/">T9769B general notes</a></li>
	  </ul>
    <li>T9769C · turboR engine</li>
    <li>S1990 · turboR bus controller</li>
    </ul>
  </li>
  <li id="diskcontrollers">Disk controllers
    <ul>
    <li><a href="/resources/disk/westerndigital_wd279x02.pdf">Western Digital WD2793-02 FDC</a> · used in most MSX2’s</li>
    <li><a href="/resources/disk/toshiba_tc8566af.pdf">Toshiba TC8566AF FDC</a> · used in Panasonic MSX computers</li>
    <li><a href="/resources/disk/mitsubishi_m5w1793-02p.pdf">Mitsubishi M5W1793-02P</a> · used in Yamaha FD-051, SVI</li>
    <li><a href="/resources/disk/fujitsu_mb8876a.pdf">Fujitsu MB8877A</a> · used in Sanyo MFD-001, Victor HC90-HC95, National, compatible with 1793-02</li>
    <li><a href="/resources/disk/fdd-controllers.jpg">Floppy disk controllers overview</a> · by Marcos Daniel Blanco</li>
    <li><a href="/resources/disk/IDETECH.TXT">Sunrise IDE interface technical information</a></li>
    <li><a href="/resources/disk/IDESYS.TXT">Sunrise IDE interface technical system documentation</a></li>
    <li><a href="/resources/disk/novaxis-scsi.pdf">Novaxis SCSI interface manual</a></li>
    </ul>
  </li>
  <li id="communication">Communication
    <ul>
    <li id="rs232">RS232
      <ul>
      <li><a href="/resources/serial/philips_nms1210.pdf">Philips NMS1210/1211/1212 RS232 Serial Interface user guide</a></li>
      </ul>
    </li>
    <li id="ethernet">Ethernet
      <ul>
      <li><a id="gr8net" href="http://rs.gr8bit.ru/Documentation/GR8NET-manual.pdf">GR8NET Ethernet Interface</a></li>
      </ul>
    </li>
    <li id="joynet">JoyNet
      <ul>
      <li><a href="/resources/joynet/">JoyNet standard documentation</a></li>
      </ul>
    </li>
    <li id="midi">MIDI
      <ul>
      <li class="map"><a href="/resources/midi/msx-midi.php">MSX-MIDI</a> · MSX Datapack Vol. 3 Section 5, English</li>
      <li><a href="/resources/midi/intel_8251.pdf">Intel 8251 UART</a> · used by MSX-MIDI</li>
      <li><a href="/resources/midi/intel_8253.pdf">Intel 8253 Timer</a> · used by MSX-MIDI</li>
      <li><a href="/resources/midi/motorola_mc68b50.pdf">Motorola MC68B50</a> · used by Philips Music Module</li>
      <li class="map"><a href="/resources/midi/ym2148.php">Yamaha YM2148</a> · FM Sound Synthesizer Unit MIDI interface</li>
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
      <li class="map"><a href="/resources/hbi55.php">Sony HBI-55 Data Cartridge / Yamaha UDC-01 Data Memory</a> (4kB SRAM)</li>
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