<?php
$a = 5;
$b = -2;
if($a>= 0 && $b >= 0) {
	$result = $a - $b;
	echo "$a - $b = ".$result ;
}else if($a < 0 && $b < 0) {
	$result = $a * $b;
	echo "$a * $b = ".$result ;
} else {
	$result = $a + $b;
	echo "$a + $b = ".$result ;
}
?>