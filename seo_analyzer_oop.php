

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<title>Item details</title>
</head>
<body>

<div class = "container">
<form method = "post" >
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>



<?php

class seo_tester{


function seo_tester_init(){
$this->checkedAddress = $_POST["address"];
//echo $this->checkedAddress = $_POST["address"];

//tests run
$this->if_robots_exist();
$this->if_host_exist();
$this->host_in_robots_count();
$this->if_sitemap_exist();
$this->get_robots_size();
$this->server_answer();





//report output
$this->seo_report_builder();


}




function if_robots_exist(){
$this->testresults[] = "Проверка наличия файла robots.txt" ;

$this->robotspath = fopen($this->checkedAddress . '/robots.txt', 'r');
// Checking if file exist at place
if ($this->robotspath == false){
echo 'No robots file';
$this->status[] = 0;
} else {
	echo 'Robots file exist. All ok!';
	$this->status[] = 1;
}//else
}//func



function if_host_exist(){
// Checking if Host appear in robots file
$this->testresults[] = "Проверка указания директивы Host" ;	
$this->searchHostTerm  = "Host";
$this->robotssearch = file_get_contents($this->checkedAddress . '/robots.txt');
$this->termsCount = substr_count($this->robotssearch, $this->searchHostTerm);

if (substr_count($this->robotssearch, $this->searchHostTerm)>0){
    echo "<br/>Найден! Искомое слово встречаеться " . $this->termsCount . ' раз';
    $this->status[] = 1;
}
else{
    echo "<br/> хост Не найден!";
    $this->status[] = 0;
} 
}


function host_in_robots_count(){
$this->testresults[] = "Проверка количества директив Host, прописанных в файле";
	// Checking if Host appear more then once in robots files, and how much times
echo 'kuku';
if ($this->termsCount == 1){
	$this->hostCountExistStatus = "В файле прописана " . $this->termsCount . " директива Host";
	$this->status[] = 1;
} 
else if ($this->termsCount > 1){
$this->hostCountExistStatus = "В файле прописано " . $this->termsCount . " директив Host ";
$this->status[] = 0;
} 
else {
	$this->hostCountExistStatus = "В файле прописано " . $this->termsCount . " директив Host ";
	$this->status[] = 0;
}
//echo $this->hostCountExistStatus;
}



function if_sitemap_exist(){
	$this->testresults[] = "Проверка указания директивы Sitemap" ;
	$this->searchSiteMapTerm = "Sitemap";
if (substr_count($this->robotssearch, $this->searchHostTerm)>0){
    $this->siteMapExistStatus = "Директива Sitemap указана";
	echo $this->siteMapExistStatus;
	$this->status[] = 1;
}
else{
    $this->siteMapExistStatus = "В файле robots.txt не указана директива Sitemap";
	echo $this->siteMapExistStatus;
	$this->status[] = 0;
}
}



function get_robots_size(){
	$this->testresults[] = "Проверка размера файла robots.txt" ;
// GETTING REMOTE FILE SIZE FROM REMOTE file METADATA

$this->remoteFileMeta =  (stream_get_meta_data($this->robotspath)['wrapper_data']);

for ($i = 0; $i < count($this->remoteFileMeta); $i++){

if(substr_count($this->remoteFileMeta[$i], 'Content-Length')>0){
$this->robotFSize = explode(':', $this->remoteFileMeta[$i])[1];
echo '<br/> File size: ' . $this->robotFSize . ' Bytes';
}//if
}//for 

if ($this->robotFSize > 32000){
  $this->robotFSizeCountStatus = "Размера файла robots.txt составляет " . $this->robotFSize . " байт, что превышает допустимую норму";
  $this->status[] = 0;
} else{
$this->robotFSizeCountStatus = "Размера файла robots.txt составляет " . $this->robotFSize . " байт, что находится в пределах допустимой нормы";
$this->status[] = 1;
}//else
}//func






function server_answer(){
	$this->testresults[] = "Проверка кода ответа сервера для файла robots.txt" ;
	// Getting server answer
$this->serverAnswer=(get_headers($this->checkedAddress)[0]);

if(substr_count($this->serverAnswer, "200")>0){
echo "Файл robots.txt отдаёт код ответа сервера: " . $this->serverAnswer;
$this->status[] = 1;

} else {
echo "При обращении к файлу robots.txt сервер возвращает код ответа: " . $this->serverAnswer;
$this->status[] = 0;
}

//echo '<br/>' . 'Server answer: ' . $this->serverAnswer ;
}//func



















function seo_report_builder(){

	//read data file

$f = fopen("data.txt", "r");

	// Читать построчно до конца файла
	while (!feof($f)) { 

	// Создать массив с запятой-разделителем
		for ($z = 0; $z<count($this->testresults); $z++){
	   $this->errormessages[$z] = explode("/",fgets($f)); 
}
	// Записать ссылки (получить данные из массива)
	   //echo  $this->errormessages[0] ; 
	  

	}
	// Записать ссылки (получить данные из массива)
	   //echo  $this->errormessages[0] ; 

//	echo $z;
//echo $this->errormessages[$z];
//print_r($this->errormessages);

echo $this->errormessages[0][1];


	fclose($f);


// table output
echo '

<table class="table table-bordered">

<thead>

<tr>
	<th>
	№
	</th>
	<th>
	Название проверки
	</th>
	<th>
	Статус
	</th>
	<th style = "width: 45%">
	Текущее состояние
	</th>
</tr>
</thead>

';


echo '<tbody>';

for ($i = 0; $i<count($this->testresults); $i++){
$this->testnumber = $i +1;
echo '<tr>';
echo '<th>' . $this->testnumber . '</th>';
echo '<th>' . $this->testresults[$i] . '</th>';
echo '<th>';
if ($this->status[$i] == 1){
echo '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">OK</p>';
}
else{
echo '<p style = "display:inline-block; background:red; color:white;">Ошибка</p>';
}
echo '</th>';


echo '<th>';
if ($this->status[$i] == 1){
echo 'Состояние: ' . $this->errormessages[$i][0] . "<br/>"; 
echo '<hr>';
echo 'Рекомендации: ' . $this->errormessages[$i][1] . "<br/>";
}
else{
echo 'Состояние: ' . $this->errormessages[$i][2] . "<br/>"; 
echo '<hr>';
echo 'Рекомендации: ' . $this->errormessages[$i][3] . "<br/>";
}
echo '</th>';

echo '</tr>';
}

echo '
</tbody>
</table>
';

}







function seo_error_messages(){

}//func

}//class




$seotester = new seo_tester();

$seotester->seo_tester_init();






//END 
?>



<h1 class = "text-center">Результаты анализа сайта:</h1>
<h3 class = "text-center"><?php echo $checkedAddress; ?></h3>




</div>


</body>
</html>








