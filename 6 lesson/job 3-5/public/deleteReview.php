<?php

require_once __DIR__ . '/../config/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

if( $_POST ){
	$result = $_POST["result"];

	if($result == "Да"){
		deleteReview($id);
	}

	header('Location: http://'.$_SERVER['HTTP_HOST']."/reviews.php");
	exit();

}

?>

<h1>Вы точно хотите удалить комментарий с id = <?=$id?> </h1>
<form method="POST">
	<input  name="result" type="submit" value="Да" />
	<input  name="result" type="submit" value="Нет" />
</form>