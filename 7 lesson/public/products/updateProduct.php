<?php

require_once '../../config/config.php';

echo '<pre>';
var_dump($_POST);
var_dump($_FILES);
echo '</pre>';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

//обезопашиваемся от инъекций
$id = (int)$id;

$product = getProduct($id);

if (!$product) {
	echo '404';
	exit();
}

//?? - заменяет isset($a) ? $a : '';
$name = $_POST['name'] ?? $product['name'];
$description = $_POST['description'] ?? $product['description'];
$price = $_POST['price'] ?? $product['price'];
$file = $_FILES['image'] ?? [];


if(
	$name !== $product['name']
	|| $description !== $product['description']
	|| $price !== $product['price']
	|| ($file && !$file['error'])
) {
	if($name && $price !== false) {
		//пытаемся отредактировать продукт
		$result = updateProduct($id, $name, $description, $price, $file);

		if($result) {
			echo 'Товар отредактирован<br>';
		} else {
			echo 'Произошла ошибка<br>';
		}
	} else {
		echo 'Недостаточно данных<br>';
	}

}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => "Редактировать товар $name",
	'h1' => "Редактировать товар $name",
	'content' => render(TEMPLATES_DIR . 'updateProduct.tpl', [
		'id' => $id,
		'name' => $name,
		'description' => $description,
		'price' => $price
	])
]);
