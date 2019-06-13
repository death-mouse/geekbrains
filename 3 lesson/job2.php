<?php
function eventOrOddNymber($num, $num_end) {
	do {
		if ($num == 0) {
			echo $num.' - ноль.<br>';
		} elseif ($num % 2 == 0) {
			echo $num.' - четное число.<br>';
		} else {
			echo $num.' - нечетное число.<br>';
		}
		$num++;
	} while ($num <= $num_end);
}

eventOrOddNymber(0,10);

?>