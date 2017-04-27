



<?php

class if_robots_exist{

	public $checkedAddress = 'http://fairodis-jewelry.fairiesgifts.net/';

function check_robots_file(){
$this->robotspath = fopen($this->checkedAddress . '/robots.txt', 'r');

// Checking if file exist at place
if ($this->robotspath == false){
echo 'No robots file';
} else {
	echo 'Robots file exist. All ok!';
}//else


	}//function
}//class


$if_robots_exist = new if_robots_exist();

$if_robots_exist->check_robots_file();

//END 
?>










