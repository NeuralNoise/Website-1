<?php

$q=$_REQUEST["q"];
$q = (string)$q;
/*if (substr($q,0,4) !== "http") {
	echo "Not a web";
	return;
}*/
echo $q;

$con = new mysqli("localhost","root","","hyperlinks") or die(mysql_error());
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
}
$query = "SELECT ID FROM music where FileName=\"" . $q . "\"";
$result = mysqli_query($con, $query);
$row = $result->fetch_assoc();
//if (!$result) {
if (is_null($row['ID'])) {
	echo "<br>oh nononono";
	//Delete $row
	//Find primary key ID to insert
	$result = $con->query("SELECT max(ID) FROM music");
	$row = $result->fetch_row();
	$pk = $row[0]+1;
	
	//$input = 'http://images.websnapr.com/?size=size&key=Y64Q44QLt12u&url=http://google.com';
	$input = $q;
	//Need to parse $q to find which image format the image uses
	$output = '' . $pk . '.jpg';
	file_put_contents('./Albums/' . $output, file_get_contents($input));
	
	$result = $con->query("INSERT INTO music (ID, FileName) VALUES (" . $pk . ", \"" . $q . "\")");
	if (!$result)
		echo "<br>Oh Nonononono";
}
else {
	echo "<br>" . $row['ID'] . " Hi";
}

$con->close();

?>