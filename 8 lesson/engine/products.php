<?php

/**
 * Функция получени всех продуктов
 * @return array
 */
function getProducts()
{
	$sql = "SELECT * FROM `products`";

	return getAssocResult($sql);
}

/**
 * Функция получает один продукт по его id
 * @param int $id
 * @return array|null
 */
function getProduct($id)
{
	//для безопасности превращаем id в число
	$id = (int) $id;

	$sql = "SELECT * FROM `products` WHERE `id` = $id";

	return show($sql);
}
function createProductItemsAdmin()
{
	//инициализируем результирующую строку
	$result = '';
	//получаем все изображения
	$products= getProducts();
	
	//для каждого изображения
	foreach ($products as $product) {
		//если изображение существует
		//if(is_file(WWW_DIR . $image['url'])) {
			//в результирующий массив добавляем render изображения
		//	$result .= render(TEMPLATES_DIR . 'galleryItem.tpl', $image);
		//}
		$image = "";
		if(is_file(WWW_DIR . $product["image"])) {
			$image = $product["image"];
		}
		else{
			$image = IMG_DIR . "no-image.jpeg";
		}
		
		$result .= render(TEMPLATES_DIR . 'productItemAdmin.tpl', [ "ITEMNAME" =>  $product["name"],
																"ITEMIMAGE" => $image,
																"ITEMPRIDE" => $product["price"],
																"ID" => $product["id"],
																"DATECREATED" => $product["dateCreate"],
																"DATEEDIT" => $product["dateChange"] == null ? "Не менялся" : $product["dateChange"]
															 ]
					      );
	}
	return $result;
}
/**
 * Функция генерации списка продуктов
 * @return string
 */
function renderProductList()
{
	//инициализируем результирующую строку
	$result = '';
	//получаем все изображения
	$products = getProducts();

	//для каждого изображения
	foreach ($products as $product) {
		//если изображение существует
		if(empty($product['image'])) {
			$product['image'] = 'img/no-image.jpeg';
		}
		$result .= render(TEMPLATES_DIR . 'productsListItem.tpl', $product);
	}
	return render(TEMPLATES_DIR . 'productsList.tpl', ['list' => $result]);
}

/**
 * Генерирует страницу корзины
 * @param array $cart
 * @return string
 */
function renderProductsCart($cart)
{
	if(empty($cart)) {
		return 'корзина пуста';
	}

	//получаем айдишники товаров
	$ids = array_keys($cart);

	//генерируем запрос
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	$products = getAssocResult($sql);


	//инициализируем строку контента и сумму корзины
	$content = '';
	$cartSum = 0;
	foreach ($products as $product) {
		$count = $cart[$product['id']];
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
 * @param int $id
 * @return string
 */
function showProduct($id)
{
	//для безопасности превращаем id в число
	//получаем товар
	$product = getProduct((int) $id);

	if(!$product) {
		return '404';
	}

	//возвращаем render шаблона
	return render(TEMPLATES_DIR . 'productPage.tpl', $product);
}


/**
 * Генерирует страницу моих заказов
 * @return string
 */
function generateMyOrdersPage()
{
	//получаем id пользователя и и получаем все заказы пользователя
	$userId = $_SESSION['login']['id'];
	$orders = getAssocResult("SELECT * FROM `orders` WHERE `userId` = $userId");

	$result = '';
	foreach ($orders as $order) {
		$orderId = $order['id'];

		//получаем продукты, которые есть в заказе
		$products = getAssocResult("
			SELECT * FROM `orderProducts` as op
			JOIN `products` as p ON `p`.`id` = `op`.`productId`
			WHERE `op`.`orderId` = $orderId
		");

		$content = '';
		$orderSum = 0;
		//генерируем элементы таблицы товаров в заказе
		foreach ($products as $product) {
			$count = $product['amount'];
			$price = $product['price'];
			$productSum = $count * $price;
			$content .= render(TEMPLATES_DIR . 'orderTableRow.tpl', [
				'name' => $product['name'],
				'id' => $product['id'],
				'count' => $count,
				'price' => $price,
				'sum' => $productSum
			]);
			$orderSum += $productSum;
		}

		$statuses = [
			1 => 'Заказ не обработан',
			2 => 'Заказ отменен',
			3 => 'Заказ оплачен',
			4 => 'Заказ доставлен',
		];

		//генерируем полную таблицу заказа
		$result .= render(TEMPLATES_DIR . 'orderTable.tpl', [
			'id' => $orderId,
			'content' => $content,
			'sum' => $orderSum,
			'status' => $statuses[$order['status']]
		]);
	}
	return $result;
}

function insertProduct($name, $description, $price) {
	$db = createConnection();
	$name = escapeString($db, $name);
	$description = escapeString($db, $description);
	$sql = "INSERT INTO `products`(`name`, `description`, `price`) VALUES ('$name', '$description', $price)";
	return execQuery($sql, $db);
}

function updateItems($id, $name, $description, $price, $image) {
	$db = createConnection();
	$id = (int) $id;
	$name = escapeString($db, $name);
	$description = escapeString($db, $description);
	$sql = "UPDATE `products` SET `name`='$name',`description`='$description' ,`price`= $price,`image`= '$image', `dateChange` = NOW() WHERE `id` = $id";
	return execQuery($sql, $db);
}

function deleteProduct($id)
{
	$sql = "DELETE FROM `products` WHERE `id` = $id";
	return execQuery($sql);

}
