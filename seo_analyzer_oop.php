

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



public	function seo_prober(){
$checkedAddress = $_POST["address"];
//$robotspath = fopen($checkedAddress . '/robots.txt', 'r');
echo 'lala';
//echo $checkedAddress;
return $checkedAddress;

}

function seo_analyzer(){
//echo seo_prober()->$checkedAddress;
echo 'cheese';
echo $checkedAddress;
}

function seo_reporter(){

}

function seo_error_messages(){

}

}

$test = new seo_tester();
$test->seo_prober();
$test->seo_analyzer();

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








