<?php

require_once '../../config/config.php';


$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

if (deleteProduct($id)) {
	echo "Товар удален";
} else {
	echo "Произошла ошибка";
}

?>

<a href="/products/">Назад</a>