var one, num, sum, further, prevsum, prevnext; 
var next = document.getElementById('next')
var previous = document.getElementById('previous')
var numSlid;
$(next).on('click',function(){
	 one= $('.img.first');
	 num = $('.img.first').index();
	 sum = num + 1;
	if(sum > 4){
		sum=0;
	}
	numSlid = $('.slider__point.first').index();
	for(numSlid = 0; numSlid<=4;numSlid++){
			let id = document.getElementById('Check'+numSlid);
			if(sum==numSlid || numSlid == prevsum){
				id.style.background ="#90EE90";
			}
			if(sum !=numSlid){
				id.style.background ="#E6E6FA";
			}
		}
	further = $('.img').eq(sum);
	one.fadeOut(1000);
	one.removeClass('first');
	
if (sum ==($('.content:last').index()+1)){
		$('.img').eq(0).fadeIn(500);
		$('.img').eq(0).addClass('first');
	} else{
		further.fadeIn(500);
		further.addClass('first');
	}
	});
$(previous).on('click',function(){
	
	one= $('.img.first');
	num = $('.img.first').index();
	prevsum = num - 1;
	//prevsum = 
	prevnext = $('.img').eq(prevsum);
	if(prevsum < 0){
		prevsum = 4;	
	}
	//alert(prevsum)
	var numSlid2 = $('.slider__point.first').index();
	for(numSlid2 = 4; numSlid2>=0;numSlid2--){
		let id =  document.getElementById('Check'+numSlid2);
		if(numSlid2 == prevsum ){
			id.style.background ="#90EE90";
			
		}
		if(numSlid2 != prevsum){
			id.style.background ="#E6E6FA";
		}
	}
	one.fadeOut(500);
	one.removeClass('first');
	prevnext.fadeIn(500);
	prevnext.addClass('first');
});
var time = setInterval(function(){
	next.click()	
},5000)

$('.slider__point').on('click',function(){
	var idClick = this.id;
	let one= $('.img.first');
	let num = $('.img.first').index();
	sum = num + 1;
	if(sum > 5){
		sum=0;
	}
	for(let numId = 0; numId <= 4; numId++){
		
		let id =('Check' + numId );
		if(idClick == id){
			let idElement = document.getElementById('Check' + numId);
			idElement.style.background = '#90EE90';
			sum = numId;
			let further = $('.img').eq(sum);
			one.fadeOut(1000);
			one.removeClass('first');
			if (sum ==($('.content:last').index()+1)){
				$('.img').eq(0).fadeIn(500);
				$('.img').eq(0).addClass('first');
			} else{
				further.fadeIn(500);
				further.addClass('first');
			}
			
		}else{
			let idElement = document.getElementById('Check' + numId);
			idElement.style.background ="#E6E6FA";
		}
	}
	
})
