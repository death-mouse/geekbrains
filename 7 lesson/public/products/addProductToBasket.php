<?php
require_once __DIR__ . '/../../config/config.php';

if(!isset($_SESSION['login']))
{
	header('Location: http://'.$_SERVER['HTTP_HOST']."/login.php");
	exit();
}

$users = $_SESSION['login'];

if( insertProductToBaskets($users["id"], $_GET["id"], $_GET["amount"]) )
{
	echo "Товар добавлен";
}
else
{
		echo "Ошибка при добавление товара в корзину";
}

header('Location: http://'.$_SERVER['HTTP_HOST']."/baskets.php");
	exit();

?>