<?php
function translitSubSpace($str){
	$arr=[
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh','з' => 'z', 'и' => 'i', 'й' => 'i', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch','ь' => '', 'ы' => 'y', 'ъ' => '',  'ш' => 'sh','щ' => 'shch', 'э' => 'e', 'ю' => 'yu','я' => 'ya','А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh','З' => 'Z', 'И' => 'I', 'Й' => 'I', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch','Ш' => 'Sh','Щ' => 'Shch', 'Ь' => '',  'Ы' => 'Y', 'Ъ' => '',  'Э' => 'E', 'Ю' => 'Yu','Я' => 'Ya', ' ' => '_'
	];

	$result_str = strtr($str, $arr);
	return $result_str;
}


echo translitSubSpace('Вместо пробелов должны быть подчеркивания и все это написанно на транслите');
?>