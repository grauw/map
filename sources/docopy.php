<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>DoCopy</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>DoCopy</h1>

<p>The first time I wrote a routine to send a command to the VDP, it was the
routine DoCopy by Stefan Boer, published in Sunrise Special. Later on, as my
programming skills improved I step by step improved the routine. Now, this is
pretty much the end result, as fast as I could think of. Well actually, when I
really want to do a lot of copies I usually use an even faster variant, with a
faster response time. More about that after the first DoCopy routine.</p>

<pre>;
; Execute a VDP command
; In:  HL = pointer to 15-byte VDP command data
; Out: HL = updated
;
VDP_DoCopy:
    ld a,32
    di
    out (#99),a
    ld a,17 + 128
    out (#99),a
    ld c,#9B
VDP_DoCopy_Ready:
    ld a,2
    di
    out (#99),a     ; select s#2
    ld a,15 + 128
    out (#99),a
    in a,(#99)
    rra
    ld a,0          ; back to s#0, enable ints
    out (#99),a
    ld a,15 + 128
    ei
    out (#99),a     ; loop if vdp not ready (CE)
    jp c,VDP_DoCopy_Ready
    outi            ; 15x OUTI
    outi            ; (faster than OTIR)
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    ret
</pre>

<p>I sometimes find this useful too, a separate routine to wait for the VDP to
finish its current command.</p>

<pre>;
; Wait until the VDP is ready for a new command.
;
VDP_Ready:
    ld a,2
    di
    out (#99),a     ; select s#2
    ld a,15 + 128
    out (#99),a
    in a,(#99)
    rra
    ld a,0          ; back to s#0, enable ints
    out (#99),a
    ld a,15 + 128
    ei
    out (#99),a     ; loop if vdp not ready (CE)
    jp c,VDP_Ready
    ret
</pre>


<p>And now the faster variant of this routine. This one doesn’t switch between
status register 0 and status register 2 anymore, which greatly improves the
response time. Very useful when you need to execute lots of VDP commands
consecutively. Cas Cremer’s Core Dump Work In Progress articles gave me the
idea. Because it does not switch status registers anymore, it requires status
register 2 to be set all the time. Fortunately this is not much of a problem
when you have your own interrupt handler set-up.</p>

<pre>;
; Execute a VDP command
; In:  HL = pointer to 15-byte VDP command data
; Out: HL = updated
;
VDP_DoCopy:
    ld a,32
    di
    out (#99),a
    ld a,17 + 128
    ei
    out (#99),a
    ld c,#9B
VDP_DoCopy_Ready:
    in a,(#99)      ; loop if vdp not ready (CE)
    rra
    jp c,VDP_DoCopy_Ready
    outi            ; 15x OUTI
    outi            ; (faster than OTIR)
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    outi
    ret
</pre>

<p>~Grauw</p>




<?php addFooter(); ?>
</body>
</html>