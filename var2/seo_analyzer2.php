

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
<div class = "col-md-6">
<form method = "post" style = "float:right;">
<input type = "textfield" name = "address" placeholder="Input your web-site address">
<input type = "submit" value = "Check">
</form>
</div>


<?php

$checkedAddress = $_POST["address"];
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

// Getting server answer
$serverAnswer=(get_headers($checkedAddress)[0]);

if(substr_count($serverAnswer, "200")>0){
$serverAnswerCountStatus = "Файл robots.txt отдаёт код ответа сервера: " . $serverAnswer;
$serverAnswerRecomendation = "Доработки не требуются";
$serverAnswerStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">OK</p>';
} else {
$serverAnswerCountStatus = "При обращении к файлу robots.txt сервер возвращает код ответа: " . $serverAnswer;
$serverAnswerRecomendation = "Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200";
$serverAnswerStatus = '<p style = "display:inline-block; background:red; color:white;">Ошибка</p>';
}


echo '<br/>' . 'Server answer: ' . $serverAnswer ;



// GETTING REMOTE FILE SIZE FROM REMOTE file METADATA
$remoteFileMeta =  (stream_get_meta_data($robotspath)['wrapper_data']);

for ($i = 0; $i < count($remoteFileMeta); $i++){

if(substr_count($remoteFileMeta[$i], 'Content-Length')>0){
$robotFSize = explode(':', $remoteFileMeta[$i])[1];
echo '<br/> File size: ' . $robotFSize . ' Bytes';
}//if

}//for 

if ($robotFSize > 32000){
    $robotFSizeCountStatus = "Размера файла robots.txt составляет " . $robotFSize . " байт, что превышает допустимую норму";
	$robotFSizeRecomendation = "Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб";
$robotFSizeStatus = '<p style = "display:inline-block; height:100%; width:100%; background:red; color:white;">Oшибка</p>';
} else{
$robotFSizeCountStatus = "Размера файла robots.txt составляет " . $robotFSize . " байт, что находится в пределах допустимой нормы";
$robotFSizeRecomendation = "Доработки не требуются";
$robotFSizeStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">OK</p>';
}



// Checking if Host appear in robots file
$searchHostTerm  = "Host";
$robotssearch = file_get_contents($checkedAddress . '/robots.txt');
$termsCount = substr_count($robotssearch, $searchHostTerm);

if (substr_count($robotssearch, $searchHostTerm)>0){
    echo "<br/>Найден! Искомое слово встречаеться " . $termsCount . ' раз';

    $hostExistStatus = "Директива Host указана";
	$hostExistRecomendation = "Доработки не требуются";
	$hostStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">Ok</p>';
}
else{
    echo "<br/>Не найден!";
    $hostExistStatus = "В файле robots.txt не указана директива Host";
	$hostExistRecomendation = "Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.";
$hostStatus = '<p style = "display:inline-block; height:100%; width:100%; background:red; color:white;">Oшибка</p>';
} 


$searchSiteMapTerm = "Sitemap";
if (substr_count($robotssearch, $searchHostTerm)>0){
    $siteMapExistStatus = "Директива Sitemap указана";
	$siteMapExistRecomendation = "Доработки не требуются";
	$siteMapStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">Ok</p>';
}
else{
    $siteMapExistStatus = "В файле robots.txt не указана директива Sitemap";
	$siteMapExistRecomendation = "Программист: Добавить в файл robots.txt директиву Sitemap";
$siteMapStatus = '<p style = "display:inline-block; height:100%; width:100%; background:red; color:white;">Oшибка</p>';
}



// Checking if Host appear more then once in robots files, and how much times

if ($termsCount == 1){
	$hostCountExistStatus = "В файле прописана " . $termsCount . " директива Host";
	$hostCountRecomendation = "Доработки не требуются";
	$hostCountStatus = '<p style = "display:inline-block; height:100%; width:100%; background:green; color:white;">Ok</p>';

} else if ($termsCount > 1){

$hostCountExistStatus = "В файле прописано " . $termsCount . " директив Host ";
$hostCountRecomendation = "Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта";
$hostCountStatus = '<p style = "display:inline-block; height:100%; width:100%; background:red; color:white;">Ошибка</p>';
} else {
	$hostCountExistStatus = "В файле прописано " . $termsCount . " директив Host ";
$hostCountRecomendation = "Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.";
$hostCountStatus = '<p style = "display:inline-block; height:100%; width:100%; background:red; color:white;">Ошибка</p>';
}




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








