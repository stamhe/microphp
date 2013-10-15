<?php
unset($array);
/**
* 主数据库 必须是正常状态
*/
$array['master'] = array(
	'database_type'=>'mysql',
	'server'=>"localhost",
	'username'=>'test',
	'password'=>'test',
	'database_name'=> 'cms',
);

return $array;