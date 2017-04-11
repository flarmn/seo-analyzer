
<?php

// ===============

$filename = '/path/to/foo.txt';

if (file_exists($filename)) {
    echo "Файл $filename существует";
} else {
    echo "Файл $filename не существует";
}

// ==================


$homepage = file_get_contents('http://rambler.ru');
echo $homepage;

?>
