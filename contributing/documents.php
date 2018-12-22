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

<p>On this page I’ll try to explain some guidelines for authoring a document for the MAP. Check <a href="https://bitbucket.org/grauw/map/src/default/contributing/documents.php">the source on Mercurial</a> to see how everything is done in this (and other) pages’ source code.</p>

<p>You can go ahead and get the source code from the <a href="https://bitbucket.org/grauw/map">MAP Mercurial repository</a>. From there, You can start a new article or add a new resource, or modify an existing one. But keep in mind the social aspect of editing documents, that every article is made and thus ‘owned’ by someone. So although corrections are fine, you probably shouldn’t push significant modifications onto the server without consulting with the author first. Also, if you want to make changes to the style sheet or site structure, drop me (Grauw) a line first :).</p>

<p>If you have push rights to the server, keep in mind that everything you push will be live immediately. Generally speaking, it’s also always useful if someone reviews your changes before they are pushed to the server. Of course, this review can also happen after things are pushed, but because we use Mercurial, if you are unsure about whether something is correct or using the right tags or correctly spelled or whatever, you can easily draft some changes and send them to someone else for review.</p>

<p>Once an article is more or less done, and fit for publishing, think of an appropriate section and category within the site structure, and if one isn’t there yet, add it. Try to keep the organization as logical as possible. Then upload your file into the directory of the section you’ve chosen, and add a link to it in the section overview file (the <i>index.php</i> file in each section directory). If you’ve written the article yourself, or put a large effort in it like translating or transscribing, don’t forget to put your name at the bottom and add a ‘MAP marker’ by adding a <code>&lt;span class="map"&gt;MAP&lt;/span&gt;</code> to the link, so that people can see that it is authored by us and can exclusively be found on the MAP.</p>

<p>Furthermore, if you publish or update a text (unless it’s a really minor update), please add it to the Last Updates section in <i>main/index.php</i> so that people can easily see what’s been done recently, and also to keep ourselves informed about what the rest has been doing. The updates block is present right after the document title, and if you take a short look at the code, the method of adding an entry should be self-explanatory. Don’t forget to change the date, by the way. If the list becomes too long, you can move a couple of the oldest updates to <i>main/updates-old.php</i> to make it a little shorter. You can also put update blocks in your texts, which can be quite useful aswell. A block inside your text can hold details about the more minor updates not mentioned of the mainpage, and gives a quick overview of the recent changes of that article only. The method of adding such a block is explained in the example updates block below.</p>


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

<pre>
                MSB  7   6   5   4   3   2   1   0  LSB
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

<h3>XHTML Conformance</h3>

<p>Finally, here is an extract of a <a href="http://www.mozilla.org/projects/mathml/authoring.html">Mozilla.org document about MathML</a>, which gives a pretty good explanation of the XHTML basics compared to HTML.</p>

<p>Here are the main rules to produce XHTML compliant
documents that will work with Mozilla:</p>

<ul>
  <li><b>XHTML tags are all lowercase</b> 
    <table border="1" width="75%">
      <tr> 
        <td width="50%" align="center"> 
          <p><b>HTML</b></p>
        </td>
        <td width="50%" align="center"> 
          <p><b>XHTML</b></p>
        </td>

      </tr>
      <tr> 
        <td width="50%"> 
          <p><b><code>&lt;H1 Align=&quot;CENTER&quot;&gt;Cauchy<br />
            Integral&lt;/H1&gt;</code></b></p>
        </td>
        <td width="50%"> 
          <p><b><code>&lt;<font color="red">h1 a</font>lign=&quot;<font color="red">center</font>&quot;&gt;Cauchy<br />

            Integral&lt;/<font color="red">h1</font>&gt;</code></b></p>
        </td>
      </tr>
    </table>
    <br />
  </li>
  <li><b>All non-empty elements must be terminated</b> 
    <table border="1" width="75%">

      <tr> 
        <td width="50%" align="center"> 
          <p><b>HTML</b></p>
        </td>
        <td width="50%" align="center"> 
          <p><b>XHTML</b></p>
        </td>
      </tr>
      <tr> 
        <td width="50%" valign="top"> <b> 
          <pre>
&lt;p&gt;MathML
  &lt;ul&gt;
    &lt;li&gt;Presentation markup
    &lt;li&gt;Content markup
  &lt;/ul&gt;
            </pre>
          </b> </td>
        <td width="50%" valign="top"> <b> 
          <pre>
&lt;p&gt;MathML
  &lt;ul&gt;
    &lt;li&gt;Presentation markup<font color="red">&lt;/li&gt;</font>
    &lt;li&gt;Content markup<font color="red">&lt;/li&gt;</font>
  &lt;/ul&gt;
