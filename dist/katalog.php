<!DOCTYPE html>
<html>
<head>
	<title>work</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/modification.css">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<meta name = "description" content = "В каталоге можно найти и посмотреть интересное кино различных жанров">
</head>
<body>
<form method="POST" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
	<header>
		<div class="headerCenter">
			<div class="logo">
				<a href="./index.php"><img class="logo__img" src="./img/Logo.png" alt=""></a>
				<a href="./index.php"><h1 class="logo__title">KINgaroo</h1></a>
			</div>
			<div class="headerCenter__menu desktop">
				<ul class="headerCenter__ul">
					<li class="headerCenter__li"><a class="headerCenter__link" href="./index.php">Главная</a></li>
					<li class="headerCenter__li"><a class="headerCenter__link" href="katalog.php">Каталог</a></li>
					<li class="headerCenter__li"><a class="headerCenter__link" href="./index.php">Новинки</a></li>
					<li class="headerCenter__li"><a class="headerCenter__link" href="./index.php">Популярное</a></li>
				</ul>
			</div>
			</div>
			<div class="headerCenter__clickBlock mobile">
				<div class="headerCenter__click" id="click">
				
				</div>
			</div>
		</div>
		
	</header>
	<nav class="navigation">
		<ul class="navigation__ul">
			<li class="navigation__li"><a class="navigation__link" href="index.php">Главная</a></li>
			<li class="navigation__li"><a class="navigation__link" href="katalog.php">Каталог</a></li>
			<li class="navigation__li"><a class="navigation__link" href="index.php">Новинки</a></li>
			<li class="navigation__li"><a class="navigation__link" href="index.php">Популярное</a></li>
		</ul>
	</nav>
	<section class="filter background_light">
		<div class="blockSearch background_light">
			<div class="blockSearch__element">
				<input class="blockSearch__input" type="text" name="search">
				<button type="submit" name="go" class="blockSearch__button color_searchButton">Найти</button>
				
			</div>
		</div>
		<div class="typeVideo">
			<p class="typeVideo__text"><a class="typeVideo__link" href ="">Фильмы</a></p>
			<p class="typeVideo__text"><a class="typeVideo__link" href ="./error.html">Сериалы</a></p>
		</div>
		<div class="filters">
			<select class="filters__select" name="janr">
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
			<select class="filters__select" name="strana">
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
			<p class="filters__text">Сортировать по:</p>
			<span class="filters__check"><input class="filters__input" type="checkbox" name="rang" id="rang">Рейтингу</span>
			<span class="filters__check"><input class="filters__input" type="checkbox" name ="new" id="new">Сначало новые</span>
			<span class="filters__check"><input class="filters__input" type="checkbox" name ="time" id="time">По продолжительности</span>
			<span class="filters__check"><input class="filters__input" type="checkbox" name="alphabet" id="alphabet">По алфавиту</span>
		</div>
	</section>
	<section>
		<div class="newFilms">
		<?php
			$conect = mysqli_connect('localhost','root','','films');
					if (isset($_POST['go'])){

						$janr = mysqli_real_escape_string($conect, trim($_POST['janr']));
						$strana = mysqli_real_escape_string($conect, trim($_POST['strana']));
						$rang = mysqli_real_escape_string($conect, trim($_POST['rang']));
						$new = mysqli_real_escape_string($conect, trim($_POST['new']));
						$time = mysqli_real_escape_string($conect, trim($_POST['time']));
						$alphabet = mysqli_real_escape_string($conect, trim($_POST['alphabet']));
						$input =  mysqli_query($conect,"SELECT `name`,`img`,`style`,`country` FROM `film` ");
						$filmName = mysqli_real_escape_string($conect, trim($_POST['search']));
						$filmName = preg_replace_callback('~(?<=\\A|[.!?])\\s*?[a-zа-яё]~u', function($m) {
							return mb_strtoupper($m[0], 'UTF-8');
						}, $filmName);
					
						$sear =  mysqli_query($conect,"SELECT `img`,`name`,`style` FROM `film`");
						while ($result_sear = mysqli_fetch_array($sear)){
							//echo $filmName;
							if($filmName == $result_sear['name']){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_sear['name'].'" style= "background-image:url('.$result_sear['img'].')" >
										<a href="film\\'.$result_sear['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_sear['name'].'</h3>
									<p class="newFilms__text">'.$result_sear['style'].'</p>
									</div>';
							}
						}
						
						
						
						while ($result_input = mysqli_fetch_array($input)){
							
							if(($result_input['style'] == $janr or $result_input['country'] == $strana) and $new != 'on' and $rang != 'on' and $time != 'on' and $alphabet != 'on' and $filmName ==''){
							
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_input['name'].'" style= "background-image:url('.$result_input['img'].')" >
										<a href="film\\'.$result_input['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_input['name'].'</h3>
									<p class="newFilms__text">'.$result_input['style'].'</p>
									</div>';
								
							}if(($janr =='Жанры' and $strana == 'Страны') and $new != 'on' and $rang != 'on' and $time != 'on' and $alphabet != 'on' and $filmName ==''){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_input['name'].'" style= "background-image:url('.$result_input['img'].')" >
										<a href="film\\'.$result_input['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_input['name'].'</h3>
									<p class="newFilms__text">'.$result_input['style'].'</p>
									</div>';
							}
							
							
						
						}
					
					if($rang == 'on'){
						
						$sort = mysqli_query($conect,"SELECT `name`,`img`,`style`,`country` FROM `film` ORDER BY `rang` DESC ");
						while ($result_sort = mysqli_fetch_array($sort)){
							if($result_sort['style'] == $janr or $result_sort['country'] == $strana and $filmName ==''){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_sort['name'].'" style= "background-image:url('.$result_sort['img'].')" >
										<a href="film\\'.$result_sort['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_sort['name'].'</h3>
									<p class="newFilms__text">'.$result_sort['style'].'</p>
									</div>';
							}if($janr =='Жанры' and $strana == 'Страны' and $filmName ==''){
							echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_sort['name'].'" style= "background-image:url('.$result_sort['img'].')" >
										<a href="film\\'.$result_sort['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_sort['name'].'</h3>
									<p class="newFilms__text">'.$result_sort['style'].'</p>
									</div>';
									
							}
							
							
						}
						
					}if($new == 'on'){
						$now = mysqli_query($conect,"SELECT `name`,`img`,`style`,`country` FROM `film` ORDER BY `data` DESC ");
						while ($result_now = mysqli_fetch_array($now)){
							if($result_now['style'] == $janr or $result_now['country'] == $strana and $filmName ==''){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_now['name'].'" style= "background-image:url('.$result_now['img'].')" >
										<a href="film\\'.$result_now['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_now['name'].'</h3>
									<p class="newFilms__text">'.$result_now['style'].'</p>
									</div>';
							}if(($janr =='Жанры' and $strana == 'Страны' and $filmName =='')){
							echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_now['name'].'" style= "background-image:url('.$result_now['img'].')" >
										<a href="film\\'.$result_now['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_now['name'].'</h3>
									<p class="newFilms__text">'.$result_now['style'].'</p>
									</div>';
									
							}
						}
					}if($time == 'on'){
						$short = mysqli_query($conect,"SELECT `name`,`img`,`style`,`country` FROM `film` ORDER BY `time`");
						while ($result_short = mysqli_fetch_array($short)){
							if($result_short['style'] == $janr or $result_short['country'] == $strana and $filmName ==''){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_short['name'].'" style= "background-image:url('.$result_short['img'].')" >
										<a href="film\\'.$result_short['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_short['name'].'</h3>
									<p class="newFilms__text">'.$result_short['style'].'</p>
									</div>';
							}if($janr =='Жанры' and $strana == 'Страны' and $filmName ==''){
							echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_short['name'].'" style= "background-image:url('.$result_short['img'].')" >
										<a href="film\\'.$result_short['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_short['name'].'</h3>
									<p class="newFilms__text">'.$result_short['style'].'</p>
									</div>';
									
							}
						}
					}if($alphabet == 'on'){
						$alph = mysqli_query($conect,"SELECT `name`,`img`,`style`,`country` FROM `film` ORDER BY `name`");
						while ($result_alph = mysqli_fetch_array($alph)){
							if($result_alph['style'] == $janr or $result_alph['country'] == $strana and $filmName ==''){
								echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_alph['name'].'" style= "background-image:url('.$result_alph['img'].')" >
										<a href="film\\'.$result_alph['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_alph['name'].'</h3>
									<p class="newFilms__text">'.$result_alph['style'].'</p>
									</div>';
							}if(($janr =='Жанры' and $strana == 'Страны' and $filmName =='')){
							echo '<div class="newFilms__element">
									<div class="newFilms__img" id ="'.$result_alph['name'].'" style= "background-image:url('.$result_alph['img'].')" >
										<a href="film\\'.$result_alph['name'].'.php"><div class="newFilms__hover">
										<span class="newFilms__button">Смотреть</span>
										</div></a>
									</div>
									<h3 class="newFilms__title">'.$result_alph['name'].'</h3>
									<p class="newFilms__text">'.$result_alph['style'].'</p>
									</div>';
									
							}
						}
					}
				}else{
						$standart =  mysqli_query($conect,"SELECT `name`,`img`,`style` FROM `film`");
						while ($result_standart = mysqli_fetch_array($standart)){
						echo '<div class="newFilms__element">
								<div class="newFilms__img" id ="'.$result_standart['name'].'" style= "background-image:url('.$result_standart['img'].')" >
									<a href="film\\'.$result_standart['name'].'.php"><div class="newFilms__hover">
									<span class="newFilms__button">Смотреть</span>
									</div></a>
								</div>
								<h3 class="newFilms__title">'.$result_standart['name'].'</h3>
								<p class="newFilms__text">'.$result_standart['style'].'</p>
								</div>';
						}
						
					}
					
					
				
				
			?>
		</div>
	</section>
	<footer class="footer">
		<div class="footer__center">
			
			<div class = "footer__element">
				<p class="footer__text">О проекте</p>
				<p class="footer__text">Обратная связь</p>
				<p class="footer__text">Партнерам</p>
			</div>
			<div class = "footer__element">
				<p class="footer__text">Новости</p>
				<p class="footer__text">Продукты</p>
				<p class="footer__text">Партнерам</p>
			</div>
			<div class = "footer__element">
				<p class="footer__text">Kinguru.com - все права зашищены</p>
			</div>
		</div>
		<div class="footer__end">
			<img class="footer__img"src="./img/facebook.svg">
			<img class="footer__img"src="./img/telegram.svg">
			<img class="footer__img"src="./img/vk.svg">
		</div>
	</footer>
<script src="./js/jquery-3.3.1.js"></script>
<script src="./js/main.js"></script>
<script src="./js/checkbox.js"></script>
</body>
</html>