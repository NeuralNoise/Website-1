<?php
//does not write newlines to text file *shouldn't matter*
//needs to also store the author

$request_body = file_get_contents('php://input');
//echo "<p>" . $request_body . "</p>";

//return;
$metrics = explode(chr(29),$request_body);
echo $request_body;
//echo getcwd();
unlink(".\\GameUser\\user" . $metrics[0] . ".txt");
$handle = fopen(".\\GameUser\\user" . $metrics[0] . ".txt","w");
$length = count($metrics);
for($i=0; $i<$length; $i++) {	//First line of 'metrics' is User Name
	fwrite($handle,$metrics[$i] . chr(29));
}
fclose($handle);

//$input = $metrics[1];
//$output = ".\\GamePictures\\" . $metrics[0] . '.jpg';
//file_put_contents($output, file_get_contents($input));

//Mark user in database

return;
?>