<?php

require_once '../../config/config.php';

echo '<pre>';
var_dump($_POST);
var_dump($_FILES);
echo '</pre>';

//?? - заменяет isset($a) ? $a : '';
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? false;
$file = $_FILES['image'] ?? [];


if($name || $description || $price !== false) {
	if($name && $description && $price !== false) {
		//пытаемся вставить новую новость
		$result = insertProduct($name, $description, $price, $file);

		//если новость добавлено обнуляем $title и $content
		if($result) {
			echo 'Товар добавленc<br>';
			$name = '';
			$description = '';
			$price = 0;
		} else {
			echo 'Произошла ошибка<br>';
		}
	} else {
		echo 'Недостаточно данных<br>';
	}

}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Создать продукт',
	'h1' => 'Создать продукт',
	'content' => render(TEMPLATES_DIR . 'createProduct.tpl', [
		'name' => $name,
		'description' => $description,
		'price' => $price
	])
]);
