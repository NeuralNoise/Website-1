<?php
$searchString=$_REQUEST["q"]; $retVal="";

/*if (empty($searchString)) {
	
	echo "<ul>";
	foreach($a as $lnk) {
		echo "<li><a href=\"" . $lnk . "\" target= \"_blank\">Test</a></li>";
		//echo "<li>" . $lnk . "</li>";
		//<li><a href="https://wiki.libsdl.org/SDL_RenderCopy" target = "_blank">SDL</a></li>
	}
	echo "</ul>";

	echo $searchString . " test";
	return;
}*/

// lookup all hints from array if $q is different from "" 
/*if ($q !== "") {
  $q=strtolower($q); $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name,0,$len))) {
      if ($hint==="") {
        $hint=$name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}*/

// Output "no suggestion" if no hint was found
// or output the correct values 
//echo $hint==="" ? "no suggestion" : $hint;




//echo $q;
$con = new mysqli("localhost","root","","hyperlinks") or die(mysql_error());
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
}

//Retrieve websites containing that keyword
$query = "SELECT LinkID from keywordLinks WHERE Keyword=" . '"' . $searchString . '"';
$result = mysqli_query($con, $query);
$linkString = "(";
for ($i = 1; $i <= $result->num_rows; $i++) {
	$row = $result->fetch_assoc();
	if ($linkString !== "(")
		$linkString = $linkString . ", ";
	$linkString = $linkString . $row['LinkID'];
}
$linkString = $linkString . ")";

if (empty($searchString))
	$query = "SELECT Hyperlink FROM links";
else
	$query = "SELECT Hyperlink FROM links WHERE ID in " . $linkString;
$result = mysqli_query($con, $query);
//echo "<ul>";
for ($i = 1; $i <= $result->num_rows; $i++) {
	$row = $result->fetch_assoc();
	//echo "<li><a href=\"" . $row['Hyperlink'] . "\" target= \"_blank\">" . $row['Hyperlink'] . "</a></li>";
	echo "<a href=\"" . $row['Hyperlink'] . "\" target= \"_blank\">" . $row['Hyperlink'] . "</a>";
	echo "<br>";
	echo "<input type=\"button\" onclick=createWebsitePreview(" . '"tempDiv"' . ',"' . htmlspecialchars($row['Hyperlink']) . '") value="Edit Index"></input>';
	echo "<br>";
	//echo htmlspecialchars($row['Hyperlink']);
}
//echo "</ul>";

$con->close();



?>