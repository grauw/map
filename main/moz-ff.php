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



<h1>Best viewed with Mozilla Firefox</h1>

<p>This site is designed in a browser-independant way, using the latest standards such as <a href="http://www.w3.org/TR/html4/" title="HyperText Markup Language">HTML 4.1</a>, <a href="http://www.w3.org/TR/xhtml1/" title="eXtensible HyperText Markup Language">XHTML 1.1</a> and <a href="http://www.w3.org/TR/CSS21/" title="Cascading Style Sheets">CSS 2.1</a>. This means small, tidy code, and a flexible layout design. It also means that the site can be viewed virtually everywhere, from common PC's to text-only browsers (Lynx) to pocket devices such as the to-be One-Chip-<abbr title="Machines with Software eXchangeability">MSX</abbr> ;p. Fudebrowser will not have much trouble with it either.</p>

<p><a href="http://spreadfirefox.com/community/?q=affiliates&amp;id=341&amp;t=86"
      title="Get Firefox - Web Browsing Redefined">
<img style="border: 0; float: right; margin: .3em;"
     src="http://www.mozilla.org/products/firefox/buttons/takebacktheweb_large.png"
     width="185" height="72" alt="Get Firefox" /></a>

Nevertheless, the site is designed on the Mozilla Firefox browser, and therefore mainly oriented towards that browser. I like going through the documentation of <abbr title="Cascading Style Sheet">CSS</abbr> to make the <acronym title="MSX Assembly Page">MAP</acronym> look subtly better, and discover new web site properties, such as page break codes so that pages are printed better. Or more informative, such as adding a shitload of annoying abbr and acronym tags for all abbreviations and acronyms on this page :). Quite some of those features in the deeper chasms of <abbr title="Cascading Style Sheet">CSS</abbr> are only supported by Mozilla, or at least not by <abbr title="Internet Explorer 6">IE6</abbr>. Such as the &lt;abbr&gt; tag, similar to &lt;acronym&gt; and supposed to be used in conjuncion with it, but <abbr title="Internet Explorer 6">IE6</abbr> only supports the latter one. Now that Firefox 0.8 has arrived, including a Windows installer, plus the proper showing of embedded text files, I thought the time was right to officially endorse Firefox as 'the best <acronym title="MSX Assembly Page">MAP</acronym> browser' ;p.</p>

<p>Why Mozilla Firefox is better suited for viewing the <acronym title="MSX Assembly Page">MAP</acronym> than Internet Explorer 6:</p>

<ul>
  <li>Tabbed browsing is very useful when keeping several documents open for reference.</li>
  <li>Firefox supports the 'pre-wrap' style, which makes text files such as the <a href="/viewer.php?f=/resources/IDESYS.TXT">IDE system docs</a> a lot more readable (p.s. found IE tag too).</li>
  <li>The transscribed <a href="/resources/v9938.html">v9938 application manual</a> uses page break <abbr title="Cascading Style Sheet">CSS</abbr> tags, and prints better in Firefox.</li>
  <li>Firefox offers a style selector in the status bar, with which you can select an alternate style sheet for the site. For now, you can alternatively select the 'MAP Modern' style ;), but in the future also expect MSX-oriented styles.</li>
</ul>

<p>And, ofcourse, not to forget the other more general advantages of Firefox which make life easier:</p>

<ul>
  <li>Mozilla Firefox is a very fast browser, and doesn't look awkward like Mozilla does.</li>
  <li>Firefox has good <abbr title="Cascading Style Sheet">CSS</abbr> support, and less bugs than <abbr title="Internet Explorer 6">IE6</abbr>, giving web developers much more flexibility and less headaches.</li>
  <li>It also has a 'Quirks mode' in which it emulates the bugs in <abbr title="Internet Explorer 5.5">IE5.5</abbr>, so you can browse almost every page without problems.</li>
  <li>Firefox is an opensource browser still in development, continuously adding support for the latest web standards (the <abbr title="Cascading Style Sheet">CSS</abbr>2.1 pre-wrap tag is a good example of this - it isn't supported in <abbr title="Internet Explorer 6">IE6</abbr> and wasn't in Firebird 0.7 either). If you encounter a bug you can always submit it to the developers, or even make a fix yourself.</li>
  <li>The new Firefox has pretty logo's ^_^. Oh, and good <acronym title="Portable Network Graphics">PNG</acronym> support too.</li>
</ul>

<p>Some examples of what I have to go through to get things working on <abbr title="Internet Explorer 6">IE6</abbr>, even when designing just this simple site... If you look at the page without styles for example ('Basic Theme'), the menu looks kinda sucky. I would have implemented it as an unordered list (ul), were it not that <abbr title="Internet Explorer 6">IE6</abbr> doesn't support fully customizing those styles. And now it looks bad on every device not supporting styles, including Fudebrowser. Another one, in the page source you can read that I had to omit the (fortunately optional) <abbr title="eXtensible Markup Language">XML</abbr> declaration tag in all documents, because if I put *anything* before the !DOCTYPE declaration, even just a mere comment, <abbr title="Internet Explorer 6">IE6</abbr> will drop out of 'Standards Compliance' mode and start emulating the <abbr title="Internet Explorer 5.5">IE5.5</abbr> bugs. That caused me a lot of additional work with today's site redesign, when I tried it in <abbr title="Internet Explorer 6">IE6</abbr> I got an unpleasant reminder of this bug.</p>


<p>Now let's hope everyone will start to use Firefox ^_^, because that will make my web designing job a lot easier and enable me to implement new stuff which I currently can't because of <abbr title="Internet Explorer 6">IE6</abbr> compatibility. Though I must say <abbr title="Internet Explorer 6">IE6</abbr> is still pretty decent, and at least way better than its predecessors.</p>

<p>p.s. in <abbr title="Internet Explorer 6">IE6</abbr>, you can drag this <a href="javascript:var i=0;if(document.styleSheets.length>0){cs=!document.styleSheets[0].disabled;for(i=0;i&lt;document.styleSheets.length;i++) document.styleSheets[i].disabled=cs;};void(cs=true);">stylesheet toggle favelet</a> to your bookmarks toolbar, or bookmark it, in order to toggle between a page's stylesheets. It doesn't work exactly as it should, and the alternates might not work in <abbr title="Internet Explorer 6">IE6</abbr>, but it's better than nothing :).</p>

<p style="text-align: center;">
<a href="http://spreadfirefox.com/community/?q=affiliates&amp;id=341&amp;t=58"
      title="Get Firefox - The Browser, Reloaded">
<img style="border: 0;"
     src="http://www.mozilla.org/products/firefox/buttons/getfirefox_large2.png"
     width="178" height="60" alt="Get Firefox" /></a>
</p>




<?php addFooter(); ?>
</body>
</html>