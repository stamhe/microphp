<?php  
/**
* 读取配置
* @auth Sun <68103403@qq.com>
*/  
class Config{ 
	static $_config;
	/**
	* 直接加载文件，并缓存.
	* 目录相对composer.json
	* <code>
	* Config::load('config.application:timezone'); return value
	* Config::load('config.application');          return array
	* </code>
	*/ 
	static function load($alias){  
		$id = md5($alias);
		if(strpos($alias , ':') !== false){
			$key = substr($alias,strpos($alias , ':')+1); 
			$alias = substr($alias,0,strpos($alias , ':'));   
		}
		if(!isset(static::$_config[$id])){
			$file = __DIR__.'/../../config/'.str_replace('.','/',$alias).'.php'; 
			if(file_exists($file)){
				static::$_config[$id] = include $file;
			}  
		}
		
		$value = static::$_config[$id]; 
		if($key){ 
			if(strpos($key , ':') !== false){  
				$arr = explode(':',$key);  
				foreach($arr as $v){
					$value = $value[$v];
				}   
				return $value; 
			}
			return $value[$key];
		}
		return $value;
	}
  
	 
}
 
