<?php

require_once '../config/config.php';


echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

if (isset($_SESSION['login'])) {
	echo "Привет, " . $_SESSION['login']['name'];
} else {
	echo "Пожалуйста, войдите. <a href=\"/\">Войти</a>";
}
