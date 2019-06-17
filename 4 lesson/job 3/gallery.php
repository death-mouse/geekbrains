<?php

require_once __DIR__ . '/../config/config.php';



echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Галерея',
	'content' => render(TEMPLATES_DIR . 'gallery.tpl', ['images' => getImages("img")])
]);
