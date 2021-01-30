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


//$link = mysqli_query($conect, "SELECT `ID`, `name`, `description`, `img`, `video`, `film`, `serial`, `rang`, `data`, `style`, `country`, `time` FROM `film` WHERE `name`= '$nameFile'");

$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
$nameFile = $path_parts['filename'];
$search = mysqli_query($conect, "SELECT `ID`, `name`, `description`, `img`, `film`, `serial`, `rang`, `data`, `style`, `country`, `time`, `videoLink` FROM `film` WHERE `name`= '$nameFile'");
$resultSearch =mysqli_fetch_array($search);
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $url;
$addLink = mysqli_query($conect,"UPDATE `film` SET `link` = ('$url') WHERE `name`= '$nameFile'");

/*
$block = "./test/".$name.".php";
$content = file_get_contents('./link.php');
$save = fopen($block,"w+"); 
fwrite($save,$content); // Записать содержимое в дескриптор
fclose($save); // Закрыть файл
$name_block = pathinfo($_SERVER['SCRIPT_NAME']);
$nameFile_block = $name_block['filename'];
$link = mysqli_query($conect, "SELECT `link` FROM `film` WHERE `name`= '$nameFile_block'");
$resultLink =mysqli_fetch_array($link);
echo $resultLink['link'];
*/






//$url = $_SERVER['REQUEST_URI'];
//$addUrl = mysqli_query($conect, "INSERT INTO`film` (link) VALUES ('$url')");
//echo $path_parts['filename'];
//echo $resultSearch['name'];



?>