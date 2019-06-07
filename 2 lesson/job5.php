<?php 
$title = "Заголовок сайта";
$h1 = "Добро пожаловать";
$date = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<div class="container">
		<h1><?php echo $h1; ?></h1>
	</div>
	<div class="footer">
		Текуищй год: <?php  echo $date; ?>
	</div>
</body>
</html>