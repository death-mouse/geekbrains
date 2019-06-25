<?php

require_once __DIR__ . '/../config/config.php';

echo "<pre>";
var_dump($_POST);
echo "</pre>";


$author = $_POST['author'] ?? null;
$text = $_POST['text'] ?? null;

if ($author && $text) {
	if (insertReview($author, $text)) {
		echo 'Комментарий добавлен';
		$author = '';
		$text = '';
	} else {
		echo 'Произошла ошибка';
	}
} elseif ($author || $text) {
	echo "Форма не заполнена";
}

echo '<hr>';




$reviews = getReviews();

echo "<div class=\"reviews\">";
foreach ($reviews as $review) {
	echo "<div class=\"review\">";
	echo $review['author'] . ": " . $review['text'];
	echo " <a href=\"editReview.php?id=" . $review['id'] . "\">Редактировать</a>";
	echo " <a href=\"deleteReview.php?id=" . $review['id'] . "\">Удалить</a>";
	echo "</div>";
}
echo "</div>";

?>

<hr>

Добавьте ваш отзыв:
<form method="POST">
	Имя: <input type="text" name="author" value="<?= $author ?>"><br>
	Комментарий: <textarea name="text"><?= $text ?></textarea><br>
	<input type="submit" />
</form>