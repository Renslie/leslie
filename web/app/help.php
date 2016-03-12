<?php
function dump(){
	header('content-type:text/html;charset=utf-8');
	echo "<pre style='font-size:18px;'>";
	$exit = true;
	$args = func_get_args();
	$num  = func_num_args();
	if($num){
		if($args[$num-1] === 'n'){
			$exit = false;
			array_pop($args);
			$num--;
		}
		for($i = 0;$i < $num;$i++){
			if(is_bool($args[$i]) || !$args[$i]){
				var_dump($args[$i]);
			}else{
				print_r($args[$i]);
			}
			echo '<hr/>';
		}
		if($exit) exit;
	}
	echo '</pre>';
}

function from_time($time){
    $way = time() - $time;
    $r = '';
    if($way < 60){
        $r = '刚刚';
    }elseif($way >= 60 && $way <3600){
        $r = floor($way/60).'分钟前';
    }elseif($way >=3600 && $way <86400){
        $r = floor($way/3600).'小时前';
    }elseif($way >=86400 && $way <2592000){
        $r = floor($way/86400).'天前';
    }elseif($way >=2592000 && $way <15552000){
        $r = floor($way/2592000).'个月前';
    }
    return $r;
}