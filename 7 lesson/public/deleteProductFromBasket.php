<?php
require_once __DIR__ . '/../config/config.php';


if(!isset($_SESSION['login']))
{
	header('Location: http://'.$_SERVER['HTTP_HOST']."/login.php");
	exit();
}
if(!isset($_GET["id"]))
{
	echo "Не передан айди";
}

$users = $_SESSION['login'];



deleteProductFromBasket($_GET["id"], $users["id"]);

header('Location: http://'.$_SERVER['HTTP_HOST']."/baskets.php");
exit();
?>