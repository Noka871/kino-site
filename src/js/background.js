var img = new Array();
	img[0] = './img/img1.png';
	img[1] = './img/img2.png';
	img[2] = './img/img3.png';
	var rand = Math.random();
	rand = rand *3;
	rand = Math.floor(rand);
	rand = img[rand];
	var body = document.getElementById('body');
	body.style.backgroundImage = 'url('+rand +')';