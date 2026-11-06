<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MAP document authoring tutorial</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1>MAP document authoring tutorial</h1>

<p>On this page I’ll try to explain some guidelines for authoring a document for the MAP. Check <a href="https://github.com/grauw/map/blob/main/contributing/documents.php">the source on GitHub</a> to see how everything is done in this (and other) pages’ source code.</p>

<p>You can go ahead and get the source code from the <a href="https://github.com/grauw/map">MAP Git repository</a>. From there, You can start a new article or add a new resource, or modify an existing one. But keep in mind the social aspect of editing documents, that every article is made and thus ‘owned’ by someone. So although corrections to existing articles are fine, you probably shouldn’t make significant modifications without consulting with the author first. Also, if you want to make changes to the style sheet or site structure, drop me (Grauw) a line first :).</p>

<p>Once an article is more or less done, and fit for publishing, think of an appropriate section and category within the site structure, and if one isn’t there yet, add it. Try to keep the organization as logical as possible. Then place your file in the directory of the section you’ve chosen, and add a link to it in the section overview file (the <i>index.php</i> file in each section directory). If you’ve written the article yourself, or put a large effort in it like translating or transscribing, don’t forget to put your name at the bottom and add a ‘MAP marker’ by adding a <code>&lt;span class="map"&gt;MAP&lt;/span&gt;</code> to the link, so that people can see that it is authored by us and can exclusively be found on the MAP.</p>

<p>Finally, commit your changes on a Git branch and then open a pull request on GitHub, where someone can review your changes before they are pushed to the server. The review helps to make sure everything is correct and that it is using the right tags and correctly spelled, etc.</p>


<h2>Document syntax and formatting</h2>

<p>Let’s get started with the layout tags you should use. Every page on this site is made from a combination of XHTML, CSS, and Unicode (UTF-8). Here are links to the <a href="http://www.w3.org/TR/html4">HTML documentation</a>, the <a href="http://www.w3.org/TR/xhtml1/">XHTML documentation</a>, and the <a href="http://www.w3.org/TR/CSS21/">CSS 2.1 documentation</a>. The HTML and CSS docs are quite easy to use once you know how they’re structured.</p>

<p>XHTML Strict basically works as follows: it is largely the same as HTML Strict (meaning HTML without any of the tags marked Deprecated), but then written in XML, so every tag has to have an end-tag. If you write a <code>&lt;li&gt;</code>, always close it with a <code>&lt;/li&gt;</code>, and the same goes for <code>&lt;p&gt;</code>. Also, don’t write <code>&lt;img src="image.jpg"&gt;</code> and <code>&lt;br&gt;</code> but add a closing <code>/</code> at the end like so: <code>&lt;img src="image.jpg" /&gt;</code> and <code>&lt;br /&gt;</code>. The space before the / in singleton tags is important for HTML compatibility. Another requirement of XHTML is that all tags should be lowercase. And on a sidenote, don’t forget that <code>img</code> tags always need an <code>alt="description"</code> attribute. You can check the correctness of your text by running it through the <a href="http://validator.w3.org/">W3C MarkUp Validation Service</a>.</p>

<p>Note that on most browsers, the pages are served as XML and will thus not work if you make syntax errors, so be sure to verify your changes pages in a browser that is not Internet Explorer.</p>

<p>As for a good editor, my preference is <a href="http://www.flos-freeware.ch/notepad2.html">Notepad2</a>.</p>

<p>Well then, here goes the layout tags explanation:</p>


<h1><code>&lt;h1&gt;</code>Main topic<code>&lt;/h1&gt;</code></h1>

<p>You should put the main topic on the first line of your article, and you can also use it later on to indicate different chapters for example.</p>

<h2><code>&lt;h2&gt;</code>Sub head<code>&lt;/h2&gt;</code></h2>

<h3><code>&lt;h3&gt;</code>Sub sub head<code>&lt;/h3&gt;</code></h3>

<p><code>&lt;p&gt;</code>Paragraph with something <code>&lt;em&gt;</code><em>that needs emphasis</em><code>&lt;/em&gt;</code>, or even <code>&lt;strong&gt;</code><strong>strong emphasis</strong><code>&lt;/strong&gt;</code>. Some abbreviation for <code>&lt;abbr title="Disk Operating System"&gt;</code><abbr title="Disk Operating System">DOS</abbr><code>&lt;/abbr&gt;</code>, and <code>&lt;dfn&gt;</code><dfn>defenestrate</dfn><code>&lt;/dfn&gt;</code> is a new term that needs to be defined. You can use <code>&lt;i&gt;</code><i>italics</i><code>&lt;/i&gt;</code> to highlight e.g. file names. And finally <code>&lt;a href=""&gt;</code><a href="">a link</a><code>&lt;/a&gt;</code> at the end of the paragraph.<code>&lt;/p&gt;</code></p>

