<?php


"
CREATE TABLE employee(
id_employee int (11) NOT NULL AUTO_INCREMENT,
first_name varchar(255) NULL DEFAULT '',
middle_name varchar(255) NULL DEFAULT '',
last_name varchar(255) NULL DEFAULT '',
PRIMARY KEY (`id`)
);
";


"
INSERT INTO employee (first_name, middle_name, last_name) VALUES ('testuser', 'test', 'test');
";


"
UPDATE employee SET name='testuser1' WHERE id_employee=1;
DELETE FROM employee WHERE id_employee=5;
";



//Создать
$link = mysqli_connect("localhost", "my_user", "my_password", "world");


//Закрыть
mysqli_close($link);


//Запрос
$result = mysqli_query($link, "SELECT * FROM employee WHERE id > 0");


// Лечение кодировки
mysqli_query($link, "SET CHARACTER SET 'utf8'");
mysqli_set_charset($link, "utf8");


//GET
$epms = [];
while ($row = mysqli_fetch_assoc($result)) {
	$epms[] = $row;
}


// mysqli_num_rows – число строк, содержащееся в результате выборки данных;
// mysqli_affected_rows – число строк, затронутых последним запросом INSERT, UPDATE или DELETE;
// mysqli_error – сообщение о последней ошибке, возникшей в ходе запроса;
// mysqli_insert_id – id записи, добавленной последним запросом INSERT;
// mysqli_close
