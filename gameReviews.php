<!DOCTYPE html >
<html>  
<head>  
  <title>Game Reviews</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>
var difficultyReview=["Difficulty","4/5: Played on hard. Played way too much Guitar Hero and this was still substantially difficult for me. Pacing of the difficulty was eerily good. Made me feel satisfied to beat the game."];
var graphicsReview=["Graphics","3/5: They are fine for the price point and the genre."];
var atmosphereReview=["Atmosphere","2/5: Was ok. Kind of annoying."];
var atmosphereStyleReview=["Atmosphere: Style","2/5: Was ok, kind of annoying."];
var atmosphereSettingReview=["Atmosphere: Setting","2/5: Simple, pretty repetitive."];
var atmosphereSoundReview=["Atmosphere: Sound","3/5: Songs were pretty cool."];
var storyReview=["Story","2/5: Not much to see here. Was acceptible."];
var storyPacingReview=["Story: Pacing","3/5: Was fine."];
var storyNarrativeReview=["Story: Narrative","2/5: Chat boxes."];
var storyConsistencyReview=["Story: Consistency","N/A"];
var storyLiterarymeritReview=["Story: Literary Merit","1/5: Not much. Touches on love and stuff but not significantly."];
var storyCharactersReview=["Story: Characters","2/5: Annoying in my opinion."];
var engineReview=["Engine","3/5: The game worked."];
var enginePhysicsReview=["Engine: Physics","N/A"];
var engineLatencyReview=["Engine: Latency","N/A"];
var systemsReview=["Systems","N/A"];
var systemsUiReview=["Systems: UI","3/5: Was ok. Battles were clean and made sense. Inventory stuff was kind of ugh."];
var systemsProgressReview=["Systems: Progress","3/5: Got new attacks over time that did different stuff in battle, and required more complex inputs. Was pretty cool."];
var gameplayReview=["Gameplay","4/5: This is what the game is really about. Having the three panels at once was very cool. Combining that concept with an rpg battle also made sense and was quite smart. Gives a twist to the step game formula that gives you something new to master. Battling against an enemy made the game more than just memorization: you have to react to an opponent, which adds another layer to the step game formula which would be great to see more of."];
var gameplayAiReview=["Gameplay: AI","3/5: Worked. Made game a good difficulty. Not much variation at all."];
var originalityReview=["Originality","4/5: Added not only the triple pane concept but also the rpg battle concept to step games, making the game both harder and now interactive. This advances the step game genre above strictly memorization and makes improvisation and analysis a skill in the genre. This should be in more games."];
var aspromisedReview=["As Promised","N/A"];
var historicalImpact=["Historical Impact","I hope step games takes these concepts and uses them to make step games more interesting."];
var valueReview=["Value","4/5"];
var valueDollarsReview=["Value: Dollars","4/5: 5 bucks. If you want to play a step game and you have a computer this is a slam dunk."];
var valueTimeReview=["Value: Time","4/5: Got like 12 hours of gameplay out of it. Still another difficulty to play. For the price this is great."];
var valueBrainfoodReview=["Value: Brainfood","4/5: Shows a great idea of how step games can evolve. A pioneer that deserves more attention."];

var metrics;

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
function createMainReview(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var text;
	var nodeHeader = document.createElement("h3");
	text = document.createTextNode("Sequence Review");
	nodeHeader.appendChild(text);
	nodeHeader.setAttribute("style","text-align: center;");
	
	nodeDiv.appendChild(nodeHeader);
	
	var nodeImage = document.createElement("img");
	nodeImage.setAttribute("src","/GamePictures/header.jpg");
	
	nodeDiv.appendChild(nodeImage);
	
	var nodePara = document.createElement("p");
	nodePara.id = "reviewSection";
	
	nodeDiv.appendChild(nodePara);
	
	
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
	
	
	
	//<h3 style="text-align: center;">Sequence Review</h3>
	//<img src="/GamePictures/header.jpg"></img>
}
function populateReview(id,metric) {
	var nodePara = document.createElement("p");
	nodePara.id=id;
	var text = document.createTextNode(eval(metric + "[0]"));
	nodePara.appendChild(text);
	nodePara.appendChild(document.createElement("br"));nodePara.appendChild(document.createElement("br"));
	text = document.createTextNode(eval(metric + "[1]"));
	nodePara.appendChild(text);
	
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodePara,replaced);
	
}
function createWriteReview(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm;
	var nodeInput;
	var text;
	
	nodeForm = document.createElement("form");
	text = document.createTextNode("Enter game title: ");
	nodeForm.appendChild(text);
	nodeInput = document.createElement("input");
	nodeInput.type= "text";
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodeForm = document.createElement("form");
	var text = document.createTextNode("Enter the URL of the game image: ");
	nodeForm.appendChild(text);
	var nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "gameImageUrlInput";
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	text = document.createTextNode("Select metrics to review:");
	nodeDiv.appendChild(text);
	nodeDiv.appendChild(document.createElement("br"));nodeDiv.appendChild(document.createElement("br"));
	
	var nodeForm = document.createElement("form");
	var nodeInput;
	var text;
	nodeInput = document.createElement("input");
	nodeInput.type = "checkbox";
	//nodeInput.name = "metric";
	nodeInput.value = "All";
	nodeInput.setAttribute("onclick","checkAll(this)");
	nodeForm.appendChild(nodeInput);
	text = document.createTextNode("All");
	nodeForm.appendChild(text);
	nodeForm.appendChild(document.createElement("br"));
	nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Difficulty");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Graphics");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Atmosphere");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Atmosphere: Style");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Atmosphere: Setting");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Atmosphere: Sound");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story: Pacing");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story: Narrative");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story: Consistency");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story: Literary Merit");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Story: Characters");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Engine");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Engine: Physics");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Engine: Latency");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Systems");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Systems: UI");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Systems: Progress");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Gameplay");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Gameplay: AI");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Originality");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"As Promised");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Impact");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Value");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Value: Dollars");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Value: Time");nodeForm.appendChild(document.createElement("br"));
	createWriteReviewMetricCheckbox(nodeForm,"Value: Brainfood");nodeForm.appendChild(document.createElement("br"));
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeForm = document.createElement("form");
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Submit";
	nodeInput.onclick = 'createFillinMetrics("tempDiv")';
	nodeInput.setAttribute("onclick",'createFillinMetrics("tempDiv")');
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	

	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}
