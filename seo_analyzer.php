

<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>


<?php
$checkedAddres = $_POST["address"];
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


$robotspath= file_get_contents($checkedAddres . '/robots.txt');
echo $robotspath;

if ($robotspath == false){
echo 'No robots file';
} else {
	echo 'Waw!';
}






?>