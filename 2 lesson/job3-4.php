<?php 

function summ($x, $y)
{
	return $x + $y;
}

function diff($x, $y)
{
	return $x - $y;
}

function multiply($x, $y)
{
	return $x * $y;
}

function division($x, $y = 1)
{
	return $x / $y;
}

function mathOperation($arg1, $arg2, $operation)
{
	$ret = 0;

	switch ($operation) {
		case '+':
			$ret = summ($arg1, $arg2);
			break;
		case '-':
			$ret = diff($arg1, $arg2);
			break;
		case '*':
			$ret = multiply($arg1, $arg2);
			break;	
		case '/':
			$ret = division($arg1, $arg2);
			break;
		default:
			echo "Операция $operation не поддерживается";  
			break;
	}

	return $ret;
}

$a = 2;
$b = 4;
$op = "+";
echo "если с числом $a и $b сделать операция $op то результат будет равен ".mathOperation($a, $b, $op)."<br>";

$op = "-";
echo "если с числом $a и $b сделать операция $op то результат будет равен ".mathOperation($a, $b, $op)."<br>";

$op = "*";
echo "если с числом $a и $b сделать операция $op то результат будет равен ".mathOperation($a, $b, $op)."<br>";

$op = "/";
echo "если с числом $a и $b сделать операция $op то результат будет равен ".mathOperation($a, $b, $op)."<br>";

?>