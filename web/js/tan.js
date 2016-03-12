
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

/*** 这是等级列表的特效 START ***/
$('body').on('click', '#add', function(){
	var aa  = $('#moneylog .control-label').length + 1;
	if(aa >9){
		layer.msg('最多新增9代')
		return false
	}
	var str = '<div class="form-group"> <label class="col-lg-4 control-label"> '+ aa +'代佣金（%）：</label> <div class="col-lg-3"> <input type="text" value="0" name="Level[num][]" class="form-control" id="level-tz_money"> </div> </div>';
	$('#moneylog').append(str);
 })

$('body').on('click', '#del', function(){
	var aa  = $('#moneylog .control-label').length;
	if(aa <= 1){
		layer.msg('最少保留一代')
		return false
	}
	$('#moneylog .control-label').eq(aa-1).parent('.form-group').remove()
 })
/*** 这是等级列表的特效 END ***/



