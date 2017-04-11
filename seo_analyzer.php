

<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>


<?php


$checkedAddress = $_POST["address"];


$robotspath = fopen($checkedAddress . '/robots.txt', 'r');

// Checking if file exist at place
if ($robotspath == false){
echo 'No robots file';
} else {
	echo 'Robots file exist. All ok!';
}

// Getting server answer
$serverAnswer=(get_headers($checkedAddress)[0]);

echo '<br/>' . 'Server answer: ' . $serverAnswer ;



// GETTING REMOTE FILE SIZE FROM REMOTE file METADATA
$remoteFileMeta =  (stream_get_meta_data($robotspath)['wrapper_data']);

for ($i = 0; $i < count($remoteFileMeta); $i++){

if(substr_count($remoteFileMeta[$i], 'Content-Length')>0){
$robotFSize = explode(':', $remoteFileMeta[$i])[1];
echo '<br/> File size: ' . $robotFSize . ' Bytes';
}//if

}//for 



// Checking if Host appear in robots file
$searchTerm  = "Host";
$robotssearch = file_get_contents($checkedAddress . '/robots.txt');
$termsCount = substr_count($robotssearch, $searchTerm);

if (substr_count($robotssearch, $searchTerm)>0){
    echo "<br/>Найден! Искомое слово встречаеться " . $termsCount . ' раз';
}
else{
    echo "<br/>Не найден!";
} 

/*
echo '<br/>';
print_r($remoteFileMeta);
*/

//END 
?>