<font color="red">&lt;/p&gt;</font>
            </pre>
          </b></td>
      </tr>
    </table>
    <br />
  </li>
  <li><b>Empty elements must include a trailing slash (/)</b> 
    <table border="1" width="75%">
      <tr> 
        <td width="50%" align="center"> 
          <p><b>HTML</b></p>
        </td>
        <td width="50%" align="center"> 
          <p><b>XHTML</b></p>
        </td>
      </tr>
      <tr> 
        <td width="50%"> 
          <p><b><code>&lt;img src=&quot;myimage.gif&quot;&gt;</code></b></p>
        </td>

        <td width="50%"> 
          <p><b><code>&lt;img src=&quot;myimage.gif&quot; <font color="red">/</font>&gt;</code></b></p>
        </td>
      </tr>
      <tr> 
        <td width="50%"> 
          <p><b><code>&lt;br&gt;</code></b></p>
        </td>
        <td width="50%"> 
          <p><b><code>&lt;br <font color="red">/</font>&gt;</code></b></p>
        </td>
      </tr>
      <tr> 
        <td width="50%"> 
          <p><b><code>&lt;hr&gt;</code></b></p>
        </td>
        <td width="50%"> 
          <p><b><code>&lt;hr <font color="red">/</font>&gt;</code></b></p>
        </td>
      </tr>
    </table>
    <br />
  </li>
  <li><b>All attribute values must be quoted</b></li>
  <table border="1" width="75%">
    <tr> 
      <td width="50%" align="center"> 
        <p><b>HTML</b></p>
      </td>
      <td width="50%" align="center"> 
        <p><b>XHTML</b></p>
      </td>
    </tr>
    <tr> 
      <td width="50%"> 
        <p><b><code>&lt;table border=0&gt;</code></b></p>
      </td>
      <td width="50%"> 
        <p><b><code>&lt;table border=<font color="red">&quot;</font>0<font color="red">&quot;</font>&gt;</code></b></p>
      </td>
    </tr>
  </table>
  <br />
  <li><b>Attribute-value pairs must be written in full</b></li>
  <table border="1" width="75%">
    <tr> 
      <td width="50%" align="center"> 
        <p><b>HTML</b></p>
      </td>
      <td width="50%" align="center"> 
        <p><b>XHTML</b></p>
      </td>
    </tr>
    <tr> 
      <td width="50%"> 
        <p><b><code>&lt;td nowrap&gt;</code></b></p>
      </td>
      <td width="50%"> 
        <p><b><code>&lt;td nowrap<font color="red">=&quot;nowrap&quot;</font>&gt;</code></b></p>
      </td>
    </tr>
  </table>
  <br />
  <li>The root element of the document must be <code>&lt;html&gt;</code> and must designate 
    the XHTML namespace<br />
    <code>&lt;html xmlns="http://www.w3.org/1999/xhtml"></code><br />
    <br />
  </li>

  
<li>All documents must have a <code>DOCTYPE</code> declaration
<pre>
&lt;!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"&gt;

&lt;!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;

&lt;!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"&gt;
</pre>
  </li>

</ul>



<p>Here is an example of a minimal XHTML document.</p>

  
<pre><font color="#500000"><b>&lt;?xml</b> <font color="#0000A0"><b>version=&quot;</b></font><font color="#000080">1.0</font><font color="#0000A0"><b>&quot;</b></font><font color="#500000"></font><b>?&gt;</b></font>  
<font color="#500000"><b>&lt;!DOCTYPE</b> <font color="#0000A0"><b>html PUBLIC</b></font><font color="#000080"> &quot;-//W3C//DTD XHTML 1.0 Strict//EN</font><font color="#0000A0">" &quot;DTD/xhtml1-strict.dtd"</font><b>&gt;</b></font>  <font color="#500000"><b>

&lt;html</b> <font color="#0000A0"><b>xmlns=&quot;</b></font><font color="#000080">http://www.w3.org/1999/xhtml</font><font color="#0000A0"><b>&quot;</b></font><b>&gt;</b></font>  
  <font color="#500000"><b>&lt;head</b><b>&gt;</b></font>  
    <font color="#500000"><b>&lt;title</b><b>&gt;</b></font><font color="#005000">Minimum XHTML Document</font><font color="#500000"><b>&lt;/title&gt;</b></font>  
  <font color="#500000"><b>&lt;/head&gt;</b></font>  
  <font color="#500000"><b>&lt;body</b><b>&gt;</b></font>  
    <font color="#500000"><b>&lt;p</b><b>&gt;

      </b></font><font color="#005000">Accept all valid XHTML, including therefore</font> 
<font color="#005000">      </font><font color="#500000"><b>&lt;a</b> <font color="#0000A0"><b>href=&quot;</b></font><font color="#000080">http://www.mozilla.org/</font><font color="#0000A0"><b>&quot;</b></font><b>&gt;</b></font><font color="#005000">links</font><font color="#500000"><b>&lt;/a&gt;</b></font>.<font color="#500000">
<b>    &lt;/p&gt;</b></font>  
  <font color="#500000"><b>&lt;/body&gt;</b></font>  

<font color="#500000"><b>&lt;/html&gt;</b></font>
</pre>



<p class="signed">~Grauw</p>

<?php addFooter(); ?>
</body>
</html>
