<?php

require_once '../config/config.php';


echo "<pre>";
var_dump($_COOKIE);
var_dump(array_keys($_COOKIE['cart']));
echo "</pre>";


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Новости',
	'h1' => 'Горячие новости',
	'content' => ''
]);
