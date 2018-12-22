<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>The MAP repository</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>

<h1>The MAP repository</h1>

<p>The MSX Assembly Page source code is stored in a Mercurial revision control repository, which you can find here:</p>

<p><a href="https://bitbucket.org/grauw/map">https://bitbucket.org/grauw/map</a></p>

<p>Below you will find short instructions on how to work with Mercurial.</p>

<p>If you have push rights, please be sure to verify your changes on the website after pushing changes to the repository.</p>

<p>The process to get push access is not very well defined, but usually after you’ve submitted a couple of good changes and grown accustomed to the structure of the site, you can get access.</p>

<h2>About Mercurial</h2>

<p>Mercurial is a distributed revision control system. You can download Mercurial <a href="http://www.selenic.com/mercurial/">from their website</a>. For Windows users, I recommend you get <a href="http://bitbucket.org/tortoisehg/stable/">TortoiseHg</a> GUI shell extension which also installs the command line-tools. There is also an Eclipse extension. Below I will give you short instructions on how to use Mercurial from the command-line, but you should be able to find the corresponding commands in TortoiseHg relatively easily.</p>

<p>You start by cloning the main repository on your local system:</p>

<pre>hg clone https://bitbucket.org/grauw/map</pre>

<p>Now you can start making changes. Every time you make a unit of related changes, you can commit them into your local repository:</p>

<pre>hg commit -m "A short message describing your changes"</pre>

<p>If you add new files, you have to use <code>hg add</code> to make the revision control system notice them. Alternatively, you can use the TortoiseHg commit dialog to add them before committing.</p>

<p>If in the meanwhile there are changes published on the server, you can pull them into your local repository:</p>

<pre>hg pull</pre>

<p>And update your working copy:</p>

<pre>hg update</pre>

<p>Note here that <code>pull</code> will not immediately update your working copy. If you wish however you can automatically update after a pull by adding the <code>-u</code> option. Note for TortoiseHg users: all these commands are available under the ‘Synchronize’ option in the TortoiseHg context menu.</p>

<p>Once your changes are ready for publication, you can push all the changes that you committed locally into the main repository, and they will automatically appear on the website. Note that in order to push, you need to use HTTPS. You can configure a <a href="http://www.selenic.com/mercurial/wiki/index.cgi/TipsAndTricks#head-903d2da677af8b40172345b98072b4b2826bad22">default push location</a> in Mercurial so that it will remember it.</p>

<pre>hg push https://bitbucket.org/grauw/map</pre>

<p>In order to be able to push changes directly into the repository you need push rights, so if you do not have those then instead you can send your changes to the MAP by email using an ‘email-bundle’. You can do this easily from TortoiseHg, to use it from the command-line you need to first enable the <a href="http://www.selenic.com/mercurial/wiki/index.cgi/PatchbombExtension">Patchbomb extension</a> that is bundled with Mercurial.</p>

<p>For more information, consult the <a href="http://www.selenic.com/mercurial/">Mercurial website</a> or read the <a href="http://hgbook.red-bean.com/">Mercurial book</a>. The command-line tool also has help pages available if you type <code>hg help</code>.</p>



<?php addFooter(); ?>
</body>
</html>
