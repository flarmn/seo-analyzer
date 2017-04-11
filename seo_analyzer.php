

<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>


<?php
$checkedAddress = $_POST["address"];


// ====== IsExist? =======
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


$robotFSize = explode(':', $robotsSize);


echo 'File size: ' . $robotFSize[1] . " 	Bytes";


/*
if (substr_count($robotspath, 'H')>0){
    echo "Найден!";
}
else{
    echo "Не найден!";
} 
*/
$robotssearch = file_get_contents($checkedAddress . '/robots.txt');
//print_r($robotssearch);

echo $robotssearch;

$str="Hello";
//$file=file("$checkedAddress . '/robots.txt");
if(in_array($str,$robotssearch)){
echo "Превед, медвед...";
} 




if (substr_count($robotssearch, 'Hello')>0){
    echo "<br/>Найден! Искомое слово встречаеться " . substr_count($robotssearch, 'Hello') . ' раз';
}
else{
    echo "Не найден!";
} 

//echo (substr_count($robotssearch, 'Hello'));


//END 
?>

