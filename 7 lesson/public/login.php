<?php

require_once '../config/config.php';
//
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';


//Вариант без AJAX


//Полуаем логин пароль
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

//Если логин и пароль переданы попытаемся авторизоваться
if ($login && $password) {
	//преобразуем пароль в хэш
	$password = md5($password);

	//получаем пользователя из базы по логин-паролю
	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
	$user = show($sql);

	//если пользователь найден. Записываем его в сессию
	if($user) {
		$_SESSION['login'] = $user;
	} else {
		echo 'Неверная пара логин-пароль';
	}
}

?>


<div class="message"></div>
<hr>
<form action="" method="POST">
	Вариант без AJAX
	<p>Логин: <input type="text" name="login"/></p>
	<p>Пароль: <input type="password" name="password"/></p>
	<input type="submit">
</form>


<?php
die;
?>
<hr>
<div>
	Вариант с AJAX
	<p>Логин: <input type="text" name="login"/></p>
	<p>Пароль: <input type="password" name="password"/></p>
	<!-- При нажатии на кнопку вызвается JS функция login() -->
	<button onclick="login()">Войти</button>
</div>

<!-- Подключение jQuery и нашего main.js -->
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/main.js"></script>



