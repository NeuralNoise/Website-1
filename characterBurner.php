<!DOCTYPE html >
<html>  
<head>  
  <title>Character Burner</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>
var newCharacter = {born:""};

var bornPaths = [{title:"Peasent Born", time:8, resources:3, stats:"-", leads:"5/6/7/8", skillPoints:"3/0", skills:"-", traitPoints:2, traits:"-"},
				{title:"Village Born", time:10, resources:4, stats:"-", leads:"0/5/7/8", skillPoints:"3/0", skills:"-", traitPoints:2, traits:"-"},
				{title:"City Born", time:12, resources:10, stats:"-", leads:"3/4/8/9", skillPoints:"4/0", skills:"-", traitPoints:1, traits:"-"},
				{title:"Noble Born", time:8, resources:15, stats:"-", leads:"0/1/2/3/4/5/6/7/8/9", skillPoints:"5/0", skills:"-", traitPoints:1, traits:"Mark of Privalege, Your Lordship, Your Eminence, Your Grace"},
				{title:"Son of a Gun", time:8, resources:3, stats:"-", leads:"6/8/9", skillPoints:"3/0", skills:"-", traitPoints:2, traits:"Sea Legs"},
				{title:"Slave Born", time:12, resources:5, stats:"-1M/P", leads:"6/9", skillPoints:"2/1", skills:"Slavery-wise", traitPoints:3, traits:"Broken, Scarred, Maimed, Lame"}];
var bornPathsLength = bornPaths.length;
				
var peasentLifepaths = [{title:"Farmer", time:8, resources:5, stats:"1P", leads:"1/6/8", skillPoints:"0/8", skills:"Farming, Mending, Animal Husbandry, Weaving, Cooking, Sewing, Firebuilding, Sing", traitPoints:1, traits:"Hoarding"},
						{title:"Head of Household", time:15, resources:20, stats:"1M", leads:"1/6", skillPoints:"0/8", skills:"Carpentry, Hunting, Haggling, Almanac", traitPoints:2, traits:"-"},
						{title:"Midwife", time:10, resources:15, stats:"1M", leads:"1/9", skillPoints:"0/7", skills:"Animal Husbandry, Herbalism, Midwifery, Omen-wise", traitPoints:2, traits:"Bedside Manner", requires:"female|Farmer|Itinerant Priest"},
						{title:"Lazy Stayabout", time:7, resources:3, stats:"-", leads:"6/8/9", skillPoints:"0/3", skills:"Lazy-wise, Peasant-wise, Wife-wise, Work-wise", traitPoints:1, traits:"A Little Fat"},
						{title:"Conscript", time:1, resources:4, stats:"-", leads:"6/8/9", skillPoints:"0/2", skills:"Foraging, Battle-wise, Rumor-wise", traitPoints:1, traits:"Flee from Battle"},
						{title:"Peasant Pilgrim", time:3, resources:4, stats:"-", leads:"1/8/9", skillPoints:"1/3", skills:"Doctrine, Pilgrimage-wise, Saint-wise", traitPoints:2, traits:"Road Weary, Alms-Taker"},
						{title:"Farmer", time:8, resources:5, stats:"1P", leads:"1/6/8", skillPoints:"0/8", skills:"", traitPoints:1, traits:"Hoarding"},
						{title:"Miller", time:7, resources:15, stats:"-", leads:"1", skillPoints:"0/5", skills:"Miller, Brewer, Mending, Carpentry", traitPoints:1, traits:"Lord's Favorite"},
						{title:"Fisherman", time:6, resources:5, stats:"1P", leads:"1/7/9", skillPoints:"0/6", skills:"Fishing, Rigging, Knots, Mending, Cooking, Boatwright", traitPoints:2, traits:"Superstitious"},
						{title:"Shepherd", time:4, resources:4, stats:"1P", leads:"1/9", skillPoints:"0/5", skills:"Animal Husbandry, Sing, Climbing, Flute", traitPoints:1, traits:"Cry Wolf"},
						{title:"Woodcutter", time:5, resources:5, stats:"1P", leads:"1/9", skillPoints:"0/5", skills:"Firebuilding, Mending, Foraging, Orienteering, Tree-wise, Tree Cutting", traitPoints:1, traits:"-"},
						{title:"Hunter", time:5, resources:6, stats:"1M,P", leads:"1/6/9", skillPoints:"0/7", skills:"Hunting, Tracking, Stealthy, Cooking, Orienteering, Javelin or Bow", traitPoints:1, traits:"-"},
						{title:"Trapper", time:5, resources:8, stats:"1M,P", leads:"1/6/9", skillPoints:"0/6", skills:"Trapper, Stealthy, Tracking, Cooking, Haggling, Taxidermy", traitPoints:1, traits:"Foul Smelling"},
						{title:"Peddler", time:5, resources:10, stats:"1M", leads:"1/2/8/9", skillPoints:"0/7", skills:"Mending, Sing, Haggling, Chandler, Persuasion, Inconspicuous, Falsehood", traitPoints:2, traits:"Blank Stare, Glib, Eidetic Memory"},
						{title:"Elder", time:15, resources:5, stats:"1M", leads:"1/9", skillPoints:"0/6", skills:"Observation, Persuasion, Ugly Truth, Peasant-wise, Local History", traitPoints:1, traits:"Crotchety", requires:"four lifepaths, 50 years old"},
						{title:"Augur", time:5, resources:10, stats:"1M", leads:"8/9", skillPoints:"0/4", skills:"Astrology, Sorcery, Falsehood, Ugly Truth, Omen-wise", traitPoints:2, traits:"Disturbed, Dreamer, Cassandra, Touch of Ages", requires:"Midwife|Country Wife|female & max 3 lifepaths"},
						{title:"Itinerant Priest", time:6, resources:8, stats:"1M", leads:"1/2/5/9", skillPoints:"0/7", skills:"Orotory, Suasion, Chandler, Riding, Write, Read, Doctrine", traitPoints:2, traits:"Dusty, Faithful", requires:"acolyte lifepath"},
						{title:"Recluse Wizard", time:15, resources:28, stats:"1M", leads:"1/2/4/9", skillPoints:"0/7", skills:"Astrology, Alchemy, Enchanting, Illuminations, Ancient History, Obscure History", traitPoints:2, traits:"Batshit, Gifted", requires:"lifepath with Sorcery"},
						{title:"Country Wife", time:10, resources:5, stats:"1M,P", leads:"5", skillPoints:"0/2", skills:"Child-Rearing, Cooking, husband's skills", traitPoints:1, traits:"-"},
						];
