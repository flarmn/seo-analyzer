

<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>


<?php
$checkedAddress = $_POST["address"];
// ===============
/*
$filename = '/path/to/foo.txt';

if (file_exists($filename)) {
    echo "Файл $filename существует";
} else {
    echo "Файл $filename не существует";
}
*/
// ==================


//$robotspath = file_get_contents($checkedAddress . '/robots.txt');

$robotspath = fopen($checkedAddress . '/robots.txt', 'r');

//echo $robotspath;

if ($robotspath == false){
echo 'No robots file';
} else {
	echo 'Robots file exist. All ok!';
}


$serverAnswer=(get_headers($checkedAddress)[0]);

$robotsSize = (stream_get_meta_data($robotspath)['wrapper_data'][6]);



echo '<br/>' . 'Server answer: ' . $serverAnswer . '<br/>';





//print_r($robotsSize);

$robotFSize = explode(':', $robotsSize);

//echo $robotsSize;

//print_r($robotFSize);

echo 'File size: ' . $robotFSize[1] . " Bytes";

?>

