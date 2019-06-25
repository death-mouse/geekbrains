<?php 
require_once __DIR__ . '../../../../config/config.php';


$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

deleteProduct($id);

header('Location: http://'.$_SERVER['HTTP_HOST']."/admin/product/");
exit();

?>