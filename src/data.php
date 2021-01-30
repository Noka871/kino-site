<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
$conect = mysqli_connect('localhost','root','','films');
$sql = mysqli_query($conect, 'SELECT `ID`, `name`, `description`, `img`, `film`, `serial`, `rang`, `data`, `style`, `country`, `time`,`videoLink` FROM `film` ORDER BY id DESC LIMIT 1');
$result = mysqli_fetch_array($sql);
$name = $result['name'];


$file = "./film/".$name.".php"; // Путь к новому файлу
$html = file_get_contents('./film.php'); // Содержимое
$handle = fopen($file,"w+"); // Создать файл, вернуть дескриптор в $handle
fwrite($handle,$html); // Записать содержимое в дескриптор
fclose($handle); // Закрыть файл



$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
$nameFile = $path_parts['filename'];
$search = mysqli_query($conect, "SELECT `ID`, `name`, `description`, `img`, `film`, `serial`, `rang`, `data`, `style`, `country`, `time`, `videoLink` FROM `film` WHERE `name`= '$nameFile'");
$resultSearch =mysqli_fetch_array($search);
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$addLink = mysqli_query($conect,"UPDATE `film` SET `link` = ('$url') WHERE `name`= '$nameFile'");



?>