<!DOCTYPE html >
<html>  
<head>  
  <title>Website Database</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>

function retrieveLinks(str) {
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("outputLinks").innerHTML=xmlhttp.responseText;
		}
	}
	if(str !== "") {
		xmlhttp.open("GET","retrieveLinks.php?q="+str,true);
		xmlhttp.send();
	}
}

function retrieveLinksAll(str) {
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("outputLinks").innerHTML=xmlhttp.responseText;
		}
	}
	if(str === void(0)) {
		str = '';
	}
	xmlhttp.open("GET","retrieveLinks.php?q="+str,true);
	xmlhttp.send();
}

function storeLink(str) {
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("outputTest").innerHTML=xmlhttp.responseText;
		}
	}
	if(str !== "") {
		xmlhttp.open("GET","insertLink.php?q="+str,true);
		xmlhttp.send();
		createWebsitePreview("tempDiv",str);
	}
}

function storeKeyword(kwd,website) {
	//Hold retrieved keywords in a local array

	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("keywordOutput").innerHTML=xmlhttp.responseText;
		}
	}
	if(website !== "") {
		xmlhttp.open("GET","insertKeyword.php?q="+kwd+"&r="+website,true);
		xmlhttp.send();
	}
	
	document.getElementById("keywordInput").value="";
}

function deleteKeyword(kwd,website) {
	//Hold retrieved keywords in a local array
	
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("keywordOutput").innerHTML=xmlhttp.responseText;
		}
	}
	if(website !== "") {
		xmlhttp.open("GET","deleteKeyword.php?q="+kwd+"&r="+website,true);
		xmlhttp.send();
	}
	
	document.getElementById("keywordInput").value="";

}

function createRetrieveWebsites(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm = document.createElement("form");
	//var text = document.createTextNode("Enter a URL to save: ");
	//nodeForm.appendChild(text);
	nodeForm.autocomplete="off";
	nodeForm.setAttribute("onSubmit","if(gel('searchInput').value == '') return false;");
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "searchInput";
	nodeForm.appendChild(nodeInput);
	//var nodeButton = document.createElement("button");
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Search";
	//text = document.createTextNode("Search");
	//nodeButton.appendChild(text);
	//nodeButton.type = "submit";
	nodeInput.onclick = "retrieveLinks(searchInput.value)";
	nodeInput.setAttribute("onclick","retrieveLinks(searchInput.value)");
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.setAttribute("onclick","retrieveLinksAll()");
	nodeInput.value = "All";
	
	nodeDiv.appendChild(nodeInput);
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputLinks";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
	
	
	//retrieveLinks();
}

function createSaveWebsite(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm = document.createElement("form");
	var text = document.createTextNode("Enter a URL to save: ");
	nodeForm.appendChild(text);
	nodeForm.autocomplete="off";
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "urlInput";
	nodeForm.appendChild(nodeInput);
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Save";
	nodeInput.onclick = "storeLink(urlInput.value)";
	nodeInput.setAttribute("onclick","storeLink(urlInput.value)");
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputTest";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	

	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}

function createWebsitePreview(id, website) {
	website = String(website);
	id = String(id);

	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm = document.createElement("form");
	var text = document.createTextNode("Enter a keyword to index for this site: ");
	nodeForm.appendChild(text);
	nodeForm.autocomplete="off";
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "keywordInput";
	nodeForm.appendChild(nodeInput);
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Save";
	nodeInput.setAttribute("onclick","storeKeyword(keywordInput.value,\"".concat(website, "\")"));
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodeForm = document.createElement("form");
	nodeForm.id = "deleteSelect";
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Delete Keyword";
	nodeInput.setAttribute("onclick","createDeleteKeyword(\"" + website + "\")");
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "keywordOutput";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodeIFrame = document.createElement("iframe");
	nodeIFrame.src = website;
	nodeIFrame.width = document.body.clientWidth;
	nodeIFrame.height = 500;//document.body.clientHeight;
	var text = document.createTextNode(document.body.clientHeight);
	nodeIFrame.appendChild(text);
	
	nodeDiv.appendChild(nodeIFrame);
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
	
	
}

function createDeleteKeyword(website) {
	var nodeForm = document.createElement("form");
	var text = document.createTextNode("Enter a keyword to delete: ");
	nodeForm.appendChild(text);
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "keywordDeleteInput";
	nodeForm.appendChild(nodeInput);
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Delete";
	nodeInput.setAttribute("onclick","deleteKeyword(keywordDeleteInput.value,\"" + website + "\")");
	nodeForm.appendChild(nodeInput);
	
	var replaced = document.getElementById("deleteSelect");
	replaced.parentNode.replaceChild(nodeForm,replaced);
}

function goHome() {
	
}

function gel(id) {
	return document.getElementById(id);
}
</script>
<body>
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Website Database</h2>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createRetrieveWebsites(&quot;tempDiv&quot;)">
Retrieve Websites</li>
<li class="menuButton" onclick="createSaveWebsite(&quot;tempDiv&quot;)">
Save Website</li>
</ul>
</div>
<br><br>
<div id="tempDiv"></div>
<!-- Website, Keyword, First/Second/Third Degree, Authority, -->
</body>
</html>