var peasentLifepathsLength = peasentLifepaths.length;

var villagerLifepaths = [{title:"Kid", time:4, resources:3, stats:"1P", leads:"0/1/2/5/6/7/8/9", skillPoints:"0/3", skills:"Trouble-wise, Throwing, Inconspicuous", traitPoints:1, traits:"Bad Egg, Good for Nothing, Fleet of Foot", requires:"second lifepath"},
						{title:"Idiot", time:10, resources:4, stats:"-", leads:"0/9", skillPoints:"0/4", skills:"Inconspicuous, Conspicuous, Ugly Truth, Village Secrets-wise", traitPoints:1, traits:"Problems, Alocholic, Abused, Handicapped"},
						{title:"Pilgrim", time:2, resources:4, stats:"-", leads:"2/5/8", skillPoints:"0/5", skills:"Religious Rumor-wise, Road-wise, Shrine-wise, Alsm-wise, Relic-wise, Doctrine", traitPoints:2, traits:"Collector"},
						{title:"Conscript", time:1, resources:5, stats:"-", leads:"6/8/9", skillPoints:"0/2", skills:"Foraging, Baggage Train-wise", traitPoints:1, traits:"Hide before Battle"},
						{title:"Groom", time:4, resources:7, stats:"-", leads:"0/2/6", skillPoints:"0/4", skills:"Animal Husbandry, Riding, Mending, Horse-wise, Road-wise", traitPoints:1, traits:"-"},
						{title:"Runner", time:4, resources:6, stats:"1P", leads:"0/2/6", skillPoints:"0/3", skills:"Streetwise, Inconspicuous, Shortcut-wise", traitPoints:1, traits:"Skinny, Fleet of Foot"},
						{title:"Village Peddler", time:5, resources:10, stats:"1M", leads:"0/2/8/9", skillPoints:"0/7", skills:"Mending, Sing, Haggling, Chandler, Persuasion, INconspicuous, Falsehood", traitPoints:2, traits:"Odd"},
						{title:"Shopkeeper", time:6, resources:15, stats:"-", leads:"0/2", skillPoints:"0/5", skills:"Haggling, Accounting, Observation, Merchant-wise", traitPoints:1, traits:"-"},
						{title:"Kid", time:4, resources:3, stats:"1P", leads:"0/1/2/5/6/7/8/9", skillPoints:"0/3", skills:"", traitPoints:1, traits:"Hoarding"},
						];

