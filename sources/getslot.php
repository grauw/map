<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>GETSLT: Get slot ID of any page</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>GETSLT: Get slot ID of any page</h1>

<p>The BIOS slot routines
<a href="http://map.grauw.nl/resources/msxbios.php#RDSLT">RDSLT</a>,
<a href="http://map.grauw.nl/resources/msxbios.php#ENASLT">ENASLT</a>, etc. all
take a slot ID. Sometimes you construct this yourself, but often you need to
know the slot ID of a page that was already selected before. The initialisation
code of ROM cartridges for example typically wants to enable the slot of page 1
in page 2 as well.</p>

<p>You can determine the slot ID of a currently paged address with a GETSLT
routine. There is no BIOS routine for this, but the process is described in the
<a href="https://konamiman.github.io/MSX2-Technical-Handbook/md/Chapter5b.html#list-513--example-of-allocating-the-work-area">MSX2 Technical Handbook</a>
and several other references, along with code examples.</p>

<p>This is an assembly implementation which works for all pages (followed by
an <a href="#explanation">explanation</a>):</p>

<pre>RSLREG: equ 138H
EXPTBL: equ 0FCC1H
SLTTBL: equ 0FCC5H

; h = memory address high byte (bits 6-7: page)
; a &lt;- slot ID formatted FxxxSSPP
; Modifies: f, bc, de
Memory_GetSlot:
    call RSLREG
    bit 7,h
    jr z,PrimaryShiftContinue
    rrca
    rrca
    rrca
    rrca
PrimaryShiftContinue:
    bit 6,h
    jr z,PrimaryShiftDone
    rrca
    rrca
PrimaryShiftDone:
    and 00000011B
    ld c,a
    ld b,0
    ex de,hl
    ld hl,EXPTBL
    add hl,bc
    ex de,hl
    ld a,(de)
    and 80H
    or c
    ret p
    ld c,a
    inc de  ; move to SLTTBL
    inc de
    inc de
    inc de
    ld a,(de)
    bit 7,h
    jr z,SecondaryShiftContinue
    rrca
    rrca
    rrca
    rrca
SecondaryShiftContinue:
    bit 6,h
    jr nz,SecondaryShiftDone
    rlca
    rlca
SecondaryShiftDone:
    and 00001100B
    or c
    ret
</pre>

<h2 id="explanation">Explanation</h2>

<p>The MSX slot selection system divides the 64K CPU memory address space into
4 pages, from page 0 (0000H-3FFFH) to page 3 (C000H-FFFFH). In each of these
pages you can select a different slot. Some of these slots are internal, others
are for the external cartridge slots. The BIOS routines idenfity a slot with a
slot ID, using the bit-format <code>FxxxSSPP</code>. The two P bits indicate the
primary slot, the F bit indicates whether the primary slot is expanded, and if
so the S bits indicate the secondary slot.</p>

<pre>; h = memory address high byte (bits 6-7: page)
; a &lt;- slot ID formatted FxxxSSPP
; Modifies: f, bc, de
Memory_GetSlot:
    call RSLREG
    bit 7,h
    jr z,PrimaryShiftContinue
    rrca
    rrca
    rrca
    rrca
PrimaryShiftContinue:
    bit 6,h
    jr z,PrimaryShiftDone
    rrca
    rrca
PrimaryShiftDone:
    and 00000011B
</pre>

<p>This first part determines the value for the primary slot number (<code>PP</code> bits)
by reading the <a href="http://map.grauw.nl/resources/msx_io_ports.php#ppi">primary slot register</a>
through the <a href="http://map.grauw.nl/resources/msxbios.php#RSLREG">RSLREG</a>
BIOS routine. The returned byte has two bits to indicate the primary slot for
each of the pages, in the bit-format <code>33221100</code>. Because the slot ID
specifies the primary slot number (<code>PP</code>) in bits 0-1, we shift
until the appropriate bits are in the correct position.</p>

<p>Note that if you need a shorter version hardcoded for a specific page, you
can eliminate the conditional code here.</p>

<pre>    ld c,a
    ld b,0
    ex de,hl
    ld hl,EXPTBL
    add hl,bc
    ex de,hl
    ld a,(de)
    and 80H
    or c
    ret p
</pre>

<p>In this second part we determine the value for the expanded flag (<code>F</code> bit)
by inspecting the <a href="http://map.grauw.nl/resources/msxsystemvars.php#EXPTBL">EXPTBL</a>
table in system memory. This table consists of 4 bytes, one for each slot, where
bit 7 indicates whether the slot is expanded. Because in rare cases bits 0-6 can
contain a non-zero value, we <code>and</code> the value with 80H to mask out the
unwanted bits before we insert it into the slot ID. If the slot is not expanded,
we stop here.</p>

<pre>    ld c,a
    inc de  ; move to SLTTBL
    inc de
    inc de
    inc de
    ld a,(de)
    bit 7,h
    jr z,SecondaryShiftContinue
    rrca
    rrca
    rrca
    rrca
SecondaryShiftContinue:
    bit 6,h
    jr nz,SecondaryShiftDone
    rlca
    rlca
SecondaryShiftDone:
    and 00001100B
    or c
    ret
</pre>

<p>Lastly we determine the value for the secondary slot number (<code>SS</code> bits).
Instead of reading from the secondary slot registers directly, which is a
rather complicated affair, we advance the pointer to the
<a href="http://map.grauw.nl/resources/msxsystemvars.php#SLTTBL">SLTTBL</a>
table, which is a mirror of the four secondary slot registers. These have two
bits to indicate the secondary slot for each memory page, in the same
bit-format <code>33221100</code> as the primary slot register. Because the slot
ID specifies the secondary slot number (<code>SS</code>) in bits 2-3, we shift
until the appropriate bits are in the correct position.</p>

<p>Again note that if you need a shorter version hardcoded for a specific page,
you can eliminate the conditional code here.</p>

<p>Now we have fully determined the slot ID for a page.</p>

<p class="signed">Grauw</p>

<?php addFooter(); ?>
</body>
</html>
