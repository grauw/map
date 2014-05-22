<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Detecting VDP version</title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>Detecting VDP version</h1>

<p>Here’s a routine to help you detect the VDP version.</p>

<pre>;
; Detect VDP version
;
; a &lt;- 0: TMS9918A, 1: V9938, 2: V9958, x: VDP ID
;
VDP_GetVersion:
    call VDP_IsTMS9918A  ; use a different way to detect TMS9918A
    ret z
    ld a,1               ; select s#1
    di
    out (99H),a
    ld a,15 + 128
    out (99H),a
    nop
    nop
    in a,(99H)           ; read s#1
    and 00111110B        ; get VDP ID
    rrca
    ex af,af'
    xor a                ; select s#0 as required by BIOS
    out (99H),a
    ld a,15 + 128
    ei
    out (99H),a
    ex af,af'
    ret nz               ; return VDP ID for V9958 or higher
    inc a                ; return 1 for V9938
    ret
</pre>

<p>The TMS9918A has no VDP ID, so we use a different way to detect it…</p>

<pre>;
; Test if the VDP is a TMS9918A.
;
; The VDP ID number was only introduced in the V9938, so we have to use a
; different method to detect the TMS9918A. We wait for the vertical blanking
; interrupt flag, and then quickly read status register 2 and expect bit 6
; (VR, vertical retrace flag) to be set as well. The TMS9918A has only one
; status register, so bit 6 (5S, 5th sprite flag) will return 0 in stead.
;
; f &lt;- z: TMS9918A, nz: V99X8
;
VDP_IsTMS9918A:
    di
    in a,(99H)           ; read s#0
    and a
    jp p,VDP_IsTMS9918A  ; wait until interrupt flag is set
    ld a,2               ; select s#2 on V9938
    out (99H),a
    ld a,15 + 128
    out (99H),a
    nop
    nop
    in a,(99H)           ; read s#2 / s#0
    ex af,af'
    xor a                ; select s#0 as required by BIOS
    out (99H),a
    ld a,15 + 128
    ei
    out (99H),a
    ex af,af'
    and 01000000B        ; check if bit 6 was 0 (s#0 5S) or 1 (s#2 VR)
    ret
</pre>




<?php addFooter(); ?>
</body>
</html>