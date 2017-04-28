

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
$this->server_answer();
$this->get_robots_size();
$this->if_host_exist();
$this->if_sitemap_exist();
$this->host_in_robots_count();
}




function if_robots_exist(){
$this->robotspath = fopen($this->checkedAddress . '/robots.txt', 'r');
// Checking if file exist at place
if ($this->robotspath == false){
echo 'No robots file';
} else {
	echo 'Robots file exist. All ok!';
}//else
}//func


function server_answer(){
	// Getting server answer
$this->serverAnswer=(get_headers($this->checkedAddress)[0]);

if(substr_count($this->serverAnswer, "200")>0){
echo "Файл robots.txt отдаёт код ответа сервера: " . $this->serverAnswer;

} else {
echo "При обращении к файлу robots.txt сервер возвращает код ответа: " . $this->serverAnswer;

}

echo '<br/>' . 'Server answer: ' . $this->serverAnswer ;
}//func



function get_robots_size(){
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
} else{
$this->robotFSizeCountStatus = "Размера файла robots.txt составляет " . $this->robotFSize . " байт, что находится в пределах допустимой нормы";
}//else
}//func


function if_host_exist(){
	// Checking if Host appear in robots file
$this->searchHostTerm  = "Host";
$this->robotssearch = file_get_contents($this->checkedAddress . '/robots.txt');
$this->termsCount = substr_count($this->robotssearch, $this->searchHostTerm);

if (substr_count($this->robotssearch, $this->searchHostTerm)>0){
    echo "<br/>Найден! Искомое слово встречаеться " . $this->termsCount . ' раз';
}
else{
    echo "<br/> хост Не найден!";
} 
}



function if_sitemap_exist(){
	$this->searchSiteMapTerm = "Sitemap";
if (substr_count($this->robotssearch, $this->searchHostTerm)>0){
    $this->siteMapExistStatus = "Директива Sitemap указана";
	echo $this->siteMapExistStatus;
}
else{
    $this->siteMapExistStatus = "В файле robots.txt не указана директива Sitemap";
	echo $this->siteMapExistStatus;
}
}





function host_in_robots_count(){
	// Checking if Host appear more then once in robots files, and how much times
echo 'kuku';
if ($this->termsCount == 1){
	$this->hostCountExistStatus = "В файле прописана " . $this->termsCount . " директива Host";
} 
else if ($this->termsCount > 1){
$this->hostCountExistStatus = "В файле прописано " . $this->termsCount . " директив Host ";
} 
else {
	$this->hostCountExistStatus = "В файле прописано " . $this->termsCount . " директив Host ";
}
echo $this->hostCountExistStatus;
}




function seo_reporter(){

}







function seo_error_messages(){

}

}




$seotester = new seo_tester();

$seotester->seo_tester_init();






//END 
?>



<h1 class = "text-center">Результаты анализа сайта:</h1>
<h3 class = "text-center"><?php echo $checkedAddress; ?></h3>

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
	<th>
	Текущее состояние
	</th>
</tr>
</thead>

<tbody>
<tr>
	<th>
	№
	</th>
	<th>
	Проверка наличия файла robots.txt
	</th>
	<th>
	<?php echo $robotsStatus; ?>
	</th>
	<th>
	<?php echo 'Состояние: ' . $robotsExistStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $robotsExistRecomendation . "<br/>"; ?>
	</th>
</tr>

<tr >
	<th>
	№325
	</th>
	<th>
	Проверка указания директивы Host
	</th>
	<th>
	<?php echo $hostStatus; ?>
	</th>
	<th style = "width: 45%">
	<?php echo 'Состояние: ' . $hostExistStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $hostExistRecomendation . "<br/>"; ?>
	</th>
</tr>


<tr>
	<th>
	№
	</th>
	<th>
	Проверка количества директив Host, прописанных в файле
	</th>
	<th>
	<?php echo $hostCountStatus; ?>
	</th>
	<th>
	<?php echo 'Состояние: ' . $hostCountExistStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $hostCountRecomendation . "<br/>"; ?>
	</th>
</tr>


<tr>
	<th>
	№
	</th>
	<th>
	Проверка указания директивы Sitemap
	</th>
	<th>
	<?php echo $siteMapStatus; ?>
	</th>
	<th>
		<?php echo 'Состояние: ' . $siteMapExistStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $siteMapExistRecomendation . "<br/>"; ?>
	</th>
</tr>



<tr>
	<th>
	№
	</th>
	<th>
	Проверка размера файла robots.txt
	</th>
	<th>
	<?php echo $robotFSizeStatus; ?>
	</th>
	<th>
		<?php echo 'Состояние: ' . $robotFSizeCountStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $robotFSizeRecomendation . "<br/>"; ?>
	</th>
</tr>




<tr>
	<th>
	№
	</th>
	<th>
	Проверка кода ответа сервера для файла robots.txt
	</th>
	<th>
	<?php echo $serverAnswerStatus; ?>
	</th>
	<th>
		<?php echo 'Состояние: ' . $serverAnswerCountStatus . "<br/>"; ?>
	<hr>
	<?php echo 'Рекомендации: ' . $serverAnswerRecomendation . "<br/>"; ?>
	</th>
</tr>



</tbody>

</table>



</div>


</body>
</html>








