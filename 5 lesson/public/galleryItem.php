<?php

require_once __DIR__ . '/../config/config.php';



$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

execQuery("UPDATE `images` SET `views` = `views` + 1 WHERE `id` = $id");
$image = show("SELECT * FROM images WHERE `id` = $id");


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => $image["title"],
	'content' => render(TEMPLATES_DIR . 'viewsimage.tpl', [ 'src' => $image["url"], 'VIEWS' => $image["views"]  ])
]);