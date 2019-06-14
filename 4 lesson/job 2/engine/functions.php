<?php


function render($file, $variables = [])
{
	if (!is_file($file)) {
		echo 'Template file "' . $file . '" not found';
		exit();
	}

	if (filesize($file) === 0) {
		echo 'Template file "' . $file . '" is empty';
		exit();
	}


	$templateContent = file_get_contents($file);

	foreach ($variables as $key => $value) {
		if (is_array($value)) {
			continue;
		}

		$key = '{{' . strtoupper($key) . '}}';

		$templateContent = str_replace($key, $value, $templateContent);
	}

	return $templateContent;
}

function getImages($dir)
{
	$images = scandir($dir);
	$imageContent = "";
	foreach ($images as $image) {
		if( $image == '.' || $image == '..' ){
			continue;
		}
		$imageContent .= "/<a href=\"img/" . $image . "\" target=\"_blank\"><img src=\"/img/" . $image . "\"width=\"320\"/></a>";
	}
	
	return $imageContent;
}

