<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Disk I/O error handling in MSX-DOS 1</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1 style="text-align:center">Disk I/O error handling in MSX-DOS 1</h1>

<p>by Ramon van der Winkel, 22/02/1992<br />
by request of Matthijs Corpeleijn<br />
translated by Laurens Holst</p>

<p>When an error occurs during floppy disk I/O, for example because there’s no
disk in the disk drive, it’s not nice when a DOS error message appears right in
the middle of the execution of the program. Especially when the program is Dutch
and the error shown is English.</p>

<p>The error can be captured and redirected to a custom handler in the program.
This handler can then use a more fitting way to ask the user how to deal with
the error. Regardless of whether this is done with a single-line message or a
graphical window.</p>

<p>In MSX-DOS 1 the program has to deal with everything manually. Two addresses
need to be diverted and any possible stack problems also need to be taken care
of by the program itself. Fortunately MSX-DOS 2 has a better way of handling
things; a couple of ready-made routines do most of the work.</p>

<h2>DOS 1</h2>

<p>There are two relevant addresses for handling errors in MSX-DOS 1. First of
all there’s the address which points to the error handling routine. Additionally
there’s an address which is called when the “Abort” option is chosen.</p>

<p>For the error handling routine you need to use the address F323 in the system
memory. The contents of this address point to another address which in turn
contains the address of the routine. For example:</p>

<pre>F323 -> D000
D000 -> D002
D002 Start routine</pre>

<p>When the error handling routine chooses the Abort option, MSX-DOS jumps to a
routine which ends with a jump instruction to return to the prompt. We can
change this into a jump to our program by setting the address of our routine
at address F1E6.</p>

<pre>F1E6 -> Abort handler</pre>

<p>The abort handler exists to intercept stack errors. When Ignore or Retry is
chosen, a succesful attempt will return to the BDOS function’s call site, and
when another error occurs the error handling routine is called again.</p>

<p>Next, the stack needs to be preserved. This can be done as follows, by
introducing a universal wrapper routine for invoking the BDOS to the
program:</p>

<pre><code>bdos:   ld (errStack),sp
        call 5
        ret</code></pre>

<p>At this point the error handling routines should already have been set up,
and when an abort occurs it should jump to the following routine:</p>

<pre><code>bdosAbort: ld sp,(errStack)
           ret</code></pre>

<p>This will return to the routine that originally invoked the bdos. All that’s
left is a mechanism that lets you check for errors. This can be done by setting
a variable first before using the above method to return.</p>

<p>When the application diverts these two addresses, it’s important that the
original values are preserved and restored when the program terminates.</p>

<p>All that remains is the description of the error codes that MSX-DOS 1 passes
to the error handling routine. First of all the A register contains the drive
number. This is the drive which produced the error. The C register will contain
an indication of the error, see the following table:</p>

<pre>b7=1 : Bad FAT
b0=0 : Read action
b0=1 : Write action

b3 b2 b1
0  0  0: Write Protected
0  0  1: Not Read (disk offline)
0  1  0: CRC error
0  1  1: Seek error
1  0  0: Record not found (sector not found)
1  0  1: Write error
1  1  0: Other
</pre>

<p>When returning from the error handler, register C should specify the action
to take:</p>

<pre>0 = Ignore
1 = Retry
2 = Abort</pre>

<p>When option 2 (abort) is chosen, it will jump to the abort routine which we
diverted earlier.</p>

<p>That’s all there is to it. One more thing: be careful where you put the error
handling routine. This routine is called by the DiskROM and it may not be able
to reach a routine in page 1 (4000..7FFF). However for the abort routine this is
not an issue, as by this time the full TPA memory has been re-enabled.</p>

<p>For the MSX-DOS 2 error handling, please refer to the MSX-DOS application
manual.</p>




<?php addFooter(); ?>
</body>
</html>