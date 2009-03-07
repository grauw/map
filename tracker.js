//
// Tracker javascript...
//

// invoke main function immediately
main();

/*
 * Select method depending on capabilities...
 */
function main() {
	if (document.createElementNS && document.getElementById)
		doCreateElementNS();
	else if (document.createElement && document.getElementById)
		doCreateElement();
	else
		doDocumentWrite();
}


/*
 * Approach for very simple browsers
 */
function doDocumentWrite() {
	document.write('<img src="' + makeURL() + '" height="1" width="1" alt="" />');
}


/*
 * Approach for very browsers having DOM support
 */
function doCreateElement() {
	i = document.createElement("img");
	doAppendChild();
}


/*
 * Approach for very browsers having DOM support with namespaces
 */
function doCreateElementNS() {
	i = document.createElementNS("http://www.w3.org/1999/xhtml","img");
	doAppendChild();
}


/*
 * Set the attributes of the created <img> tag and add it to the head.
 */
function doAppendChild() {
	i.setAttribute("src", makeURL());
	i.setAttribute("height", "1");
	i.setAttribute("width", "1");
	i.setAttribute("alt", "");

	document.getElementById("tracker").appendChild(i);
}


/*
 * Create URL parameters for tracker: width, colordepth and referrer.
 */
function makeURL() {
	if (window.screen) {
		EXw = window.screen.width;
		EXb = window.screen.colorDepth;
	} else {
		EXw = "na";
		EXb = "na";
	}

	return "http://t0.extreme-dm.com/c.g?tag=msxasm&amp;j=y&amp;srw=" + EXw
	       + "&amp;srb=" + EXb + "&amp;" + "l=" + window.escape(document.referrer);
}