<?php

require_once __DIR__ . '/../config/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

$review = getReview($id);

$author = $_POST['author'] ?? $review['author'];
$text = $_POST['text'] ?? $review['text'];


if ($author !== $review['author'] || $text !== $review['text']) {
	if ($author && $text) {
		if (updateReview($id, $author, $text)) {
			header('Location: http://'.$_SERVER['HTTP_HOST']."/reviews.php");
			exit();
		} else {
			echo 'Произошла ошибка';
		}
	} elseif ($author || $text) {
		echo "Форма не заполнена";
	}
}


?>

<hr>

Отредактировать отзыв <?= $review['id'] ?>:
<form method="POST">
	Имя: <input type="text" name="author" value="<?= $author ?>"><br>
	Комментарий: <textarea name="text"><?= $text ?></textarea><br>
	<input type="submit" />
</form>