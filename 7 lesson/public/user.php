<?php
require_once __DIR__ . '/../config/config.php';

if(!isset($_SESSION['login']))
{
	header('Location: http://'.$_SERVER['HTTP_HOST']."/login.php");
	exit();
}

$users = $_SESSION['login'];


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Geek Brains Site',
	'h1' => 'Корзина товаров',
	'content' => render(TEMPLATES_DIR . 'user.tpl', [ "NAME" => $users["name"], "LOGIN" => $users["login"]])
]);

?>