for (const node of document.getElementsByClassName("email")) {
	var email = `${node.dataset.localPart}@${node.dataset.domain}`;
	var anchor = document.createElement('a');
	anchor.href = `mailto:${email}`;
	anchor.textContent = email;
	node.parentNode.replaceChild(anchor, node);
}
