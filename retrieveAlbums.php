<?php
// get the q parameter from URL
$q=$_REQUEST["q"]; $retVal="";

if ($q !== "") {
/*	
	echo "<ul>";
	foreach($a as $lnk) {
		echo "<li><a href=\"" . $lnk . "\" target= \"_blank\">Test</a></li>";
		//echo "<li>" . $lnk . "</li>";
		//<li><a href="https://wiki.libsdl.org/SDL_RenderCopy" target = "_blank">SDL</a></li>
	}
	echo "</ul>";
*/
}


$con = new mysqli("localhost","root","","hyperlinks") or die(mysql_error());
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
}
$result = $con->query("SELECT max(ID) FROM music");
$row = $result->fetch_row();
$pk = $row[0];
for ($i = 1; $i <= $pk; $i++) {
	$row = $result->fetch_assoc();
	echo "<img src=\"/Albums/" . $i . ".jpg\">";
}
//echo "</ul>";

$con->close();



?>