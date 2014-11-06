<!DOCTYPE html >
<html>  
<head>  
  <title>Game Reviews</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>
function retrieveReviews(str) {
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
		xmlhttp.open("GET","retrieveReviews.php?q="+str,true);
		xmlhttp.send();
	}
}
function createRetrieveReviews(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm = document.createElement("form");
	//var text = document.createTextNode("Enter a URL to save: ");
	//nodeForm.appendChild(text);
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "searchInput";
	nodeForm.appendChild(nodeInput);
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Search";
	nodeInput.onclick = "retrieveLinks(searchInput.value)";
	nodeInput.setAttribute("onclick","retrieveReviews(searchInput.value)");
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.setAttribute("onclick","retrieveReviews()");
	nodeInput.value = "All";
	
	nodeDiv.appendChild(nodeInput);
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputLinks";
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
Game Reviews</h2>
<div class="nav">
<ul id="menuBar">
<li onclick="">
Main</li>
<li onclick="createRetrieveReviews(&quot;tempDiv&quot;)">
Search Reviews</li>
<li onclick="createWriteReview(&quot;tempDiv&quot;)">
Write Review</li>
</ul>
</div>
<br><br>
<nav>
Difficulty<br>
<img src="/GamePictures/4outof5.png"></img><br>
Graphics<br>
<img src="/GamePictures/3outof5.png"></img><br>
Atmosphere<br>
<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;Style<br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;Setting<br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;Sound<br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
Story<br>
<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;Pacing<br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;Narrative<br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;Consistency<br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;Literary merit<br>
&emsp;&emsp;<img src="/GamePictures/1outof5.png"></img><br>
&emsp;&emsp;Characters<br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
<br>
Engine<br>
<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;Physics<br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;Latency<br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
<br>
Systems<br>
<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;UI<br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;Progress<br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
Gameplay<br>
<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;AI<br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
Originality<br>
<img src="/GamePictures/4outof5.png"></img><br>
As Promised<br>
<img src="/GamePictures/0outof5.png"></img><br>
Impact<br>
<img src="/GamePictures/0outof5.png"></img><br>
Value<br>
<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;Dollars<br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;Time<br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;Brainfood<br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
</nav>
<div id="tempDiv">
<h3 style="text-align: center;">Sequence Review</h3>
<img src="/GamePictures/header.jpg"></img>
<p>
Difficulty<br>
4/5: Played on hard. Played way too much Guitar Hero and this was still substantially difficult for me. Pacing of the difficulty was eerily good. Made me feel satisfied to beat the game. 
</p>
<p>
Graphics<br>
3/5: They are fine for the price point and the genre.
</p>
<p>
Atmosphere<br>
2/5: Was ok. Kind of annoying.<br>
&emsp;Style<br>
&emsp;2/5: Was ok, kind of annoying.<br>
&emsp;Setting<br>
&emsp;2/5: Simple, pretty repetitive.<br>
&emsp;Sound<br>
&emsp;3/5: Songs were pretty cool.<br>
</p>
<p>
Story<br>
2/5: Not much to see here. Was acceptible.<br>
&emsp;Pacing<br>
&emsp;3/5: Was fine.<br>
&emsp;Narrative<br>
&emsp;2/5: Chat boxes.<br>
&emsp;Consistency (with the series)<br>
&emsp;<i>N/A</i><br>
&emsp;Literary merit<br>
&emsp;1/5: Not much. Touches on love and stuff but not significantly.<br>
&emsp;Characters<br>
&emsp;2/5: Annoying in my opinion.<br>
</p>
<p>

</p>
<p>
Engine<br>
3/5: The game worked.<br>
&emsp;Physics<br>
&emsp;<i>N/A</i><br>
&emsp;Latency<br>
&emsp;<i>N/A</i><br>
</p>
<p>
Systems<br>
<i>N/A</i><br>
&emsp;UI<br>
&emsp;3/5: Was ok. Battles were clean and made sense. Inventory stuff was kind of ugh.<br>
&emsp;Progress<br>
&emsp;3/5: Got new attacks over time that did different stuff in battle, and required more complex inputs. Was pretty cool.<br>
</p>
<p>
Gameplay<br>
4/5: This is what the game is really about. Having the three panels at once was very cool. Combining that concept with an rpg battle also made sense and was quite smart. Gives a twist to the step game formula that gives you something new to master. Battling against an enemy made the game more than just memorization: you have to react to an opponent, which adds another layer to the step game formula which would be great to see more of.<br>
&emsp;AI<br>
&emsp;3/5: Worked. Made game a good difficulty. Not much variation at all.<br>
</p>
<p>
Originality<br>
4/5: Added not only the triple pane concept but also the rpg battle concept to step games, making the game both harder and now interactive. This advances the step game genre above strictly memorization and makes improvisation and analysis a skill in the genre. This should be in more games.<br>
</p>
<p>
As Promised<br>
<i>N/A</i><br>
</p>
<p>
(Historical) Impact<br>
I hope step games takes these concepts and uses them to make step games more interesting.<br>
</p>
<p>
Value<br>
&emsp;Dollars<br>
&emsp;4/5: 5 bucks. If you want to play a step game and you havea  computer this is a slam dunk.<br>
&emsp;Time<br>
&emsp;4/5: Got like 12 hours of gameplay out of it. Still another difficulty to play. For the price this is great.<br>
&emsp;Brainfood<br>
&emsp;4/5: Shows a great idea of how step games can evolve. A pioneer that deserves mroe attention.<br>
</p>
</div>

<footer>Testing</footer>
</body>
</html>