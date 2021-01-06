"use strict";
const express = require("express");
const path = require("path");
const fs = require("fs");

const app = express();
const port = 8048;

function getStyles() {
	return '<link rel="stylesheet" href="/css/map.css" type="text/css" />\n' +
		'<meta name="viewport" content="width=device-width, initial-scale=1" />\n';
}

function getHeader() {
	return '<h1 id="head">MSX Assembly Page</h1>\n' +
		'<div id="menu">\n' +
		'<ul>\n' +
		'<li><a href="/">Main</a></li>\n' +
		'<li><a href="/articles/">Articles</a></li>\n' +
		'<li><a href="/resources/">Resources</a></li>\n' +
		'<li><a href="/sources/">Sources</a></li>\n' +
		'<li><a href="/links/">Links</a></li>\n' +
		'<li><a href="/contributing/">Contributing</a></li>\n' +
		'</ul>\n' +
		'</div>\n' +
		'<div id="content">\n';
}

function getFooter() {
	const year = new Date().getFullYear();
	return `</div>\n<div id="foot">© ${year} MSX Assembly Page. MSX is a trademark of MSX Licensing Corporation.</div>\n`;
}

app.get("/scripts/*", (req, res) => res.sendStatus(403));
app.get("/node_modules/*", (req, res) => res.sendStatus(403));

app.get(/\/$/, (req, res, next) => {
	req.url = `${req.path}index.php`;
	next();
});

app.get("*.php", async (req, res) => {
	let buffer;
	try {
		buffer = await fs.promises.readFile(req.path.substring(1));
	} catch (error) {
		return res.sendStatus(404);
	}

	const document = buffer.toString("utf8")
		.replace("<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>\n", "")
		.replace("<?php addStyles(); ?>\n", getStyles())
		.replace("<?php addHeader(); ?>\n", getHeader())
		.replace("<?php addFooter(); ?>\n", getFooter());

	res.vary("Accept");
	if (req.accepts("application/xhtml+xml") && !/Chrome/.test(req.headers["user-agent"])) {
		res.set("Content-Type", "application/xhtml+xml; charset=UTF-8");
	} else {
		res.set("Content-Type", "text/html; charset=UTF-8");
	}

	res.send(document);
});

app.use(express.static(path.join(__dirname, "..")));

app.listen(port, () => {
	console.log(`App listening at http://localhost:${port}`);
});
