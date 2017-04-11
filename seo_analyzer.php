

<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>


<?php

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


$robotspath= file_get_contents('http://127.0.0.1/seo_analyzer/robots1.txt');
echo $homepage;

if ($homepage == false){
echo 'chu-chu';
} else {
	echo 'Waw!';
}



$some = $_POST["address"];
echo $some;


?>