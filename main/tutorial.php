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
<body id="msxasm">
<?php addHeader(); ?>



<h1>MSX Assembly Page article tutorial</h1>

<p>On this page I'll try to explain the structure of a document. Check <a href="tutorial.html">this</a> link for the plain document, without any added headers and footers. You can see how everything is done in this (and other) page's source code.</p>

<p>Well then, let's sum up the 'rules' you have to stick to when you are working on the MAP on a somewhat regular basis (as in, you're a member of the MAP team :)). These are here to avoid that two people work on the same file at the same time, creating inconsistency. First of all, the <i>main.html</i>, <i>planned.html</i> and other section files should be downloaded, edited and uploaded as fast as possible, to avoid conflicts. Aside from those and the articles which are yours or of which you indicated that you're working on it, everything else is off-limits, so no tampering with the style sheet index script, or someone else's article. If you want to do such things, for example because you'd like to see an addition to the style sheet, please consult me (Grauw) first.</p>

<p>There is a file called <i>planned.html</i> in the root directory, everything which is being worked on or will be worked on in the future should be put in there. If you have an idea for an article (which you not necessarily have to write yourself), put it in that file, if you need an idea for an article, check out that file. If you are working or are going to work on a certain item, add your name behind the specific article between &lt;em&gt;<em>emphasis</em>&lt;/em&gt; tags to 'allocate' it for yourself. You can optionally include some additional info like a progress indication. Feel free to add new subsections when needed. You can optionally use the 'wip' directory for saving work-in-progress texts, and for testing the layout.</p>

<p>Once an article is more or less done, and fit for publishing, you can remove it from <i>planned.html</i>, and put it online on the site. Think of an appropriate section and category within the site structure, and if it isn't there yet, add it. Try to keep the organization as logical as possible. Then upload your file into the directory of the section you've chosen, and add a link to it in the section overview file (like for example <i>articles.html</i>). If you've written the article yourself, or put a large effort in it like translating or transscribing, don't forget to add a 'MAP' bullet by changing the &lt;li&gt; tag into &lt;li class="map"&gt;, so that people can see that it is authored by us and can exclusively be found on the MAP.</p>

<p>Furthermore, if you publish or update a text (unless it's a really minor update), you need to add it to the Last Updates section in <i>main.html</i> so that people can easily see what's been done recently, and also to keep ourselves informed about what the rest has been doing. The updates block is present right after the document title, and if you take a short look at the code, the method of adding an entry should be self-explanatory. Don't forget to change the date, by the way. If the list becomes too long, you can comment out one or two of the latest updates to make it a little shorter again. You can also put update blocks in your texts, which can be quite useful aswell. A block inside your text can hold details about the more minor updates not mentioned of the mainpage, and gives a quick overview of the recent changes of that article only. The method of adding such a block is explained in the example updates block below.</p>


<h2>Let's get started...</h2>

<p>...with the layout tags you should use. Every page on this site is made from a combination of XHTML, CSS2, and Unicode (UTF-8). Here are links to the <a href="http://www.w3.org/TR/html4">HTML documentation</a>, the <a href="http://www.w3.org/TR/xhtml11/">XHTML documentation</a>, and the <a href="http://www.w3.org/TR/REC-CSS2">CSS2 documentation</a>. The HTML and CSS2 docs are quite easy to use once you know how they're structured.</p>

<p>XHTML Strict basically works as follows: it is largely the same as HTML Strict (meaning HTML without any of the tags marked Deprecated), with the difference that every tag has to be terminated with a slash (/). So if you write down a &lt;li&gt;, always close it with a &lt;/li&gt;, and the same goes for &lt;p&gt;. Also, don't write &lt;img src="image.jpg"&gt; and &lt;br&gt; but &lt;img src="image.jpg" /&gt; and &lt;br /&gt;. The space before the / in single tags is important for HTML compatibility. Another requirement of XHTML is that all tags shoult be lowercase. And on a sidenote, don't forget that img tags always need an alt="description" property. You can check the correctness of your text by putting it online (in the wip directory), and running it through the <a href="http://validator.w3.org/">W3C MarkUp Validation Service</a>.</p>

<p>P.S. For HTML file editing purposes Notepad suits me just fine, but I can imagine getting tired of typing tags sometimes, especially if you need to do some major editing job with lots of search/replace stuff and all. In that case I can recommend the HTML editor 'HTML Kit', I have good experiences with 
it.</p>

<p>Well then, here goes the layout tags explanation:</p>


<h1>&lt;h1&gt;Main topic&lt;/h1&gt;</h1>

<div class="updates">
<h1>Latest updates:</h1>

<p><em>4/1/1900</em><br />
If you update an article, you can add an 'updates' block to your code. Just use the same code as is used here, and place it right after your first heading. By the way, the time notation format is day/month/year.</p>

<p><em>3/1/1900</em><br />
Also, when you update an article (if it's a really tiny update this isn't really necessary), place a notification in the <i>main.html</i> file, so that people who visit the page can see that it has been changed.</p>

<p><em>2/1/1900</em><br />
You should outdated updates between &lt;!-- comments --&gt;, so that they can still be viewed in the code for reference (updates usually become 'outdated' when the updates list is getting too long).</p>

<!--
<p><em>1/1/1900</em><br />
outdated</p>
-->
</div>

<p>You should put the main topic on the first line of your article, and you can also use it later on to indicate different chapters for example.</p>

<h2>&lt;h2&gt;Sub head&lt;/h2&gt;</h2>

<h3>&lt;h3&gt;Sub sub head ;p&lt;/h3&gt;</h3>

<p>&lt;p&gt;&lt;b&gt;<b>Paragraph</b>&lt;/b&gt; blablablablabla blabla blablabla blablablablablablabla bla bla blabla. The word &lt;i&gt;<i>italics</i>&lt;/i&gt; is rather difficult, and &lt;em&gt;<em>emphasis</em>&lt;/em&gt; might need some er, emphasis :). blablablabla bla blabla blablablablablablablablablablabla blablablabla bla blablablabla &lt;a href=""&gt;<a href="">link</a>&lt;/a&gt; end of paragraph.&lt;/p&gt;</p>

