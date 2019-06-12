<?php
	function power($val, $pow)
	{
		
		if ($val == 0) {
			return 0;
		}
		elseif ($val == 1){
			return 1;
		}
		
		if ($pow == 0) {
			return 1;
		}
		elseif ($pow == 1) {
			return $val;
		}
		elseif ($pow < 0) {
			return power(1/$val, -$pow);
		}
		return $val*power($val, $pow-1);
	}
	$a = 5;
	$b = 10;

	echo "чиcло $a в степени $b = ".power($a, $b);
?>
