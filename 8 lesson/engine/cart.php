<?php

/**
 * Получить все товары пользователя
 * @param int $userId
 * @return array
 */
function getCart($userId)
{
	$userId = (int)$userId;
	$sql = "SELECT * FROM `baskets` WHERE `userId` = $userId";

	return getAssocResult($sql);
}

/**
 * Генерирует страницу корзины
 * @param array $cart
 * @return string
 */
function renderProductsCart2()
{
	$cart = getCart($_SESSION['login']['id']);
	
	if(empty($cart)) {
		return 'корзина пуста';
	}

	//получаем айдишники товаров
	$ids = array_column($cart, 'productId');

	//генерируем запрос
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	$products = getAssocResult($sql);

	$products = indexByKey($products, 'id');


	//инициализируем строку контента и сумму корзины
	$content = '';
	$cartSum = 0;
	foreach ($cart as $cartItem) {
		$productId = $cartItem['productId'];
		$product = $products[$productId] ?? false;

		if (!$product) {
			continue;
		}

		$count = $cartItem['amount'];
		$price = $product['price'];
		$productSum = $count * $price;
		//генерируем элемент корзины
		$content .= render(TEMPLATES_DIR . 'cartListItem.tpl', [
			'name' => $product['name'],
			'id' => $product['id'],
			'count' => $count,
			'price' => $price,
			'sum' => $productSum
		]);

		$cartSum += $productSum;
	}

	return render(TEMPLATES_DIR . 'cartList.tpl', [
		'content' => $content,
		'sum' => $cartSum
	]);
}

/**
 * Добавить новый отзыв
 * @param $author
 * @param $content
 * @return bool
 */
function insertToCart($author, $content)
{
	//Создаем подключение к БД
	$db = createConnection();
	//Избоавляемся от всех инъекций в $author и $content
	$author = escapeString($db, $author);
	$content = escapeString($db, $content);

	//Генерируем SQL запрос на добавляение в БД
	$sql = "INSERT INTO `reviews`(`author`, `comment`) VALUES ('$author', '$content')";

	//Выпонляем запрос
	return execQuery($sql, $db);
}
