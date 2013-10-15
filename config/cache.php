<?php
 
/**
* 缓存
*/
 
return array(
	//缓存方式 memcache file
	'drive'=>'file',
	'service'=>array(
		array(
			'host'=>'127.0.0.1',
			'port'=>11211,
			'weight'=>60,
		)
	)
);
 