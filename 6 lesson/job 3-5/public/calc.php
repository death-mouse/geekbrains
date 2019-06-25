<?php

$a =  0;
$b =  0;
$c = 0;
if( isset(  $_POST["a"]) ){
	$a = $_POST["a"]; 
}

if(  isset( $_POST["b"] ) )
{
	$b = $_POST["b"]; 
}
if(  isset( $_POST["oper"] ) )
{
	$oper = $_POST["oper"] ;
}
?>


<form method="POST">
	<input type="number" name="a" value="<?=$a?>">
	<input type="number" name="b" value="<?=$b?>">
	<select name="oper">
	<?php 
	if($oper ){
		if( $oper == '+'){
			echo "<option selected>+</option>";
		}
		else{
			echo "<option>+</option>";
		}
		if( $oper == '-'){
			echo "<option selected>-</option>";
		}
		else{
			echo "<option>-</option>";
		}
		if(  $oper == '*'){
			echo "<option selected>*</option>";
		}
		else{
			echo "<option>*</option>";
		}
		if(  $oper == '/'){
			echo "<option selected>/</option>";
		}
		else{
			echo "<option>/</option>";
		}
	}
	else
	{
		echo "<option>+</option>
		<option>-</option>
		<option>*</option>
		<option>/</option>";
	}
	?>
	</select>
	<input type="submit" name="button">
</form>

<?php
if( $_POST ){
	switch ( $oper ) {
		case '+':
			$c = $a + $b;
			break;
		case '-':
			$c = $a - $b;
			break;
		case '*':
			$c = $a * $b;
			break;
		case '/':
			if((int)$b  == 0){
				echo "<h1><font color=red>Делить на 0 нельзя</font></h1>";
			}
			else{
				$c = $a / $b;
			}
			break;		
	}

	if( $oper == '/' && $b == 0){
		echo "<h1>Ошибка в расчетах</h1>";
	}
	else{
		echo "<h1>Ваш ответ: $a  $oper  $b = $c</h1>";
	}
}
?>

