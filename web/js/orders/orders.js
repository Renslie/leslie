var oenid = 0,
    twoid = 0,
    onemm = 0;

function searchOrder(id, mm) {
    oenid = id;
    onemm = parseInt(mm);
    $.post('?r=orders/search', {
        id: id
    }, function(data) {
        if (data.status == 0) {
            layer.alert(data.message)
        } else {
            $('.them3 tbody').html(data);
            pop_Up3();
        }
    })
}
$('#pipei').click(function() {
    if (oenid == 0) return false;
    layer.confirm('确认匹配订单？', {
        icon: 1,
        title: '提示'
    }, function(index) {
        layer.close(index);
        var arr = [],
            mon = [];
            mm  = 0;
        $('.them3 tbody input:checked').each(function(index,ele){
            arr.push([$(ele).val(),$(ele).attr('name'),]);
            mm += parseInt($(ele).attr('name'));
        })
        if( mm !=  onemm ){
            layer.alert('选择的金额不对,此订单的金额是 '+ onemm+' ,请选择正确的金额值');
            return false
        }
        $.post('?r=orders/match', {
            one: oenid,
            two: arr,
        }, function(res) {
            layer.alert(res.message, function() {
                if (res.status == 1) {
                    location.reload()
                }
            });
        })
    })
})

function split(id, mon) {
    layer.prompt({
        formType: 3,
        value: '2',
        title: '请输入需要拆分的数量（2~5）'
    }, function(value, index, elem) {
        if (value > 5 || value <= 1) {
            alert('请输入‘2’~‘5’之间的数值');
            return false;
        }
        var str = '';
        for (var i = 1; i <= value; i++) {
            str += '<div class="he_shu"><b>第' + i + '条</b><input class="h_shuru"></div><br />';
        }
		$('#shengyu').text(mon)
        $('#chai').html(str)
        layer.close(index);
        $('#chai .h_shuru').unbind().on('keyup', function() {
			var shengyu = 0;
			$('.h_shuru').each(function(index, ele) {
                if($(ele).val() != '') shengyu += parseInt($(ele).val());
            })
			if((mon-shengyu) < 0){
				$('#shengyu').text('数值填写有误！')
			}else{
				$('#shengyu').text(mon-shengyu)
			}
        })
        pop_Up2();
        $('#chaiSure').unbind().on('click', function() {
            var num = 0,
                arr = [];
            $('.h_shuru').each(function(index, ele) {
                num += parseInt($(ele).val());
                arr.push(parseInt($(ele).val()));
            })
            if (num != mon) {
                alert('输入数值不等于' + mon + '，请重新输入');
                return false;
            }
            $.post('?r=orders/split', {
                id: id,
                arr: arr
            }, function(ret) {
                layer.alert(ret.message, function(index) {
                    if (ret.status == 1) {
                        location.reload()
                    }
                    layer.close(index)
                });
            })
        })
        return false;
    });
}

window.replay = function(id) {
    layer.confirm('确定重新匹配？', function(index) {
        layer.close(index);
        $.post('?r=orders/again', {
            id: id
        }, function(res) {
            layer.alert(res.message, function() {
                if (res.status == 1) {
                    location.reload()
                }
            });
        })
    })
}

$('#auto').click(function() {
    var a = layer.load();
    $.post('?r=orders/autosearch', function(data) {
        layer.close(a);
        if (data.status) {
            layer.alert('暂无可匹配的订单',function(aa){
                layer.close(aa)
            })
            return false;
        }
        $('.them1 tbody').html(data)
        pop_Up1();
    })
})

$('#sureAotu').click(function() {
    var check = $('.them1 tbody input:checked'),
        val = [];
    check.each(function(index, ele) {
        val.push($(ele).val())
    })
    if (val.length == 0) return false;
    $.post('?r=orders/automatch', {
        val: val
    }, function(ret) {
        layer.alert(ret.message, function() {
            if (ret.status == 1) {
                location.reload()
            }
        });
    })
})

$('.selAll,.selNo').on('click', function() {

    if ($(this).attr('name') == '2') {
        $('.i-checks').each(function(aa, bb) {
            if ($(bb).prop('checked') == true) {
                $(bb).prop('checked', false)
            } else {
                $(bb).prop('checked', true)
            }
        })
    } else {
        $('.i-checks').prop('checked', true)
    }

});

window.combine = function(id) {
    if (!id) return false;
    twoid = id;
    $.post('?r=orders/search-combine', {
        id: id
    }, function(res) {
        if (res.status == 0) {
            layer.alert(res.message)
        } else {
            $('.conb tbody').html(res)
            $('.conb').show();
        }
    })
}

$('#hecheng').on('click', function() {
    if (twoid == 0) return false;
    layer.confirm('确认合成订单？', {
        icon: 1,
        title: '提示'
    }, function(index) {
        layer.close(index);
        var id = $('.conb tbody input:checked').val();
        $.post('?r=orders/combine', {
            one: twoid,
            two: id
        }, function(res) {
            layer.alert(res.message, function() {
                if (res.status == 1) {
                    location.reload()
                }
            });
        })
    })
})
