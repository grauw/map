/**
 * Email address link javascript     (by Grauw)
 * =============================
 * Using standard DOM methods working in an XHTML environment.
 *
 * Usage:
 * - Fill in your email address in the variable 'eml' below
 * - Put a tag with class="myemail" where you want the link
 * - Add onload="putEmail(['<mailbox>','<domain>']);" to your &lt;body&gt; tag
 */

/**
 * Replaces all spans with class 'myemail' with an email address constructed from the provided array.
 * @param email An array with two elements, corresponding to the part before and after the @ in an email-address.
 */
function putEmail() {
	var aNodes = document_getElementsByTagNameNS('http://www.grauw.nl/g', 'insertMail', 'g');
	for (var i=0; i < aNodes.length; i++) {
		var oNode = aNodes[i];
		var sEmail = oNode.getAttribute('local-part') + '@' + oNode.getAttribute('domain');
		var oAnchor = document.createElement('a');
		oAnchor.setAttribute('href', 'mailto:' + sEmail);
		oAnchor.appendChild(document.createTextNode(sEmail));
		oNode.parentNode.replaceChild(oAnchor, oNode);
	}
}

/**
 * Ugly cross-browser getElementsByTagNameNS wrapper
 */
function document_getElementsByTagNameNS(sNamespace, sLocalName, sPrefix) {
	if (document.getElementsByTagNameNS)
		return document.getElementsByTagNameNS(sNamespace, sLocalName);
	else if (window.ActiveXObject)
		return document.getElementsByTagName(sLocalName);
	else
		return document.getElementsByTagName(sPrefix + ':' + sLocalName);
}