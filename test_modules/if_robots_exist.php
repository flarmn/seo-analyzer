



<?php

class if_robots_exist{

	function check_robots_file(){
		//$checkedAddress = $_POST["address"];

		$checkedAddress = 'http://fairodis-jewelry.fairiesgifts.net/';

		//$checkedAddress = 'http://fairodis-jewelry.fairiesgifts.ne/';


$robotspath = fopen($checkedAddress . '/robots.txt', 'r');

// Checking if file exist at place
if ($robotspath == false){
echo 'No robots file';
$robotsExistStatus = "Файл robots.txt отсутствует";
	$robotsExistRecomendation = "Программист: Создать файл robots.txt и разместить его на сайте.";
	$robotsStatus = '<p style = "display:inline-block; background:red; color:white;">Ошибка</p>';

} else {
	echo 'Robots file exist. All ok!';
	$robotsExistStatus = "Файл robots.txt присутствует";
	$robotsExistRecomendation = "Доработки не требуются";
	$robotsStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">Ok</p>';

}
	}
}


$if_robots_exist = new if_robots_exist();

$if_robots_exist->check_robots_file();



//END 
?>










