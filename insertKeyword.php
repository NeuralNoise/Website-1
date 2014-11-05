<?php
//BROKEN: deletes non-alphanumeric characters
//BROKEN: West wing link won't be edited
$keyword = $_REQUEST["q"];
//$keyword = strtolower(trim((string)$keyword));
//$keyword = (string)$keyword;
echo $keyword . "<br>";

$hl=$_REQUEST["r"];
$hl = (string)$hl;
/*if (substr($q,0,4) !== "http") {
	echo "Not a web";
	return;
}*/
//echo $q;
$con = new mysqli("localhost","root","","hyperlinks") or die(mysql_error());
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
}
$query = "SELECT ID FROM links where Hyperlink=\"" . $hl . "\"";
$result = mysqli_query($con, $query);
$row = $result->fetch_assoc();
$linkID = $row['ID'];
//if (!$result) {
if (is_null($linkID)) {
	echo "<br>oh nononono";
	//Delete $row
	//Find primary key ID to insert
	/*$result = $con->query("SELECT max(ID) FROM links");
	$row = $result->fetch_row();
	$pk = $row[0]+1;
	
	$result = $con->query("INSERT INTO links (ID, Hyperlink) VALUES (" . $pk . ", \"" . $q . "\")");
	if (!$result)
		echo "<br>Oh Nonononono";
	else
		echo "Saved";*/
	return;
}

//Store keyword
//TODO: Make this more efficient
$query = "SELECT keyLs.KeywordID as KeywordID, keyLs.LinkID FROM keywordLinks keyLs where Keyword=\"" . $keyword . "\" ORDER BY KeywordID DESC";
$result = mysqli_query($con, $query);

$row = $result->fetch_assoc();
//If keyword is already stored, return
if($row['LinkID'] === $linkID) {
	outputKeywords($con,$linkID);
	return;
}
$keywordID = $row['KeywordID'];
while($row = $result->fetch_assoc()) {
	//If keyword is already stored, return
	if($row['LinkID'] === $linkID) {
		outputKeywords($con,$linkID);
		return;
	}
}

if (is_null($keywordID)) {
	$keywordID = -1;
}
$keywordID = $keywordID + 1;
if (!empty($keyword)) {
	$result = $con->query("INSERT INTO keywordLinks (Keyword, KeywordID, LinkID) VALUES (\"" . $keyword . "\", " . $keywordID . ", " . $linkID . ")");
	if (!$result) {
		echo "Oh Nonononono";
		return;
	}
}

outputKeywords($con,$linkID);


$con->close();


//====================================================================

function outputKeywords($conn,$linkID) {
//Output keywords attached to this link
	$tempstr = "";
	$query = "SELECT Keyword FROM keywordLinks where LinkID=\"" . $linkID . "\"";
	$result = mysqli_query($conn, $query);
	//if ($result->num_rows > 0)
	while($row = $result->fetch_assoc()) {
		if(empty($tempstr)) {
			$tempstr = $row['Keyword'];
		}
		else
			$tempstr = $tempstr . ", " . $row['Keyword'];
	}
	if($tempstr == "")
		echo "*NO KEYWORDS EXIST*";
	else
		echo $tempstr;//echo $keyword;

}

?>