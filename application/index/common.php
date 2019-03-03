<?php

function unique($arr){
	foreach ($arr as $k => $v) {
		$v=join(',',$v);
		$temp[]=$v;
	}
	if($temp){
		$temp=array_unique($temp);
		foreach ($temp as $k => $v) {
			$temp[$k]=explode(',',$v);
		}
		return $temp;
	}
}