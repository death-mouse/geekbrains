<?php

setcookie("login", "lamer", time() + 3600 * 24 * 7);
setcookie("password", "qwerty", time() + 3600 * 24 * 7);


if (isset($_COOKIE['login'])) {
	echo $_COOKIE['login'];
}


session_start();
$_SESSION['name'] = 'name';
$_SESSION['age'] = 13;


unset($_SESSION['name']);
unset($_SESSION['age']);

session_destroy();


/*
<form method="post">
        <p><input type="text" name="login" /></p>
        <p><input type="password" name="password" /></p>
        <p><input type="checkbox" name="rememberme" /></p>
        <p><input type="submit" value="Войти" /></p>
</form>
*/


/*

CREATE TABLE `user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(50) NOT NULL,
	`user_login` VARCHAR(50) NOT NULL,
	`user_password` VARCHAR(60) NOT NULL,
	`user_last_action` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id_user`)
)
ENGINE=InnoDB;
*/


//location.reload()


header('Content-Type: application/json');

$json_string = json_encode($value);
$array = json_decode($json_string, true);
