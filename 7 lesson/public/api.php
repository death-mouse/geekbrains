<?php

/*
 * Файл работы API
 * Файл ожидает что в _POST придет apiMethod с задачей, которую нужно выполнить
 * И (при необходимости) postData с информацией, необходимой для этой задачи
 *
 */

/*
 * Комментарий по json
 * Если использовать header('Content-Type: application/json');
 * То весь текст на странице попытается преобразоваться в json.
 * Следовательно нельзя будет увидеть ошибки, которые вам покажет php,
 * поэтому задает заголовок передаем в последний момент
 *
 * Если до этого были ошибки на php заголовок задать не получится
 *
 */

require_once '../config/config.php';

//Функция вывода ошибки
function error($error_text)
{
	//Вариант с json
//	header('Content-Type: application/json');
//	echo json_encode([
//		'error' => true,
//		'error_text' => $error_text,
//		'data' => null
//	]);
//	exit();

	//Вариант без json
	echo "Ошибка: $error_text";
	exit();
}

//Функция успешного ответа
function success($data = true)
{
	//Вариант с json
//	header('Content-Type: application/json');
//	echo json_encode([
//		'error' => false,
//		'error_text' => null,
//		'data' => $data
//	]);
//	exit();

	//Вариант без json
	echo "OK";
	exit();
}

//Если на api не передан apiMethod вызываем ошибку
if (empty($_POST['apiMethod'])) {
	error('Не передан apiMethod');
}


//Обработка метода login
if ($_POST['apiMethod'] === 'login') {

	//Получаем логин и пароль из postData
	$login = $_POST['postData']['login'] ?? '';
	$password = $_POST['postData']['password'] ?? '';

	//Если нет логина или пароля вызываем ошибку
	if (!$login || !$password) {
		error('Логин или пароль не переданы');
	}

	//приводим пароль к тому же виду, как он хранится в базе
	$password = md5($password);

	//генерируем запрос и пытаемся найти пользователя
	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
	$user = show($sql);

	//Если пользователь найден, записываем информацию о пользователе в сессию,
	//что бы к ней можно было обратиться с любой страницы
	//Если пользователь не найден, возвращаем ошибку
	if ($user) {
		$_SESSION['login'] = $user;
		success();
	} else {
		error('Неверная пара логин-пароль');
	}
}
