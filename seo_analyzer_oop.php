

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
$this->status[] = 0;
} else {
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
    $this->status[] = 1;
}
else{
    $this->status[] = 0;
} 
}


function host_in_robots_count(){
$this->testresults[] = "Проверка количества директив Host, прописанных в файле";
	// Checking if Host appear more then once in robots files, and how much times
if ($this->termsCount == 1){
	$this->status[] = 1;
} 
else if ($this->termsCount > 1){
$this->status[] = 2;
} 
else {
	$this->status[] = 0;
}

}



function if_sitemap_exist(){
	$this->testresults[] = "Проверка указания директивы Sitemap" ;
	$this->searchSiteMapTerm = "Sitemap";
if (substr_count($this->robotssearch, $this->searchHostTerm)>0){
	$this->status[] = 1;
}
else{
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
}//if
}//for 

if ($this->robotFSize > 32000){
  $this->status[] = 0;
} else{
$this->status[] = 1;
}//else
}//func






function server_answer(){
	$this->testresults[] = "Проверка кода ответа сервера для файла robots.txt" ;
	// Getting server answer
$this->serverAnswer=(get_headers($this->checkedAddress)[0]);

if(substr_count($this->serverAnswer, "200")>0){
$this->status[] = 1;
} else {
$this->status[] = 0;
}
}//func





function seo_report_builder(){


// table output
echo '
<h1 class = "text-center">Результаты анализа сайта:</h1>
<h3 class = "text-center">'; 
echo $this->checkedAddress;
echo '</h3>';
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


if($this->testresults[$i] == "Проверка наличия файла robots.txt" && $this->status[$i] == 1){
echo 'Состояние: ' . 'Файл robots.txt присутствует' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Доработки не требуются' . "<br/>";
}

if($this->testresults[$i] == "Проверка наличия файла robots.txt" && $this->status[$i] == 0){
echo 'Состояние: ' . 'Файл robots.txt отсутствует' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Программист: Создать файл robots.txt и разместить его на сайте.' . "<br/>";
}



if($this->testresults[$i] == "Проверка указания директивы Host" && $this->status[$i] == 1){
echo 'Состояние: ' . 'Директива Host указана' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Доработки не требуются' . "<br/>";
}

if($this->testresults[$i] == "Проверка указания директивы Host" && $this->status[$i] == 0){
echo 'Состояние: ' . 'В файле robots.txt не указана директива Host' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.' . "<br/>";
}



if($this->testresults[$i] == "Проверка количества директив Host, прописанных в файле" && $this->status[$i] == 1){
echo 'Состояние: ' . 'В файле прописана ' . $this->termsCount . ' директива Host' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Доработки не требуются' . "<br/>";
}

if($this->testresults[$i] == "Проверка количества директив Host, прописанных в файле" && $this->status[$i] == 2){
echo 'Состояние: ' . 'В файле прописано ' . $this->termsCount . ' директив Host' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта' . "<br/>";
}

if($this->testresults[$i] == "Проверка количества директив Host, прописанных в файле" && $this->status[$i] == 0){
echo 'Состояние: ' . 'В файле прописано ' . $this->termsCount . ' директив Host' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.' . "<br/>";
}



if($this->testresults[$i] == "Проверка указания директивы Sitemap" && $this->status[$i] == 1){
echo 'Состояние: ' . 'Директива Sitemap указана ' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Доработки не требуются' . "<br/>";
}

if($this->testresults[$i] == "Проверка указания директивы Sitemap" && $this->status[$i] == 0){
echo 'Состояние: ' . 'В файле robots.txt не указана директива Sitemap ' . "<br/>";
echo '<hr>';
echo 'Рекомендации: ' . 'Добавить в файл robots.txt директиву Sitemap' . "<br/>";
}



if($this->testresults[$i] == "Проверка размера файла robots.txt" && $this->status[$i] == 1){
echo "karyamba";
}

if($this->testresults[$i] == "Проверка размера файла robots.txt" && $this->status[$i] == 0){
echo "mumu";
}



if($this->testresults[$i] == "Проверка кода ответа сервера для файла robots.txt" && $this->status[$i] == 1){
echo "karyamba";
}

if($this->testresults[$i] == "Проверка кода ответа сервера для файла robots.txt" && $this->status[$i] == 0){
echo "mumu";
}


echo '</th>';

echo '</tr>';
}

echo '
</tbody>
</table>
';

}
}//class




$seotester = new seo_tester();

$seotester->seo_tester_init();


//END 
?>


</div>

</body>
</html>