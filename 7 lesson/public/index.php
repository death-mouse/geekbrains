<?php

require_once '../config/config.php';



if (isset($_GET['addToCart'])) {
	$id = $_GET['id'];
	$cart = unserialize($_COOKIE['cart']);
	$cart[$id] = $cart[$id] ?? 0;
	$cart[$id]++;
	setcookie('cart', serialize($cart));	
}

// setcookie('cart', $cart);


// $id = 1;






echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Новости',
	'h1' => 'Горячие новости',
	'content' => ''
]);
