<?php

require_once('../config/config.php');


$feedback_body = mysqli_real_escape_string(
	$db_link,
	(string)htmlspecialchars(strip_tags($_POST['review']))
);


/*

strip_tags – удаляет HTML и PHP теги. Честно говоря, это мало относится к SQL-инъекциям, но атаку через форму без этого тега провести можно.
htmlspecialchars – производятся следующие преобразования:
'&' (амперсанд) преобразуется в '&amp;'
'"' (двойная кавычка) преобразуется в '&quot;' в режиме ENT_NOQUOTES is not set.
"'" (одиночная кавычка) преобразуется в '&#039;' (или &apos;) только в режиме ENT_QUOTES.
'<' (знак "меньше чем") преобразуется в '&lt;'
'>' (знак "больше чем") преобразуется в '&gt;'
(string) – строго приводим тип к строке.
mysqli_real_escape_string – самый мощный инструмент, экранирует специальные символы в строке для использования в SQL выражении, используя текущий набор символов соединения.

*/


/*

<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
<form enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла (в байтах) -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>


$_FILES['userfile']['name'] – оригинальное имя файла на компьютере клиента.
$_FILES['userfile']['type'] – Mime-тип файла, в случае, если браузер предоставил такую информацию. Пример: "image/gif". Этот mime-тип не проверяется в PHP, так что не полагайтесь на его значение без проверки.
$_FILES['userfile']['size'] – размер в байтах принятого файла.
$_FILES['userfile']['tmp_name'] – временное имя, с которым принятый файл был сохранен на сервере.
$_FILES['userfile']['error'] – код ошибки, которая может возникнуть при загрузке файла.



$uploaddir = WWW_ROOT . '/img/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

*/


?>


1) товары
1.1) каталог - все товары - /index.php
1.2) страница товара - /productPage.php?id=13
2) админка
2.1) посмотреть товары как админ - /admin/products/index.php
2.2) добавить товар - /admin/products/create.php
2.3) редактировать товар /admin/products/update.php?id=13
2.4) удалять товар /admin/products/delete.php?id=13
3) галерея из прошлых работ
4) страница отзывов

