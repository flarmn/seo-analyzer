<?php

$f = fopen("data.txt", "r");

	// Читать построчно до конца файла
	while(!feof($f)) { 
	    echo fgets($f) . "<br />";
	}

	fclose($f);



?>