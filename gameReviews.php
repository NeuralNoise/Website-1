<!DOCTYPE html >
<html>  
<head>  
  <title>Game Reviews</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>
//Globals
var metrics;	
var reviewData = "unpopulated";	//Array. Holds game review data retrieved from file. First two elements are Game Title, Game Image. The rest are the metrics in descending order

function retrieveReviews(str) {
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var pos = xmlhttp.responseText.indexOf("]["); document.getElementById("outputLinks").innerHTML=xmlhttp.responseText.slice(0,pos);
			var processData;
			processData = xmlhttp.responseText.slice(pos+2);
			if(processData.slice(0,2) == "~~") {
				var passString = processData.slice(2);
				processReviewData(passString);
				//createNav();
			}
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
	nodeInput.setAttribute("onsubmit","retrieveReviews(searchInput.value)");
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
	nodeInput.setAttribute("onclick","retrieveReviewsAll()");
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
function retrieveReviewsAll() {
	var nodeSpan = document.createElement("span");
	nodeSpan.appendChild(document.createElement("br"));
	
	var nodeForm = document.createElement("form");
	
	var nodeInput;
	var alphabetString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for(var i=0, l=alphabetString.length; i<l; i++) {
		nodeInput = document.createElement("input");
		nodeInput.type = "button";
		nodeInput.value = alphabetString.charAt(i);
		nodeForm.appendChild(nodeInput);
	}
	
	nodeSpan.appendChild(nodeForm);
	
	var replaced = document.getElementById("outputLinks");
	replaced.parentNode.replaceChild(nodeSpan,replaced);
}
function createMainReview(id) {
//If no review loaded, the main page wont work because reviewData wont be loaded and will crash the function
//FIXED
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var text;
	var nodeHeader = document.createElement("h3");
	if(reviewData !== "unpopulated") {
		text = document.createTextNode(reviewData[0].metric + " Review");
		nodeHeader.appendChild(text);
	}
	nodeHeader.setAttribute("style","text-align: center;");
	
	nodeDiv.appendChild(nodeHeader);
	
	var nodeImage = document.createElement("img");
	if(reviewData !== "unpopulated") {
		nodeImage.setAttribute("src","/GamePictures/" + reviewData[1].metric + ".jpg");
	}
	
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
	undoBorder();

	createMainReview("tempDiv");

	var index = findIndexbyMetric(metric);
	
	var nodePara = document.createElement("p");
	nodePara.id=id;
	var text = document.createTextNode(eval("reviewData[" + index + "].metric"));
	nodePara.appendChild(text);
	nodePara.appendChild(document.createElement("br"));nodePara.appendChild(document.createElement("br"));
	text = document.createTextNode(eval("reviewData[" + index + "].text"));
	nodePara.appendChild(text);
	nodePara.setAttribute("data-metric",metric);
	
	var replaced = document.getElementById(id);
	replaced.parentNode.replaceChild(nodePara,replaced);
	
	
	var nodeDiv = document.getElementById("div" + metric);
	nodeDiv.setAttribute("style","border-style: groove;");
	var test;
}
function createWriteReview(id) {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeForm;
	var nodeInput;
	var text;
	
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
	
	metricI = new Object();
	metricI.value = "Overall";
	metricI.check = true;
	metricI.stars = 0;
	metrics.push(metricI);
	for(var i=0, n=checkboxes.length;i < n; i++) {
		metricI = new Object();
		metricI.value = checkboxes[i].value;
		if(checkboxes[i].checked)
			metricI.check = true;
		else
			metricI.check = false;
		metricI.stars = 0;
		metrics.push(metricI);
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
	nodeInput.setAttribute("onclick",'saveReview()');
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodePara = document.createElement("p");
	nodePara.id = "outputTest";
	
	nodeDiv.appendChild(nodePara);
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeForm = document.createElement("form");
	text = document.createTextNode("Enter game title: ");
	nodeForm.appendChild(text);
	nodeInput = document.createElement("input");
	nodeInput.type = "text";
	nodeInput.id = "gameTitleInput";
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
	
	//Input for overall score
	nodePara = document.createElement("p");
	text = document.createTextNode(metrics[0].value);
	nodePara.appendChild(text);
	
	nodeDiv.appendChild(nodePara);
	
	nodeImage = document.createElement("img");
	nodeImage.id = "imageStar"+metrics[0].value;
	nodeImage.src = "/GamePictures/0outof10.png";
	
	nodeDiv.appendChild(nodeImage);
	
	nodeForm = document.createElement("form");
	//nodeForm.id = metrics[0].value;
	//nodeForm.setAttribute("data-stars",0);
	for(var iEveryButton=0; iEveryButton<11; iEveryButton++) {
		nodeInput = document.createElement("input");
		nodeInput.type = "button";
		nodeInput.value = iEveryButton;
		nodeInput.setAttribute("data-metric",metrics[0].value);
		nodeInput.setAttribute("onclick","changeStars(this.dataset.metric,this.value)");
		nodeInput.id = "buttonStar"+metrics[0].value;
		nodeForm.appendChild(nodeInput);
	}
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeTextarea = document.createElement("textarea");
	nodeTextarea.name = "metric";
	nodeTextarea.id = metrics[0].value;
	nodeTextarea.setAttribute("data-stars",0);
	nodeTextarea.rows = 20;
	nodeTextarea.cols = 50;
	
	nodeDiv.appendChild(nodeTextarea);
		
	nodeDiv.appendChild(document.createElement("br"));nodeDiv.appendChild(document.createElement("br"));
	
	//Create the input for each metric (overall score has already been processed)
	for(var iEveryMetric=1, n=metrics.length;iEveryMetric < n; iEveryMetric++) {
		if (metrics[iEveryMetric].check == false)
			continue;
			
		nodePara = document.createElement("p");
		text = document.createTextNode(metrics[iEveryMetric].value);
		nodePara.appendChild(text);
		
		nodeDiv.appendChild(nodePara);
		
		nodeImage = document.createElement("img");
		nodeImage.id = "imageStar"+metrics[iEveryMetric].value;
		nodeImage.src = "/GamePictures/0outof5.png";
		
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
function saveReview() {
	var ch29 = String.fromCharCode(29);
	var ch30 = String.fromCharCode(30);
	var submittString = "";
	var gameTitle = document.getElementById("gameTitleInput");
	submittString = gameTitle.value;
	var gameImage = document.getElementById("gameImageUrlInput");
	submittString = submittString + ch29 + gameImage.value;
	
	var textAreaS = document.getElementsByName("metric");
	for(var iEveryMetric=0, n=metrics.length;iEveryMetric < n; iEveryMetric++) {
		submittString = submittString + ch29 + metrics[iEveryMetric].value;
		if(metrics[iEveryMetric].check == true) {
			for(var iEveryTextarea=0; iEveryTextarea<textAreaS.length; iEveryTextarea++) {
				if(metrics[iEveryMetric].value == textAreaS[iEveryTextarea].id) {
					submittString = submittString + ch30 + textAreaS[iEveryTextarea].value;
					submittString = submittString + ch30 + textAreaS[iEveryTextarea].dataset.stars;
				}
			}
		}
		else
			submittString = submittString + ch30 + ch30 + "0";
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
	if(metric == "Overall")
		nodeImage.src = "/GamePictures/" + rating + "outof10.png";
	else
		nodeImage.src = "/GamePictures/" + rating + "outof5.png";
	/*
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
	*/
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
function processReviewData(processData) {
	var ch29 = String.fromCharCode(29);
	var ch30 = String.fromCharCode(30);
	
	processData = processData.split(ch29);
	var tempArray = new Array();
	var tempData;
	var metricData;
	for(var iEveryMetric=0, n=processData.length-1;iEveryMetric<n;iEveryMetric++) {	//the -1 in length skips the last element, which is a waste element
		metricData = new Object();
		tempData = processData[iEveryMetric].split(ch30);
		metricData.metric = tempData[0];
		metricData.text = tempData[1];
		metricData.stars = tempData[2];
		tempArray.push(metricData);
	}
	reviewData = tempArray;
}
function createNav() {
	var nodeNav = document.createElement("nav");
	nodeNav.id = "sidebar";
	
	var nodeDiv;
	var nodeSpan;
	var nodeImage;
	var text;
	
	nodeDiv = document.createElement("div");
	nodeDiv.id = "div" + reviewData[2].metric;
	
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute('style',"cursor:pointer");
	nodeSpan.setAttribute('onclick','scrollToTop();populateReview("reviewSection","' + reviewData[2].metric + '")');
	text = document.createTextNode(reviewData[2].metric);
	nodeSpan.appendChild(text);
	nodeDiv.appendChild(nodeSpan);
	
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeImage = document.createElement("img");
	nodeImage.src = "/GamePictures/" + reviewData[2].stars + "outof10.png";
	nodeDiv.appendChild(nodeImage);
	
	nodeNav.appendChild(nodeDiv);
	
	nodeDiv.appendChild(document.createElement("br"));nodeDiv.appendChild(document.createElement("br"));
	
	var n = reviewData.length;
	//for every metric in reviewData...
	for(var iEveryMetric=3; iEveryMetric<n; iEveryMetric++) {
		nodeDiv = document.createElement("div");
		nodeDiv.id = "div" + reviewData[iEveryMetric].metric;
		
		nodeSpan = document.createElement("span");
		nodeSpan.setAttribute('style',"cursor:pointer");
		nodeSpan.setAttribute('onclick','scrollToTop();populateReview("reviewSection","' + reviewData[iEveryMetric].metric + '")');
		text = document.createTextNode(reviewData[iEveryMetric].metric);
		nodeSpan.appendChild(text);
		nodeDiv.appendChild(nodeSpan);
		
		nodeDiv.appendChild(document.createElement("br"));
		
		nodeImage = document.createElement("img");
		nodeImage.src = "/GamePictures/" + reviewData[iEveryMetric].stars + "outof5.png";
		nodeDiv.appendChild(nodeImage);
		
		nodeDiv.appendChild(document.createElement("br"));
		//text = document.createTextNode('&emsp;&emsp;');
		//nodeDiv.appendChild(text);
		
		nodeNav.appendChild(nodeDiv);
	}

	
	var replaced = document.getElementById("sidebar");
	replaced.parentNode.replaceChild(nodeNav,replaced);
}
function undoBorder() {
	var nodePara = document.getElementById("reviewSection");
	if(nodePara == null)
		return;
	var tempStr = nodePara.dataset.metric;

	nodeDiv = document.getElementById("div" + tempStr);
	nodeDiv.setAttribute("style","");
}
function createMainPage() {
	var nodeNav = document.createElement("nav");
	nodeNav.id = "sidebar";
	
	var nodeSpan;
	var nodeImage;
	var text;
	
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute('style',"cursor:pointer");
	//nodeSpan.setAttribute('onclick','scrollToTop();populateReview("reviewSection","' + reviewData[iEveryMetric].metric + '")');
	text = document.createTextNode("News");
	nodeSpan.appendChild(text);
	nodeNav.appendChild(nodeSpan);
	
	nodeNav.appendChild(document.createElement("br"));
	
	nodeImage = document.createElement("img");
	nodeNav.appendChild(nodeImage);
	
	nodeNav.appendChild(document.createElement("br"));
	
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute('style',"cursor:pointer");
	//nodeSpan.setAttribute('onclick','scrollToTop();populateReview("reviewSection","' + reviewData[iEveryMetric].metric + '")');
	text = document.createTextNode("Stats");
	nodeSpan.appendChild(text);
	nodeNav.appendChild(nodeSpan);
	
	nodeNav.appendChild(document.createElement("br"));
	//text = document.createTextNode('&emsp;&emsp;');
	//nodeNav.appendChild(text);
	
	nodeImage = document.createElement("img");
	nodeNav.appendChild(nodeImage);
	
	nodeNav.appendChild(document.createElement("br"));
	
	var replaced = document.getElementById("sidebar");
	replaced.parentNode.replaceChild(nodeNav,replaced);
	
	
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodePara;
	
	nodePara = document.createElement("p");
	text = document.createTextNode("Welcome to a front page");
	nodePara.appendChild(text);
	nodeDiv.appendChild(nodePara);
	
	var replaced = document.getElementById("tempDiv");
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}
function findIndexbyMetric(metric) {
	var n = reviewData.length;
	for(var i=2; i<n; i++) {
		if(reviewData[i].metric == metric)
			return i;
	}
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
<body onpageshow="createMainPage()">
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Game Reviews</h2>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createMainPage()">
Main</li>
<li class="menuButton" onclick="createRetrieveReviews(&quot;tempDiv&quot;)">
Search Reviews</li>
<li class="menuButton" onclick="createWriteReview(&quot;tempDiv&quot;)">
Write Review</li>
</ul>
</div>
<br><br>
<nav id="sidebar">

</nav>
<div id="tempDiv">

</div>

<footer>Testing</footer>
</body>
</html>