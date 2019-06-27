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
 * Создание нового продукта
 * @param string $name
 * @param string $description
 * @param float $price
 * @param array $file
 * @return bool
 */
function insertProduct($name, $description, $price, $file)
{
	if($file) {
		$fileName = loadFile('image', 'img/');
	}


	//создаем соединение с БД
	$db = createConnection();
	//Избавляемся от всех инъекций в $title и $content
	$name = escapeString($db, $name);
	$description = escapeString($db, $description);
	$price = (float) $price;

	//генерируем SQL добавления в БД

	$sql = $file
		? "INSERT INTO `products`(`name`, `description`, `price`, `image`) VALUES ('$name', '$description', $price, '$fileName')"
		: "INSERT INTO `products`(`name`, `description`, `price`) VALUES ('$name', '$description', $price)";

	//выполняем запрос
	return execQuery($sql, $db);
}

/**
 * Редактирование продукта
 * @param int $id
 * @param string $name
 * @param string $description
 * @param float $price
 * @param array $file
 * @return bool
 */
function updateProduct($id, $name, $description, $price, $file)
{
	$uploadFile = $file && !$file['error'];
	if($uploadFile) {
		$fileName = loadFile('image', 'img/');
	}


	//создаем соединение с БД
	$db = createConnection();
	//Избавляемся от всех инъекций в $title и $content
	$name = escapeString($db, $name);
	$description = escapeString($db, $description);
	$price = (float) $price;

	//генерируем SQL добавления в БД

	$sql = $uploadFile
		? "UPDATE `products` SET `name`='$name', `description`='$description', `price`=$price, `image`='$fileName' WHERE `id` = $id"
		: "UPDATE `products` SET `name`='$name', `description`='$description', `price`=$price WHERE `id` = $id";

	//выполняем запрос
	return execQuery($sql, $db);
}

/**
 * Функция удаляет продукт
 * @param int $id
 * @return bool
 */
function deleteProduct($id)
{
	$id = (int) $id;

	$sql = "DELETE FROM `products` WHERE `id` = $id";

	return execQuery($sql);
}
