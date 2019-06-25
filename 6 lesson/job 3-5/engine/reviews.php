<?php


function getReviews() {
	$reviewsSql = "SELECT * FROM `reviews`";
	return getAssocResult($reviewsSql);
}

function getReview($id)
{
	$id = (int) $id;
	$sql = "SELECT * FROM `reviews` WHERE `id` = $id";
	return show($sql);
}

function insertReview($author, $text) {
	$db = createConnection();
	$author = escapeString($db, $author);
	$text = escapeString($db, $text);
	$sql = "INSERT INTO `reviews`(`author`, `text`) VALUES ('$author', '$text')";
	return execQuery($sql, $db);
}

function updateReview($id, $author, $text) {
	$db = createConnection();
	$id = (int) $id;
	$author = escapeString($db, $author);
	$text = escapeString($db, $text);
	$sql = "UPDATE `reviews` SET `author`='$author',`text`='$text' WHERE `id` = $id";
	return execQuery($sql, $db);
}

function deleteReview($id) {
	$db = createConnection();
	$sql = "DELETE FROM `reviews` WHERE `id` = $id";
	return execQuery($sql, $db);
}