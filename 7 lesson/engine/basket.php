<?php
//

function getUsersBaskets($userdId)
{
	$sql = "SELECT d.id, d1.NAME,amount FROM `baskets` AS d,  .`products` AS d1 WHERE d1.id = d.productId AND d.userId = $userdId";

	return getAssocResult($sql);
}

function deleteProductFromBasket($id, $userId)
{
	$id = (int) $id;
	$userId = (int) $userId;

	$sql = "DELETE FROM `baskets` WHERE `id` = $id AND `userId` = $userId";
	
	return execQuery($sql);
}

function insertProductToBaskets( $userId, $productId, $amount)
{
	$userId = (int) $userId;
	$productId = (int) $productId;
	$amount = (int) $amount;
	$sql = "INSERT INTO `baskets` (userId, productId, amount) VALUES ($userId, $productId, $amount) ";
	return execQuery($sql);
}

function renderBasketsList($userId)
{
	
	$result = '';
	$baskets = getUsersBaskets($userId);
	$result .= "<table><tr><th>Название товара</th><th>Цена</th><th></th></tr>";
	foreach ($baskets as $basket) {

		$result .= "<tr><td>" .  $basket["NAME"] . "</td><td>" . $basket["amount"] . "<td><td><a href =\"http://" . $_SERVER['HTTP_HOST'] . "/deleteProductFromBasket.php?id=" . $basket["id"] . "\"/>Удалить из корзины</a> </td><tr>";
	}
	$result .= "</table>";


	return render(TEMPLATES_DIR . 'baskets.tpl', ['TABLE' => $result]);
}

?>