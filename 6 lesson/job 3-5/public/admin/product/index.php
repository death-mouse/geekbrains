<?php 
require_once __DIR__ . '../../../../config/config.php';

if($_POST)
{
	$name = $_POST['name'] ?? "Название не указано";
	$description = $_POST['description'] ?? "Без описания";
	$price = $_POST['price'] ?? 0;
	insertProduct($name, $description, $price);
}
?>


<hr/>
<h1>Создание товара</h1>
<form method="POST">
	Название: <input type="text" name="name""><br>
	Описание: <textarea name="description"></textarea><br>
	Цена: <input type="number" name="price"><br>
	<input type="submit" />
</form>
<hr/>

<?php 


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Geek Brains Site',
	'h1' => 'Каталог товаров',
	'content' => createProductItemsAdmin()
]);
?>