<h2>Some more tags (look at the code)</h2>

<p>Let's display an unordered list of items now...</p>

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
   <dd>Japese say this when they are about to start dinner. In English, it can be somewhat translated like 'thank you for the food' (they don't really have a way of saying this, how impolite!). In Dutch it is simply 'Smakelijk eten'.</dd>
</dl>


<h2>Use unicode!</h2>

<p>If you save your documents as Unicode (UTF-8), then you don't need to use HTML character entity tags (those annoying ones starting with an &amp; and ending with a ;, they can make your texts a bitch to read :)) for special characters like ë, ×, 日本語, ©, ½, etc. In notepad this can easily be done by selecting UTF-8 as the codepage in the Save As dialog. However, saving as ASCII is fine too, just as long as you don't use any special characters then.</p>

<p>However you'll still need to use &amp;amp;, &amp;lt; and &amp;gt; for &amp;, &lt; and &gt;, because in HTML they are escape characters. They also need to be used inside preformatted (&lt;pre&gt;) tags.</p>


<h2>Custom styles</h2>

<p>You can also add custom styles to them to either block-level tags like &lt;div&gt; and &lt;p&gt; (p adds an empty line while div does not), or inline tags like &lt;span&gt; and &lt;i&gt; (generally you'll want to use the span tag). This can be done with a class="" or a style="" identifier. The former refers to predefined classes in the style sheet, while you can specify any CSS2 style in the latter.</p>

<ul>
<li>Example 1: &lt;span class="inv"&gt;<span class="inv">negative logic (invert)</span>&lt;/span&gt; is an overline usually used for indicating negative logic.</li>
<li>Example 2: &lt;span style="color: rgb(255,0,0)"&gt;<span style="color: rgb(255,0,0)">red color</span>&lt;/span&gt;, if you must... you really shouldn't do colors, actually :), it is just an example of how to do a custom style. You can btw also use color: red, but that on a sidenote.</li>
</ul>

<p>Some more examples (note how they are not separated by an empty line because I use &lt;div&gt; instead of &lt;p&gt;) (although you'll generally want to use &lt;br /&gt; for common line breaks):</p>

<div style="text-align: right">&lt;div style="text-align: right"&gt;right-aligned&lt;/div&gt;</div>
<div style="text-align: center">&lt;div style="text-align: center"&gt;centered&lt;/div&gt;</div>

<h3 style="clear:none">XHTML Conformance</h3>

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


<pre>





       .;;.a,      .,.        .,,.
     ,@;;;;.,a  ,@@a;a@@,   ,@@@@@@,
     @@`;;;;'@,@@@'@;@`@@@,@@@oooo@@
     @@,Ssss';@@@@aaaaa@@@@;@@oooo@@
      `SSSS;,@@@@@@@@@@@@@@@,@@@@@' ,;;,
     .sSSSS;@@@@@@@@@@@@@@@@@     ;,;;;;
     sSSSSS;`@@@@@@@@@@@@@@@'      ;;;;'
     SSSSSSSs;%%ssssssss%%,sSSs, .SsssS
     SSSSSSSS;%%sSSSSSSSs%%;SSSSSSSSSS'
     `SSSSSSS;%%sSSSSSSSSs%%;SSSSSSS'
       `SSSS;%%%%%%%%%%%%%%%% """""       ..,,,,..
         `SS;%%%%%%%%%%%%%%%%,     .,;;;;;;'''''';;;;;;,
           %%%%%%%%%%%%%%xx%%%.;;;;;;'                `;;;.
           %%%%%%%%%%%%%xx%%%%%                         `;;.
           %%%%%%%xxx%^%%%%%%%%%                         `;;
           %%%%%%%%%%' `%%%%%%%%.,                        ;'
           %%%%%%%%%'    `%%%%';;;'oOOo                  ;'
           %%%%%%%%%       `%';;'oOOOOO                 '
           `%%%%%%%'         `;'OOOOOO'
             ;;;;;             `OOOOO'
        ',,''oOOOo'',,'          """
            OOOOOOO
          ..,,,,,,,,.                      `;;.//
        ,'`;;;;;;;;;;;',                   .oOOoOOo.
       ;   ;;;;;;;;;;;  ;                  OOOOOOOOO
       ;  .;;;;;;;;;;;, ;,;;;;;;;,.        `OOOOOOO'
        `;;;;;;;;;;;;;;' ;;;;;;;;;;`,      ;`OOOOO',
         .%%%%%%%%%%,' ,;;;;;;;;;;  ;      ;;,,,,,;'
        .%%%%%%%%%%%%,%%%%%;;;;;;;, ;    .;;;;;;;;'       ;
       ,%%%%%%%%%%%%%,%%%%%%;;;;;;;'   .;;;;;;;;'        ;   .'
       %%%%%%%%%%%%%%,%%%%%%%        .;;;;;;;;;'        ;  .'
      ,%%%%%%%%%%%%%'%%%%%%%;,.     ;;;;;;;;;;    .a@~~a, '
      %%%%%%%%%%%%%'%%%%%%%,%%%%%%,,;;;;;;;;'  .a@@@@a@@@@a.
     ,%%%%%%%%%%%%'%%%%%%%,%%%%%%%%%,;;;;;;; .a@@oOOOo@@@@@@a.
     %%%%%%%%%%%%'%%%%%%%%%,'''',%%%%%%%%,;.a@@OOOOOOOO@""@ @@a.
    ,%%%%%%%%%%%'%%%%%%%,;;;,,,,,%%%%;;`%%.@@@OOOOOOOOO@@@a@@@@@.
    %%%%%%%%%%%%%%%%%%,;;;;;;;;,%%%,;;;;;.@@@@@OOOOOOO@@@@@@@@@@@
    ####%%%%%%%%%%%%%,;;;;;;;;,%%%%%%%%,;,@@@@@@@@@@@@@@@@@@@@@@@
    ####%%%%%%%%%%%%%;;;;;;;;;;;;;;;;;;%%,@@@@@@@@@@@@`aa.@@@@@@@
    `###%%%%%%%%%%%%%;;;;;;;;;;;;;;;;;;;;%%`@@@@@@@@@@`@@@.@@@@@'
      `%%%%%%%%%%%%"""`;;;;;;;;;;;;;;;;;;;;;''`@@@@@@@@`@@@.@@'@
       .;''''';.  .;;;;;,    ..,,,,,..    ,;;;;;.   ,;'''@@@a @@
       ;,,,,,,;; ;;;' `;;;,::;;;;;;;;;::,;;;' `;;; ;;,,,,@oo@a`@
       `;;;;;;;; ;;;,,,;;;;;:';;;;;;;;`;;;;;,,,;;; ;;;;;;@@oo@@a
        `;;;;;;;;,`;;;;;;;:,;;;;;;;;;;;;,;;;;;;;',;;;;;;;@@oooo@@a
         `;;;;;;'%%% .:::;;;;' ;;;;;' ;;;;:::, %%%`;;;;;'@@@ooooo@@a
           ;;'%%%%%%.::;;;;;a@@@. .@@@a;;;;;::.%%%%%%`;  `@@@oooooo@@a
          ,%%%%%%%%%.::;;;;@@@@@@;@@@@@@;;;;::.%%%%%%%%%, @@@oooooooo@@a
          `%%%%%%%%%%.::;;;@@@'@@;@@`@@@;;;::.%%%%%%%%%%' `@@ooooooooo@@a.
             `%%%%%%%%%`::;;@@@aaaaa@@@;;::'%%%%%%%%%'     @@oooooooooo@@@a
            .%%%%%%%%%%;!!,,,,,,,,,,,,,,,!!;%%%%%%%%%%%,  .@@@ooooooooo@@@@
           %%%%%%%%%%%;!!!!!!!!!!!!!!!!!!!!!;%%%%%%%%%%%  @;@@@oooooooo@@@'
           %%%%%%%%%%%;!!!!!!!!  "  !!!!!!!!;%%%%%%%%%%%  @a;@@@ooooo@@@@'
           `%%%%%%%%%;!!!!!!!!!!, .!!!!!!!!!!;%%%%%%%%%'  @@@a;@@@@@@@@'
              `%%%%%;!!;!!;!!;!!;!!;!!;!!;!!;!;%%%%%'     `@@@@aaaaaa'
                  .!!!!!!!!!!!!!!!!!!!!!!!!!!!!!.           `@@@@@@'
                 .!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!.
                !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
               ,!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!,
              ! !!! !!! !!! !!! !!! !!! !!! !!! !!! !
             .!!! !!! !!! !!! !!! !!! !!! !!! !!! !!!.
             !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! !!!!!
            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',;'!!!!!   ';,
            `!!`!!`!!`!!`!!`!!`!!`!!`!!`!!`!!',;; !'!!'    ;;,
                      ;;;;;;;;;;;^;;;;;;.,,,,.;;;a@@@@@@@@a;;;  .,,.      ,
                      ;;;;;;;;;;' `;;',a@@a%%%%%%%%%@@@@@%%%%,@@@@@@@@%%;'
       _             .::;;;;;;,'   ; a@@@@@%%%%%%%''%@@%%``%%%%@@@@@%%;;'
     ('v')    ;    ,@a,`;;;,aa@,  , a@@@%%%^%%%%%,%%%%%%%%%,%%%%%%%;;;'
     (,_,)   ;;; ,' `@@ @@@@@@';  ; @@@%%'  %%%%%%% `%%% `%%%%%%%;;'
    .,;;;;.  `;' :.           ,'  `,`@'  ..,;%%a@@@@@@@@@@@@@a%%'
  .;;'|/ `;;;;'.aaaaaaaaaaaaaa%%%%%%%%%%%%%%%a@@@@@@@@@@@@@@@@@a
  ;;.      .a@@@@@@@@@@%%%%%%%%%%%%%%%%%%%%%%@@@@(`@@@@@@@')@@@@
  `;;.   ,a@@@@@@@@@@@@@a%%%%%%%%%%%%%%%%%%%::@@@@a@@@@@@@a@@@@:.
    `;;.a@@@@@@@@@@@@@@%%%%%%%%%%%%%%a@@@%%::%%`@@@@@@@@@@@@@'%%::  ,'',
      `@@@@@@@@@@@@@@@%%%%%%%@@a%a@@@@@@@%::%%%%%%%%%%%%%%%%%%%%%::'   ;
      @@@@@@@@@@@@@@@@@a%%%%@@@@@@@@@@@@@%;;|;,;|;,;|;,;|;.;|;,;|;;   / \
      @@@@@@@@@@@@@@@@%%%%%%%@@@@@@@@@@@@%`;;,|;,;|;,;|;,;|;,;|;,;'  | A |
      %%%%%%@@@@@%%%;%%%%%%@@@@@@@@@@@@@@@%`|;,;|;,;|;,;|;,;|;,;|'   | P |
      `@@%%%%%%%%;'%%%%%%%%%%@@@@%%@@%%%%%%%,`|;,;|;,;|;,;|;,;|'     | P |
       `@@a%%%%%%.%%% '''%%%%%%%%%%%%%%%'''''' %%%@@@%%.%%%%'        | L |
        @@@@%%%%.%%%'                          %%%@@@@.%%%a@         | E |
        @@@%%%%.@a%%                           %%%@@%%.%%@@@         | S |
 ~~~~~~ @%%%%%%.@@%% ~~   ~~~~~~~~~    ~~~~~~~ %%%%@@@.%%%@@ ~~~~    `~~~'
        `:::::'`:::'                           `:::::'`::::' Susie Oviatt
</pre>




<?php addFooter(); ?>
</body>
</html>