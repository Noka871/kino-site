var search = document.getElementById('clickSearch');
$('#oneSearch').hide();
var click = 0;
search.onclick = function(){
	click++;
	if(click == 1){
		$('#oneSearch').show();
	}else{
		click = 0;
		if(click == 0){
			$('#oneSearch').hide();
		}
	}
}