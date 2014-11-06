<!DOCTYPE html >
<html>  
<head>  
  <title>My Brain Vault</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>
function retrieveAlbums(str) {
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("outputAlbums").innerHTML=xmlhttp.responseText;
		}
	}
		xmlhttp.open("GET","retrieveAlbums.php?q="+str,true);
		xmlhttp.send();
}

function storeAlbum(str) {
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
		xmlhttp.open("GET","insertAlbum.php?q="+str,true);
		xmlhttp.send();
	}
}

function createListeningTo(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	var nodeHeader = document.createElement("h3");
	var text = document.createTextNode("What I'm Listening to Now");
	nodeHeader.appendChild(text);
	nodeDiv.appendChild(nodeHeader);
	var nodeImg = document.createElement("img");
	nodeImg.src="/Albums/220px-Daft_Punk_Alive_2007.jpg";
	nodeDiv.appendChild(nodeImg);
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}

function createSaveAlbums(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm = document.createElement("form");
	var text = document.createTextNode("Enter the URL of the album image: ");
	nodeForm.appendChild(text);
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "albumUrlInput";
	nodeForm.appendChild(nodeInput);
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Save";
	nodeInput.setAttribute("onclick","storeAlbum(albumUrlInput.value)")
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputTest";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.setAttribute("onclick","retrieveAlbums(this.value)");
	nodeInput.value = "Get loaded";
	
	nodeDiv.appendChild(nodeInput);
	
	nodePara = document.createElement("p");
	nodeSpan = document.createElement("span");
	nodeSpan.id = "outputAlbums";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);

	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}
</script>
<body>
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Music</h2>
<br>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createListeningTo(&quot;tempDiv&quot;)">
What I'm Listening to Now</li>
<li class="menuButton" onclick="createSaveAlbums(&quot;tempDiv&quot;)">
Save Albums</li>
</ul>
</div>
<br><br>
<div id="tempDiv"></div>
<br><br>
<!--
<form>
Enter the URL of the album image:<input type="text" id="albumUrlInput"></input><input type="button" value="Save" onclick="storeAlbum(albumUrlInput.value)"></input>
</form>
<p><span id="outputTest"></span></p>
<br>
<h3><input type="button" onclick="retrieveAlbums(this.value)" value="Get loaded"></input></h3>
<p><span id="outputAlbums"></span></p>
<br>
<h3>
What I'm Listening to Now</h3>
<img src="/Albums/220px-Daft_Punk_Alive_2007.jpg" alt="Alive 2007 - Daft Punk"  style="width:250px;height:250px">
<img src="/Albums/220px-Isis_-_In_the_Absence_of_Truth_2.jpg" alt="Alive 2007 - Daft Punk"  style="width:250px;height:250px">
<img src="/Albums/220px-Lamb74.jpg" alt="Alive 2007 - Daft Punk"  style="width:250px;height:250px">
<img src="/Albums/220px-Opeth_-_Watershed.jpg" alt="Alive 2007 - Daft Punk"  style="width:250px;height:250px">
<img src="/Albums/capsule_184x69.jpg" alt="Alive 2007 - Daft Punk">
<br><br>
<p><span id="outputAlbums"></span></p>
-->
</body>
</html>