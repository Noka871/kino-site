var element = document.getElementById('click');
$('.navigation').hide();
$('#twoSearch').hide()
var click2 = 0
element.onclick = function(){
	click2++
	$('#oneSearch').hide();
	$('.navigation').show();
	$('#twoSearch').show();
	//$('.blockSearch').hide();
	click = 0
		if(click2 == 2){
			$('.navigation').hide();
			$('#twoSearch').hide();
			click2 = 0;
		}
	$(window).resize(function() { 
		if(document.body.clientWidth>750){
			$('#twoSearch').hide();
			$('.navigation').hide();
			click2 = 0
		}
	})
}
