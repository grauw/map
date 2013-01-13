<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX Assembly Page</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Calling the BIOS from MSX-DOS</h1>

<p>In the MSX-DOS environment there is no special entry for calling the MSX BIOS, however you can simply use an interslot call to reach it.</p>

<p>You can use this method to call the BIOS:</p>

<pre>CALSLT:      EQU    #001C
EXPTBL:      EQU    #FCC1

Call_Slot:   ld     iy,(EXPTBL-1)       ;BIOS slot in iyh
             ld     ix,nnnn             ;address of BIOS routine
             call   CALSLT              ;interslot call
</pre>

<h2>The SUBROM</h2>

<p>You can’t call the SUBROM from MSX-DOS as you would normally, the reason for this is that both <a href="/resources/msxbios.php#EXTROM">EXTROM</a> and <a href="/resources/msxbios.php#CALSLT">CALSLT</a> use the IX register to pass parameters. Calling directly to the SUBROM doesn’t work either, because using an interslot call to call the SUBROM is not allowed per the MSX2 standard. The reason for this, according to Alex Wulms in MCM 48, is that some DiskROMs couldn’t handle the the SUBROM being in page 0.</p>

<p>The official means to call the SUBROM from MSX-DOS is by using the following routine, provided by ASCII:</p>

<pre>; CALSUB
;
; In: IX = address of routine in MSX2 SUBROM
;     AF, HL, DE, BC = parameters for the routine
;
; Out: AF, HL, DE, BC = depending on the routine
;
; Changes: IX, IY, AF', BC', DE', HL'
;
; Call MSX2 subrom from MSXDOS. Should work with all versions of MSXDOS.
;
; Notice: NMI hook will be changed. This should pose no problem as NMI is
; not supported on the MSX at all.
;
CALSLT:  EQU    #001C
NMI:     EQU    #0066
EXTROM:  EQU    #015f
EXPTBL:  EQU    #fcc1
H_NMI:   EQU    #fdd6
;
CALSUB:  exx
         ex     af,af'       ; store all registers
         ld     hl,EXTROM
         push   hl
         ld     hl,#C300
         push   hl           ; push NOP ; JP EXTROM
         push   ix
         ld     hl,#21DD
         push   hl           ; push LD IX,&lt;entry&gt;
         ld     hl,#3333
         push   hl           ; push INC SP; INC SP
         ld     hl,0
         add    hl,sp        ; HL = offset of routine
         ld     a,#C3
         ld     (H_NMI),a
         ld     (H_NMI+1),hl ; JP &lt;routine&gt; in NMI hook
         ex     af,af'
         exx                 ; restore all registers
         ld     ix,NMI
         ld     iy,(EXPTBL-1)
         call   CALLSLT      ; call NMI-hook via NMI entry in ROMBIOS
                             ; NMI-hook will call SUBROM
         exx
         ex     af,af'       ; store all returned registers
         ld     hl,10
         add    hl,sp
         ld     sp,hl        ; remove routine from stack
         ex     af,af'
         exx                 ; restore all returned registers
         ret
</pre>

<p class="sig">~Grauw</p>


<?php addFooter(); ?>

</body>
</html>