<h2>Some more tags (look at the code)</h2>

<p>Let’s display an unordered list of items now...</p>

<ul>
<li>first item</li>
<li>second item</li>
</ul>

<p>And an ordered list...</p>

<ol>
<li>first item</li>
<li>second item</li>
</ol>

<p>And a differently ordered list (use CSS!)...</p>

<ol style="list-style-type: upper-roman">
<li>first item</li>
<li>second item</li>
</ol>

<p>Some preformatted text/tables/code:</p>

<pre>                MSB  7   6   5   4   3   2   1   0  LSB
                   +---+---+---+---+---+---+---+---+
   Port #1         |A7 |A6 |A5 |A4 |A3 |A2 |A1 |A0 | First byte
                   +---+---+---+---+---+---+---+---+

	xor a
Label:	cpl
	jp Label
</pre>

<p>Put inline code fragments between <code>&lt;code&gt;</code> and <code>&lt;/code&gt;</code> tags.</p>


<p>And tables must only be used if you want to display a table...</p>

<table>
<tr>
  <th colspan="2">Name of table</th>
</tr>
<tr>
  <td>row 1</td>
  <td>Dude, what does my tattoo say</td>
</tr>
<tr>
  <td>row 2</td>
  <td>Sweet, what does my tattoo say</td>
</tr>
</table>


<p>If you want to render a matrix-like table, add a class="matrix" to the table tag:</p>

<table class="matrix">
<tr>
  <th colspan="2">Name of table</th>
</tr>
<tr>
  <td>row 1</td>
  <td>Dude, what does my tattoo say</td>
</tr>
<tr>
  <td>row 2</td>
  <td>Sweet, what does my tattoo say</td>
</tr>
</table>


<p>Also, a list of definitions (if you ever need it); Japanese lesson no. 1:</p>
<dl>
   <dt>Ittadakimasu</dt>
   <dd>The Japanese say this when they are about to start dinner. In English, it can be somewhat translated like ‘thank you for the food’ (they don’t really have a way of saying this, how impolite!). In Dutch it is simply ‘Smakelijk eten’.</dd>
</dl>




<h2>Use unicode!</h2>

<p>If you save your documents as Unicode (UTF-8), then you don’t need to use HTML character entity tags (those <code>&amp;something;</code> tags, please don’t use them) for special characters like ë, ×, 日本語, ©, ½, etc. In notepad this can easily be done by selecting UTF-8 as the codepage in the Save As dialog. However, saving as ASCII is fine too, as long as you don’t use any special characters.</p>

<p>However you’ll still need to use <code>&amp;amp;</code>, <code>&amp;lt;</code> and <code>&amp;gt;</code> for <code>&amp;</code>, <code>&lt;</code> and <code>&gt;</code>, because in HTML they are escape characters. They also need to be used inside preformatted (<code>&lt;pre&gt;</code>) tags.</p>


<h2>Custom styles</h2>

<p>You can also add custom styles to them to either block-level tags like <code>&lt;div&gt;</code> and <code>&lt;p&gt;</code> (<code>p</code> adds an empty line while <code>div</code> does not), or inline tags like <code>&lt;span&gt;</code> and <code>&lt;i&gt;</code> (generally you’ll want to use the span tag). This can be done with a <code>class=""</code> or a <code>style=""</code> identifier. The former refers to predefined classes in the style sheet, while you can specify any CSS2 style in the latter.</p>

<ul>
<li>Example 1: <code>&lt;span class="inv"&gt;</code><span class="inv">negative logic (invert)</span><code>&lt;/span&gt;</code> is an overline usually used for indicating negative logic.</li>
<li>Example 2: <code>&lt;span style="color: rgb(255,0,0)"&gt;</code><span style="color: rgb(255,0,0)">red colour</span><code>&lt;/span&gt;</code>, if you must… you really shouldn't do colors, actually :), it is just an example of how to do a custom style. You can also use named colours like <code>color: red</code>.</li>
</ul>



<p class="signed">~Grauw</p>

<?php addFooter(); ?>
</body>
</html>
