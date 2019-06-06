<?php 
$a=1;
$b=2;
echo  "Было а = ".$a." b = ".$b."<br/>";
$a = $a ^ $b;
$b = $b ^ $a;
$a = $a ^ $b;
echo  "Стало а = ".$a." b = ".$b;
?>
<br/>
<?php
    $a = 5;
    $b = '05';
    var_dump($a == $b);         // Почему true?
    var_dump((int)'012345');     // Почему 12345?
    var_dump((float)123.0 === (int)123.0); // Почему false?
    var_dump((int)0 === (int)'hello, world'); // Почему true?
?>