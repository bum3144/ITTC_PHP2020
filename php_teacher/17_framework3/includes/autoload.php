<?php
function autoloader($className) {
	$file = __DIR__ . '/../classes/' . $className . '.php';
	include $file;
} 

sql_autoload_register('autoloader');    
?>