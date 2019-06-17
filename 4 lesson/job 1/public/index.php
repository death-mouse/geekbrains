<?php

require_once __DIR__ . '/../config/config.php';



 echo render(TEMPLATES_DIR . '/index.tpl', [
 	'title' => 'Приветствие',
 	'h1' => 'Заголовок',
 	'content' => 'Я контент'
 ]);

?>