function createWriteReviewMetricCheckbox(nodeForm,metricName) {
	var nodeInput;
	var text;
	nodeInput = document.createElement("input");
	nodeInput.type = "checkbox";
	nodeInput.name = "metric";
	nodeInput.value = metricName;
	nodeForm.appendChild(nodeInput);
	text = document.createTextNode(metricName);
	nodeForm.appendChild(text);
}
/*function createWriteReviewDifficulty(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeTextarea = document.createElement("textarea");
	nodeTextarea.rows = 20;
	nodeTextarea.cols = 50;
	
	nodeDiv.appendChild(nodeTextarea);

	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}*/
function createFillinMetrics(id) {
	var checkboxes = document.getElementsByName("metric");
	metrics = new Array();
	var metric;
	for(var i=0, n=checkboxes.length;i < n; i++) {
		if(checkboxes[i].checked) {
			metricI = new Object();
			metricI.value = checkboxes[i].value;
			metricI.stars = 0;
			metrics.push(metricI);
		}
	}
	
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeTextarea;
	var nodePara;
	var nodeForm;
	var nodeInput;
	var nodeImage;
	var text;
	
	nodeForm = document.createElement("form");
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Submit";
	nodeInput.onclick = 'saveReview()';
	nodeInput.setAttribute("onclick",'saveReview()');
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodePara = document.createElement("p");
	nodePara.id = "outputTest";
	
	nodeDiv.appendChild(nodePara);
	nodeDiv.appendChild(document.createElement("br"));
	
	for(var iEveryMetric=0, n=metrics.length;iEveryMetric < n; iEveryMetric++) {
		nodePara = document.createElement("p");
		text = document.createTextNode(metrics[iEveryMetric].value);
		nodePara.appendChild(text);
		
		nodeDiv.appendChild(nodePara);
		
		nodeImage = document.createElement("img");
		nodeImage.id = "imageStar"+metrics[iEveryMetric].value;
		nodeImage.src = "";
		
		nodeDiv.appendChild(nodeImage);
		
		nodeForm = document.createElement("form");
		//nodeForm.id = metrics[iEveryMetric].value;
		//nodeForm.setAttribute("data-stars",0);
		for(var iEveryButton=0; iEveryButton<6; iEveryButton++) {
			nodeInput = document.createElement("input");
			nodeInput.type = "button";
			nodeInput.value = iEveryButton;
			nodeInput.setAttribute("data-metric",metrics[iEveryMetric].value);
			nodeInput.setAttribute("onclick","changeStars(this.dataset.metric,this.value)");
			nodeInput.id = "buttonStar"+metrics[iEveryMetric].value;
			nodeForm.appendChild(nodeInput);
		}
		
		nodeDiv.appendChild(nodeForm);
		nodeDiv.appendChild(document.createElement("br"));
		
		nodeTextarea = document.createElement("textarea");
		nodeTextarea.name = "metric";
		nodeTextarea.id = metrics[iEveryMetric].value;
		nodeTextarea.setAttribute("data-stars",0);
		nodeTextarea.rows = 20;
		nodeTextarea.cols = 50;
		
		nodeDiv.appendChild(nodeTextarea);
	}
	
	nodeDiv.appendChild(document.createElement("br"));nodeDiv.appendChild(document.createElement("br"));
	
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}
function saveReview(str) {
	var submittString = "";
	var textAreaS = document.getElementsByName("metric");
	for(var i=0, n=textAreaS.length;i < n; i++) {
		submittString = submittString + "/";
		submittString = submittString + textAreaS[i].value;
		submittString = submittString + "&" + textAreaS[i].dataset.stars;
	}
	
	submittReview(submittString);
}
function submittReview(str) {
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
		xmlhttp.open("POST","submittReview.php",true);
		xmlhttp.send(str);
		//createWebsitePreview("tempDiv",str);
	}
}
function changeStars(metric,rating) {
	//Stars data is stored on the form (the form which contains the "set star" buttons)
	var nodeFormS = document.getElementById(metric);
	nodeFormS.dataset.stars = rating;
	
	var nodeImage = document.getElementById("imageStar"+metric);
	if(rating==0)
		nodeImage.src = "";//"/GamePictures/0outof5.png"
	if(rating==1)
		nodeImage.src = "/GamePictures/1outof5.png";
	if(rating==2)
		nodeImage.src = "/GamePictures/2outof5.png";
	if(rating==3)
		nodeImage.src = "/GamePictures/3outof5.png";
	if(rating==4)
		nodeImage.src = "/GamePictures/4outof5.png";
	if(rating==5)
		nodeImage.src = "/GamePictures/5outof5.png";
}
function printFiveStars(parento,stars) {
	var nodeImage = document.createElement("img");
	if(stars==0)
		nodeImage.src = "/GamePictures/0outof5.png";
	if(stars==1)
		nodeImage.src = "/GamePictures/1outof5.png";
	if(stars==2)
		nodeImage.src = "/GamePictures/2outof5.png";
	if(stars==3)
		nodeImage.src = "/GamePictures/3outof5.png";
	if(stars==4)
		nodeImage.src = "/GamePictures/4outof5.png";
	if(stars==5)
		nodeImage.src = "/GamePictures/5outof5.png";
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(parento,replaced);
}
function checkAll(source) {
	var checkboxes = document.getElementsByName("metric");
	for(var i=0, n=checkboxes.length;i < n; i++) {
		checkboxes[i].checked = source.checked;
	}
}
function scrollToTop() {
	window.scrollTo(0,0);
}
</script>
<body>
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Game Reviews</h2>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createMainReview(&quot;tempDiv&quot;)">
Main</li>
<li class="menuButton" onclick="createRetrieveReviews(&quot;tempDiv&quot;)">
Search Reviews</li>
<li class="menuButton" onclick="createWriteReview(&quot;tempDiv&quot;)">
Write Review</li>
</ul>
</div>
<br><br>
<nav>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;difficultyReview&quot;)">Difficulty</span><br>
<img src="/GamePictures/4outof5.png"></img><br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;graphicsReview&quot;)">Graphics</span><br>
<img src="/GamePictures/3outof5.png"></img><br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;atmosphereReview&quot;)">Atmosphere</span><br>
<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;atmosphereStyleReview&quot;)">Style</span><br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;atmosphereSettingReview&quot;)">Setting</span><br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;atmosphereSoundReview&quot;)">Sound</span><br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyReview&quot;)">Story</span><br>
<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyPacingReview&quot;)">Pacing</span><br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyNarrativeReview&quot;)">Narrative</span><br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyConsistencyReview&quot;)">Consistency</span><br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyLiterarymeritReview&quot;)">Literary merit</span><br>
&emsp;&emsp;<img src="/GamePictures/1outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;storyCharactersReview&quot;)">Characters</span><br>
&emsp;&emsp;<img src="/GamePictures/2outof5.png"></img><br>
<br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;engineReview&quot;)">Engine</span><br>
<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;enginePhysicsReview&quot;)">Physics</span><br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;engineLatencyReview&quot;)">Latency</span><br>
&emsp;&emsp;<img src="/GamePictures/0outof5.png"></img><br>
<br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;systemsReview&quot;)">Systems</span><br>
<img src="/GamePictures/0outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;systemsUiReview&quot;)">UI</span><br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;systemsProgressReview&quot;)">Progress</span><br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;gameplayReview&quot;)">Gameplay</span><br>
<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;gameplayAiReview&quot;)">AI</span><br>
&emsp;&emsp;<img src="/GamePictures/3outof5.png"></img><br>
<br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;originalityReview&quot;)">Originality</span><br>
<img src="/GamePictures/4outof5.png"></img><br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;aspromisedReview&quot;)">As Promised</span><br>
<img src="/GamePictures/0outof5.png"></img><br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;historicalImpact&quot;)">Impact</span><br>
<img src="/GamePictures/0outof5.png"></img><br>
<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;valueReview&quot;)">Value</span><br>
<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;valueDollarsReview&quot;)">Dollars</span><br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;valueTimeReview&quot;)">Time</span><br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
&emsp;&emsp;<span style="cursor:pointer;" onclick="scrollToTop();populateReview(&quot;reviewSection&quot;,&quot;valueBrainfoodReview&quot;)">Brainfood</span><br>
&emsp;&emsp;<img src="/GamePictures/4outof5.png"></img><br>
</nav>
<div id="tempDiv">
<h3 style="text-align: center;">Sequence Review</h3>
<img src="/GamePictures/header.jpg"></img>
<p id="reviewSection"></p>
</div>

<footer>Testing</footer>
</body>
</html>