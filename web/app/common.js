/**
 * @desc   ajax提交表单
 * @author RZLIAO
 * @date   2015-11-18
 */
function ajaxSubmitForm(form, func)
{
    $.ajax({
        url: $(form).attr('action'),
        type: $(form).attr('method'),
        data: $(form).serialize(),
        beforeSend: function () {
            layer.load();
        },
        complete: function () {
            layer.closeAll('loading');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.alert('出错拉:' + textStatus + ' ' + errorThrown, {icon: 5});
        },
        success: function (data) {
            if (!$.isFunction(func)) {
                func = function (data) {
                    data.url ? window.location.href = data.url : null;
                }
            }
            if (data.status == 1)
            {
                layer.alert(data.message, {icon: 6}, function (index) {
                    layer.close(index);
                    func(data);
                });
            }
            else {
                layer.alert(data.message, {icon: 5}, function (index) {
                    layer.close(index);
                    func(data);
                });
            }
        }
    });
    return false;
}
//时间格式化
Date.prototype.format = function (format) {
    var o = {
        "M+": this.getMonth() + 1, //month
        "d+": this.getDate(), //day
        "h+": this.getHours(), //hour
        "m+": this.getMinutes(), //minute
        "s+": this.getSeconds(), //second
        "q+": Math.floor((this.getMonth() + 3) / 3), //quarter
        "S": this.getMilliseconds() //millisecond
    }

    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}
//封闭时间选择from to
function customDatepicker(from, to) {
    $(from).datepicker({
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $(to).datepicker("option", "minDate", selectedDate);
        }
    }).keyup(function (e) {
        if (e.keyCode == 8 || e.keyCode == 46) {
            $.datepicker._clearDate(this);
        }
    });
    $(to).datepicker({
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $(from).datepicker("option", "maxDate", selectedDate);
        }
    }).keyup(function (e) {
        if (e.keyCode == 8 || e.keyCode == 46) {
            $.datepicker._clearDate(this);
        }
    });
}
function getUrlParam(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
}
