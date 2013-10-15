<?php  
/**
* 缓存 
* 缓存配置文件 在config/cache.php 中
* <code>
* return array(
*		//缓存方式 memcache file
*		'drive'=>'file',
*		'service'=>array(
*			array(
*				'host'=>'127.0.0.1',
*				'port'=>11211,
*				'weight'=>60,
*			)
*		)
*	);	 
* </code>
* @auth Sun  <68103403@qq.com>
*/  
class Cache{
	
	static $obj;
	
	public function __construct(  )
	{   
		if(!trim( Config::load('cache:drive') ))return;
		$drive = ucfirst(Config::load('cache:drive'));
		$cls = "\app\core\cache\\".$drive; 
	 	static::$obj = new $cls;
	}  
 
    public static function __callStatic($name, $arguments) 
    {  
    	if(! trim ( Config::load('cache:drive')) ) return;
    	if ( ! static::$obj)
    		 new static;   
    	return call_user_func_array( array(static::$obj , $name) , $arguments);  
    }
	
	
	
}
 