function createMainPage() {

}
function rollLifepaths() {
	var nodeDiv = document.createElement("div");
	nodeDiv.id = "tempDiv";
	
	var nodeInput;
	var nodeForm;
	var nodeHeader;
	var nodePara;
	var nodeSpan;
	var text;
	
	nodeHeader = document.createElement("h4");
	text = document.createTextNode("Roll Lifepaths");
	nodeHeader.appendChild(text);
	
	nodeDiv.appendChild(nodeHeader);
	nodeDiv.appendChild(document.createElement("br"));
	
	nodePara = document.createElement("p");
	text = document.createTextNode("Select methodology:");
	nodePara.appendChild(text);
	
	nodeDiv.appendChild(nodePara);
	
	nodeForm = document.createElement("form");
	nodeForm.setAttribute("onsubmit","return false;");
	nodeInput = document.createElement("input");
	nodeInput.type = "radio";
	nodeInput.name = "realisticness";
	nodeInput.value = "Realistic";
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute("style","cursor:help;");
	text = document.createTextNode("Realistic");
	nodeSpan.appendChild(text);
	nodeForm.appendChild(nodeInput);
	nodeForm.appendChild(nodeSpan);nodeForm.appendChild(document.createElement("br"));
	nodeInput = document.createElement("input");
	nodeInput.type = "radio";
	nodeInput.name = "realisticness";
	nodeInput.checked = "yes";
	nodeInput.value = "Follow Restrictions";
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute("style","cursor:help;");
	text = document.createTextNode("Follow Restrictions");
	nodeSpan.appendChild(text);
	nodeForm.appendChild(nodeInput);
	nodeForm.appendChild(nodeSpan);nodeForm.appendChild(document.createElement("br"));
	nodeInput = document.createElement("input");
	nodeInput.type = "radio";
	nodeInput.name = "realisticness";
	nodeInput.value = "Ignore Restrictions";
	nodeSpan = document.createElement("span");
	nodeSpan.setAttribute("style","cursor:help;");
	text = document.createTextNode("Ignore Restrictions");
	nodeSpan.appendChild(text);
	nodeForm.appendChild(nodeInput);
	nodeForm.appendChild(nodeSpan);nodeForm.appendChild(document.createElement("br"));
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	nodeForm = document.createElement("form");
	nodeForm.setAttribute("onsubmit","return false;");
	nodeInput = document.createElement("input");
	nodeInput.type = "button";
	nodeInput.value = "Roll em";
	nodeInput.setAttribute("onclick","generateLifepaths()");
	nodeForm.appendChild(nodeInput);
	
	nodeDiv.appendChild(nodeForm);
	nodeDiv.appendChild(document.createElement("br"));
	
	var nodePara = document.createElement("p");
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputLinks";
	nodePara.appendChild(nodeSpan);
	
	nodeDiv.appendChild(nodePara);
	
	var replaced = document.getElementById("tempDiv");
	replaced.parentNode.replaceChild(nodeDiv,replaced);
}
function generateLifepaths() {
	var ranNum = Math.floor((Math.random() * bornPathsLength));
	
	var bornL = bornPaths[ranNum];
	
	newCharacter.born = bornL.title;
	
	var nodeSpan = document.createElement("span");
	nodeSpan.id = "outputLinks";
	var text = document.createTextNode(bornL.title);
	nodeSpan.appendChild(text);
	
	var replaced = document.getElementById("outputLinks");
	replaced.parentNode.replaceChild(nodeSpan,replaced);
}
</script>
<body onpageshow="createMainPage()">
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Character Burner</h2>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createMainPage()">
Main</li>
<li class="menuButton" onclick="rollLifepaths()">
Roll Lifepaths</li>
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