<?php
function getOrders()
{
	//получаем id пользователя и и получаем все заказы пользователя
	
	$orders = getAssocResult("SELECT * FROM `orders`");

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
		$result .= render(TEMPLATES_DIR . 'orderTableAdmin.tpl', [
			'id' => $orderId,
			'content' => $content,
			'sum' => $orderSum,
			'status' => $statuses[$order['status']]
		]);
	}
	return $result;
}


function deleteOrder($id)
{
	$sql = "DELETE FROM `orders` WHERE `id` = $id";
	$result = execQuery($sql);
	if($result){
		$sql = "DELETE FROM `orderproducts` WHERE `orderId` = $id";
		$result = execQuery($sql);
	}

	return $result;

}

function setStatusId($id, $statusId)
{
	$sql = "Update `orders` Set `status` = $statusId WHERE `id` = $id";
	return execQuery($sql);

}

?>