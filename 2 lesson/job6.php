<?php
	function power($val, $pow)
	{
		if((int)$pow !== 1){
			return $val * power($val, $pow - 1);
		} else {
			return $val;
		}
	}
	$a = 5;
	$b = 10;

	echo "чиcло $a в степени $b = ".power($a, $b);
?>