var lowBottomId = document.getElementById('newD');
var hardBottomId = document.getElementById('topD');

var lowBottomIdMobile = document.getElementById('newM');
var hardBottomIdMobile = document.getElementById('topM');
		
$(hardBottomId).on('click', function(){	
	$("html,body").animate({scrollTop:5220},500);
})
$(lowBottomId).on('click', function(){	
	$("html,body").animate({scrollTop:820},500);
})
$(hardBottomIdMobile).on('click', function(){	
	$("html,body").animate({scrollTop:5450},500);
})
$(lowBottomIdMobile).on('click', function(){	
	$("html,body").animate({scrollTop:1050},500);
})

	