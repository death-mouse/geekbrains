<?php

require_once '../config/config.php';



if (empty($_SESSION['login'])) {
	header('Location: /login.php');
}



echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Привет',
	'h1' => 'Андрей',
	'content' => generateMyOrdersPage(),
]);
