<?php

require_once __DIR__ . '/../config/config.php';




echo render(TEMPLATES_DIR . '/index.tpl', [
	'title' => 'Главная страница',
	'h1' => 'Приветсвие',
	'content' => 'Добро пожаловать на сайт'
]);