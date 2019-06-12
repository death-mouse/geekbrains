<?php
function subSpace($str){
	$arr=[
		' ' => '_'
	];

	return strtr($str, $arr);

}

echo subSpace('Вместо пробелов должны быть подчеркивания');
?>
