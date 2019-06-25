<?php 
/**
 * Функция генерации списка товаров
 * @return string
 */
function createProductItems()
{
	//инициализируем результирующую строку
	$result = '';
	//получаем все изображения
	$products= getProductItems();
	
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
		
		$result .= render(TEMPLATES_DIR . 'productItem.tpl', [ "ITEMNAME" =>  $product["name"],
																"ITEMIMAGE" => $image,
																"ITEMPRIDE" => $product["price"],
																"ID" => $product["id"]
															 ]
					      );
	}
	return $result;
}

function createProductItemsAdmin()
{
	//инициализируем результирующую строку
	$result = '';
	//получаем все изображения
	$products= getProductItems();
	
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
 * Функция получени всех товаров
 * @return array
 */
function getProductItems()
{
	$sql = "SELECT * FROM `products`";

	return getAssocResult($sql);
}


/**
 * Функция получает одно товара по его id
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
/**
 * @param int $id
 * @return string
 */
function showProduct($id)
{
	//для безопасности превращаем id в число
	//получаем изображение
	$product = getProduct((int) $id);

	//если изображение не найдено выводим 404
	if(!$product) {
		return '404';
	}
	$image = "";
	if(is_file(WWW_DIR . $product["image"])) {
		$image = $product["image"];
	}
	else{
		$image = IMG_DIR . "no-image.jpeg";
	}
	//возвращаем render шаблона изображения
	return render(TEMPLATES_DIR . 'product.tpl', [
													"ITEMNAME" =>  $product["name"],
													"ITEMIMAGE" => $image,
													"ITEMPRIDE" => $product["price"],
													"DESCR" => $product["description"]
	]);
}

?>