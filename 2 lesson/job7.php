<?php
function over_time($hour, $min)
{
 
    $result = $hour;

    if ($hour > 19) { 
        $hour = $hour % 10; 
    }

    switch ($hour) {
        case 1: 
            $result.=  ' час '; 
            break;
        case 2:
        case 3:
        case 4:  
            $result.=  ' часа '; 
            break;
        default:  
            $result.=  ' часов '; 
            break;
    }

    $result .= $min;
    if ($min > 19) { 
        $min = $min % 10; 
    }
    switch ((int)$min) {
        case 1: 
            $result.=  ' минута'; 
            break;
        case 2:
        case 3:
        case 4: { 
            $result.=  ' минуты'; 
            break; 
        }
        default: 
            $result.=  ' минут';  
            break;
    }
 
    return $result;
}

$hours = date('H');
$minutes =  date('m'); 

echo over_time($hours, $minutes);
?>