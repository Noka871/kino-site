<?php
$conect = mysqli_connect('localhost','root','','films');



if (isset($_POST['submit'])){	
	$session = 1;
	
	$uploadImg = './film/img/';
	$apendImg=date('YmdHis').rand(100,1000).'.jpg'; 
	$uploadfile1 = "$uploadImg$apendImg";
	$uploadVideo = './film/video/';
	if(($_FILES['loadImg']['type'] == 'image/gif' || $_FILES['loadImg']['type'] == 'image/jpeg' || $_FILES['loadImg']['type'] == 'image/png') && ($_FILES['loadImg']['size'] != 0 and $_FILES['loadImg']['size']<=1512000)){ 
		if (move_uploaded_file($_FILES['loadImg']['tmp_name'], $uploadfile1)){
			$size = getimagesize($uploadfile1); 
			if ($size[0] < 5001 && $size[1]<15001){
				$addImg = 1;
			}else{
				echo '<p style="background:red; color:white; margin:0;">Загружаемое изображение превышает допустимые нормы (ширина не более - 500; высота не более 1500)</p>';
				unlink($uploadfile1); 
			} 
		} else {
			echo '<p style="background:red; color:white; margin:0;">изображение не загружено попробуйте снова!</p>';
		} 
	} else { 
	echo '<p style="background:red; color:white; margin:0;">Размер или тип изображения не коректны попрбуйте выбрать другой файл!</p>';
	}



	$name =  mysqli_real_escape_string($conect, trim($_POST['name']));
	$name = preg_replace_callback('~(?<=\\A|[.!?])\\s*?[a-zа-яё]~u', function($m){
		return mb_strtoupper($m[0], 'UTF-8');
	}, $name);
	
	$janr = mysqli_real_escape_string($conect, trim($_POST['janr']));
	$strana = mysqli_real_escape_string($conect, trim($_POST['strana']));
	$loadImg = $uploadfile1;
	$description = mysqli_real_escape_string($conect, trim($_POST['description']));
	$rang = mysqli_real_escape_string($conect, trim($_POST['rang']));
	$date = mysqli_real_escape_string($conect, trim($_POST['data']));
	$time = mysqli_real_escape_string($conect, trim($_POST['time']));
	$loadPlayerLink = mysqli_real_escape_string($conect, trim($_POST['loadPlayerLink']));
	
	if(!empty($name) and !empty($janr) and !empty($strana) and !empty($loadImg) and !empty($loadPlayerLink) and !empty($description) and !empty($rang) and ($rang <= 10) and !empty($date) and !empty($time) and strlen($description)<2139){
		$query ="SELECT * FROM `film` WHERE name = '$name'";
		$data = mysqli_query($conect, $query);
		if(mysqli_num_rows($data) == 0 and $addImg == 1 ){
			$query ="INSERT INTO`film`(name, description, img, rang, data, style, country, time, videoLink) VALUES('$name', '$description', '$loadImg','$rang', '$date', '$janr', '$strana', '$time', '$loadPlayerLink')";
			mysqli_query($conect, $query);
			//echo'фильм добавлен';
			mysqli_close($conect);
			header ('Location: film.php');
			exit();
		}
		else{
			if(mysqli_num_rows($data) != 0){
				echo '<p style="background:red; color:white; margin:0;">Такой фильм существует!</p>';
			}else{
				echo '<p style="background:red; color:white; margin:0;">файл не загружен!</p>';
			}
			
			
		}
	}else{
		echo'<p style="background:red; color:white; margin:0;">Поля заполненны не коректно!</p>';
		
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>work</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/modification.css">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	
</head>
<body>
<form method="POST" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
<?php
	$conect = mysqli_connect('localhost','root','','films');
	if (isset($_POST['admin'])){
		
		$login = mysqli_real_escape_string($conect, trim($_POST['login']));
		$pass = mysqli_real_escape_string($conect, trim($_POST['pass']));
		$autorization = mysqli_query($conect, "SELECT `login`, `password` FROM `admin`");
		while ($result_autorization = mysqli_fetch_array($autorization)){
			if($login == $result_autorization['login'] and $pass == $result_autorization['password']){
				
				$session = 1;
				
			}else{
				echo'<p style="background:red; color:white; margin:0;">Не верный логин или пароль<p></br>
					<div class="column">
					<h2 class="column__title">Админ панель</h2>
					<p class="column__text">введите логин от админ панели</p>
					<input class="column__input" type = "text" name="login">
					<p class="column__text">введите пароль от админ панели</p>
					<input class="column__input" type = "password" name = "pass">
					<button class="column__button" type="submit" name="admin">войти</button>
					</div>
				';
				exit();
			}
		}
	}else{
		if($session == 1){ 
		
			echo ' <center>
	<h2>Добро пожаловать на KINgaroo admin.</h2>
	<p>
		Здесь вы можете добавить фильм на сайт KINgaroo.</br>
		Заполните все поля что бы добавить фильм на сайт!
	</p>
</center>
<div class="center">
	<div class="column">
		<p>название фильма</p>
		<input class="column__input" type="text" name="name">
		<p>Укажите жанр фильма страну его выпуска</p>
		<div class="row">
			
			<select  name="janr" class="row__selsect">
				<option>Жанры</option>
				<option>комедия</option>
				<option>триллер</option>
				<option>боевик</option>
				<option>мелодрамма</option>
				<option>криминал</option>
				<option>драма</option>
				<option>ужасы</option>
				<option>приключения</option>
				<option>семейные</option>
				<option>фантастика</option>
				<option>документальный</option>
				<option>военный</option>
				<option>исторический</option>
				<option>биография</option>
				<option>вестерн</option>
				<option>мкльтфильм</option>
				<option>детектив</option>
				<option>аниме</option>
			</select>
			<select  name="strana" class="row__selsect">
				<option>Страны</option>
				<option>США</option>
				<option>СССР</option>
				<option>Франция</option>
				<option>Великобритания</option>
				<option>Беларусь</option>
				<option>Россия</option>
				<option>Германия</option>
				<option>Гонконг</option>
				<option>Индия</option>
				<option>Испания</option>
				<option>Италия</option>
				<option>Казахстан</option>
				<option>Канада</option>
				<option>Украина</option>
				<option>Япония</option>
				<option>Австралия</option>
				<option>Бельгия</option>
				<option>Польша</option>
				<option>Китай</option>
				<option>Швеция</option>
				<option>Дания</option>
				<option>Южная Корея</option>
				<option>Австрия</option>
				<option>Израиль</option>
				<option>Турция</option>
				<option>Колумбия</option>
				<option>Швейцария</option>
				<option>другое...</option>
			</select>
		</div>
		<p>описание</p>
		<textarea class="column__textarea" name="description" placeholder = "Количество символов не должно превышать 1150..."></textarea>
		
		<p>рейтинг фильма от 0 до 10 по IMDb</p>
		<input class="column__input" type="number" name="rang" step="any" >
		<div class="row">
			<div class="column">
				<p>установите заставку фильма</p>
				<input class="column__file" type="file" name="loadImg" id="imgFile"/>
			</div>
			<div class="column">
				<p>Установите ссылку видеоплеера</p>
				<input class="column__file" type = "text"  name="loadPlayerLink" >
			</div>
		</div>
		<p>дата выхода</p>
		<input class="column__input" type="date" name="data">
	
		<p>длительность в минутах</p>
		<input class="column__input" type="number" name="time"></br></br></br>
	
		<button class="column__button" id="buton" name="submit" type="submit">Добавить</button>
	</div>
	
</div>';
				exit();
	}else{
			echo'
					<div class="column">
					<h2 class="column__title">Админ панель</h2>
					<p class="column__text">введите логин от админ панели</p>
					<input class="column__input" type = "text" name="login">
					<p class="column__text">введите пароль от админ панели</p>
					<input class="column__input" type = "password" name = "pass">
					<button class="column__button" type="submit" name="admin">войти</button>
					</div>
				';exit();
	}
	}if($session == 1){ 
		
			echo ' <center>
	<h2>Добро пожаловать на KINgaroo admin.</h2>
	<p>
		Здесь вы можете добавить фильм на сайт KINgaroo.</br>
		Заполните все поля что бы добавить фильм на сайт!
	</p>
</center>
<div class="center">
	<div class="column">
		<p>название фильма</p>
		<input class="column__input" type="text" name="name">
		<p>Укажите жанр фильма страну его выпуска</p>
		<div class="row">
			
			<select  name="janr" class="row__selsect">
				<option>Жанры</option>
				<option>комедия</option>
				<option>триллер</option>
				<option>боевик</option>
				<option>мелодрамма</option>
				<option>криминал</option>
				<option>драма</option>
				<option>ужасы</option>
				<option>приключения</option>
				<option>семейные</option>
				<option>фантастика</option>
				<option>документальный</option>
				<option>военный</option>
				<option>исторический</option>
				<option>биография</option>
				<option>вестерн</option>
				<option>мкльтфильм</option>
				<option>детектив</option>
				<option>аниме</option>
			</select>
			<select  name="strana" class="row__selsect">
				<option>Страны</option>
				<option>США</option>
				<option>СССР</option>
				<option>Франция</option>
				<option>Великобритания</option>
				<option>Беларусь</option>
				<option>Россия</option>
				<option>Германия</option>
				<option>Гонконг</option>
				<option>Индия</option>
				<option>Испания</option>
				<option>Италия</option>
				<option>Казахстан</option>
				<option>Канада</option>
				<option>Украина</option>
				<option>Япония</option>
				<option>Австралия</option>
				<option>Бельгия</option>
				<option>Польша</option>
				<option>Китай</option>
				<option>Швеция</option>
				<option>Дания</option>
				<option>Южная Корея</option>
				<option>Австрия</option>
				<option>Израиль</option>
				<option>Турция</option>
				<option>Колумбия</option>
				<option>Швейцария</option>
				<option>другое...</option>
			</select>
		</div>
		<p>описание</p>
		<textarea class="column__textearea" name="description" placeholder = "Количество символов не должно превышать 1150..."></textarea>
		
		<p>рейтинг фильма от 0 до 10 по IMDb</p>
		<input class="column__input" type="number" name="rang" step="any" >
		<div class="row">
			<div class="column">
				<p>установите заставку фильма</p>
				<input class="column__file" type="file" name="loadImg" id="imgFile"/>
			</div>
			<div class="column">
				<p>Установите ссылку видеоплеера</p>
				<input class="column__file" type = "text"  name="loadPlayerLink" >
			</div>
		</div>
		<p>дата выхода</p>
		<input class="column__input" type="date" name="data">
	
		<p>длительность в минутах</p>
		<input class="column__input" type="number" name="time"></br></br></br>
	
		<button class="column__button" id="buton" name="submit" type="submit">Добавить</button>
	</div>
	
</div>';
	exit();}

?>	
</center>
</form>
</body>
</html>
