<?php
require_once __DIR__ . '../../../../config/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

$product = getProduct($id);

$name = $_POST['name'] ?? $product['name'];
$description = $_POST['description'] ?? $product['description'];
$price = $_POST['price'] ?? $product['price'];
if(isset($_FILES['uploadfile']))
{
	$uploadfile = "../../". IMG_DIR_PRODUCT . basename($_FILES['uploadfile']['name']);

	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
		$imagesTemp = IMG_DIR_PRODUCT . basename($_FILES['uploadfile']['name']);	
	    echo "Файл корректен и был успешно загружен.<br/>";
	} else {
	    echo "Возможная атака с помощью файловой загрузки!<br/>";
	}
}
$image = $imagesTemp ?? $product['image'];
if(is_file(WWW_DIR . $image)) {
}
else{
	$image = IMG_DIR . "no-image.jpeg";
}
if ($name !== $product['name'] || $description !== $product['description'] || $price !== $product['price'] || $image !== $product['image']) {
	if ($name && $description && $price && $image) {
		if (updateItems($id, $name, $description, $price, $image)) {
			echo 'Комментарий изменен';
		} else {
			echo 'Произошла ошибка';
		}
	} elseif ($name || $description || $price || $image) {
		echo "Форма не заполнена";
	}
}

?>

Отредактировать товар c <?= $product['id'] ?>:
<br/>
<img src="<?="../../" . $image?>" style ="max-width: 450px"/>
<form method="POST">
	Название: <input type="text" name="name" value="<?= $name ?>"><br>
	Описание: <textarea name="description"><?= $description ?></textarea><br>
	Цена: <input type="number" name="price" value="<?= $price ?>"><br>
	<input type="submit" />
</form>

<form enctype="multipart/form-data" method="POST"">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла (в байтах) -->
    
    <!-- Название элемента input определяет имя в массиве $_FILES -->
Укажите файл для загрузки картинки <input type=file name=uploadfile>
<input type=submit value=Загрузить></form
</form>