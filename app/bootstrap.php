<?php
/**
* 数据库使用 
* 官方 http://medoo.in/
* https://github.com/catfan/Medoo
*/
$db = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'test',
	'server' => 'localhost',
	'username' => 'test',
	'password' => 'test',
]);



$db->insert('posts', [
	'title' => 'foo', 
	'body' => ['en', 'fr', 'jp', 'cn']
]);