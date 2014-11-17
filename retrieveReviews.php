<?php
$searchTerm=$_REQUEST["q"];
$searchTerm = (string)$searchTerm;

if (empty($searchTerm)) {
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
$fileLocation = ".\\GameReviews\\review" . $searchTerm . ".txt";

if (file_exists($fileLocation)) {
	$handle = fopen($fileLocation,"r");
	$data = fread($handle,filesize($fileLocation));
	echo "<a href=\"" . "gameReviews.php" . "\" target= \"_blank\">" . $searchTerm . "</a>";
	echo "<br>";
	echo "][";
	echo $data;
	fclose($handle);
}

return;

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
$query = "SELECT FileName FROM gamereviews";
$result = mysqli_query($con, $query);
//echo "<ul>";
for ($i = 1; $i <= $result->num_rows; $i++) {
	$row = $result->fetch_assoc();
	//echo "<li><a href=\"" . $row['Hyperlink'] . "\" target= \"_blank\">" . $row['Hyperlink'] . "</a></li>";
	echo "<a href=\"" . $row['FileName'] . ".php\" target= \"_blank\">" . $row['FileName'] . ".php</a>";
	echo "<br>";
	//echo "<input type=\"button\" onclick=createWebsitePreview(" . '"tempDiv"' . ',"' . $row['FileName'] . '") value="Edit Index"></input>';
	echo "<br>";
}
//echo "</ul>";

$con->close();


?>