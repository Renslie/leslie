
function pop_Up1(){
	$('.theme-popover-mask').show();
	$('.them1').slideDown(200);
}
function pop_Up2(){
	$('.theme-popover-mask').show();
	$('.them2').slideDown(200);
}
function pop_Up3(){
	$('.theme-popover-mask').show();
	$('.them3').slideDown(200);
}

$("body").on('click', '.close,.cancle,.confirm', function(event) {
	$('.theme-popover-mask').hide();
	$('.pop').slideUp(200);
});


