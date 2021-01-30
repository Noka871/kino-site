<?php
	if(isset($_POST['go'])){
		header('Location: katalog.php');
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
	<meta name = "description" content = "На нашем сайте вы найдете годные фильмы и сможете смотреть кино бесплатно без реклам">
</head>
<body>
<form method="POST" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
	<header>
		<div class="headerCenter">
			<div class="logo">
				<a href="index.php"><img class="logo__img" src="./img/Logo.png" alt=""></a>
				<a href="index.php"><h1 class="logo__title">KINgaroo</h1></a>
			</div>
			<div class="headerCenter__menu desktop">
				<ul class="headerCenter__ul">
					<li class="headerCenter__li"><a class="headerCenter__link" href="index.php">Главная</a></li>
					<li class="headerCenter__li"><a class="headerCenter__link" href="katalog.php">Каталог</a></li>
					<li class="headerCenter__li" id = "newD"><a class="headerCenter__link" href="#new">Новинки</a></li>
					<li class="headerCenter__li" id = "topD"><a class="headerCenter__link" href="#top">Популярное</a></li>
				</ul>
			</div>
				<div class="search">
					<img class="search__img" id="clickSearch" src="./img/search.png">
				</div>
			</div>
			<div class="headerCenter__clickBlock mobile">
				<div class="headerCenter__click" id="click">
				
				</div>
			</div>
		</div>
		
	</header>
	<div class="blockSearch"id = "oneSearch">
		<div class="blockSearch__element">
			<input class="blockSearch__input" type="text" name="search">
			<button type="submit" name="go" class="blockSearch__button">Найти</button>
		</div>
	</div>
	<nav class="navigation">
		<ul class="navigation__ul">
			<li class="navigation__li"><a class="navigation__link" href="index.php">Главная</a></li>
			<li class="navigation__li"><a class="navigation__link" href="katalog.php">Каталог</a></li>
			<li class="navigation__li" id="newM"><a class="navigation__link" href="#new">Новинки</a></li>
			<li class="navigation__li" id="topM"><a class="navigation__link" href="#top">Популярное</a></li>
		</ul>
		<div class="blockSearch" id = "twoSearch">
			<div class="blockSearch__element">
				<input id="filmName" class="blockSearch__input" type="text" name="search">
				<button id="go" type="submit" name="go" class="blockSearch__button">Найти</button>
			</div>
		</div>
	</nav>
	<section>
		<div class="slider">
		
			
			<div class="slider__content">
				<div class="img first">
				</div>
				<div class="img">
				</div>
				<div class="img">			
				</div>
				<div class="img">			
				</div>
				<div class="img">				
				</div>
			</div>
			<img class="slider__go" id="previous" src="./img/next2.png">
			<div class="slider__checked">
				<span class="slider__point first" id="Check0"></span>
				<span class="slider__point" id="Check1"></span>
				<span class="slider__point" id="Check2"></span>
				<span class="slider__point" id="Check3"></span>
				<span class="slider__point" id="Check4"></span>
			</div>
			<img class="slider__go" id="next" src="./img/next1.png">
		</div>
		
	</section>
	<section class="generlaText">
		<center>
			<div class="generlaText__center">
			<h1 class="generlaText__title">KINgaroo - Только годные фильмы!</h1>
			<p>
				На KINgaroo вы сможете выбрать и посмотреть кино на любой вкус.
				У нас вы найдете интересные фильмы в качественной озвучке и высоком качестве.
				Нашу базу видео материалов пополняют ежедневно, не только новинки киноиндустрии, но и классические фильмы.
				На странице фильма вы можете ознакомиться с его описанием и рейтингом IMDb
			</p>
			<p>
				У нас на сайте реклама не мешает просмотру, так как в нашем плеере ее нет.
				Что позволяет смотреть фильмы без рекламы бесплатно.
				Наш сайт адаптирован под большинство видов устройств
				и за счет хорошей оптимизации и минимального использования скриптов
				вы можете пользоваться сайтом на мобильном телефоне не тратя нервы и время на долгую загрузку сайта.
			</p>
		</div>
		</center>
	</section>
	<section>
		<div class="nameSection">
			<center>
				<h2 class="nameSection__title">Новинки</h2>
				<div class="nameSection__line">
				</div>
			</center>
		</div>
		<div class="newFilms">
			<?php
				$conect = mysqli_connect('localhost','root','','films');
				$date = mysqli_query($conect, "SELECT `data`,`name`,`img`, `style` FROM `film`  ORDER BY `data` DESC LIMIT 42");
				while($result_date = mysqli_fetch_array($date)){
					echo '<div class="newFilms__element">
							<div class="newFilms__img" id ="'.$result_date['name'].'" style= "background-image:url('.$result_date['img'].')" >
								<a href="film\\'.$result_date['name'].'.php"><div class="newFilms__hover">
								<span class="newFilms__button">Смотреть</span>
								</div></a>
							</div>
							<h3 class="newFilms__title">'.$result_date['name'].'</h3>
							<p class="newFilms__text">'.$result_date['style'].'</p>
							</div>';	
				}
					
					
				
				
			?>
		</div>
		<div class="nameSection">
			<center>
				<h2 class="nameSection__title">Популярное</h2>
				<div class="nameSection__line">
				</div>
			</center>
		</div>
		<div class="newFilms">
			<?php
			$conect = mysqli_connect('localhost','root','','films');
			$pop = mysqli_query($conect, "SELECT `name`,`img`,`style` FROM `film`  ORDER BY `rang` DESC LIMIT 42");
			while($result_pop = mysqli_fetch_array($pop)){
				echo '<div class="newFilms__element">
						<div class="newFilms__img" id ="'.$result_pop['name'].'" style= "background-image:url('.$result_pop['img'].')" >
							<a href="film\\'.$result_pop['name'].'.php"><div class="newFilms__hover">
							<span class="newFilms__button">Смотреть</span>
							</div></a>
						</div>
						<h3 class="newFilms__title">'.$result_pop['name'].'</h3>
						<p class="newFilms__text">'.$result_pop['style'].'</p>
						</div>';
						
						
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
</form>

<script src="./js/jquery-3.3.1.js"></script>
<script src="./js/main.js"></script>
</body>
</html>
