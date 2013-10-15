<?php  
/**
* Session
* @auth Sun <68103403@qq.com>
*/  
class Session{  
	static $session;
	static function init(){
		if(!isset(static::$session)){
			session_start();
			static::$session = true;
		}
	}
	/**
	* 是否存在 flash message session
	*/
	static function has_flash($name){ 
		$name = 'flash_message_'.$name;
		if(static::get($name))
			return true;
		return false;
	}
	/**
	* 设置 flash message session
	*/
	static function flash($name,$value = ''){ 
		$name = 'flash_message_'.$name;
		if($value){
			static::set($name,$value);
		}else{
			$v = static::get($name); 
			static::delete($name);
			return $v;
		}
	}
	
	/**
	* 设置SESSION
	*/
	static function set($name,$value){ 
		static::init();
		$value = \Crypt::encode($value);
		$_SESSION[$name] = $value;
	}
	/**
	* 取回SESSION
	*/
	static function get($name){
		static::init();
		$value = $_SESSION[$name];
		if($value)
			return \Crypt::decode($value);		 
	}
	/**
	* 删除SESSION，只能删除一个SESSION
	*/
	static function delete($name){
		unset($_SESSION[$name]); 
	}
	/**
	* 删除SESSION，可删除多个
	*/
	static function remove($name){
		if(is_array($name)){
			foreach($name as $n){
				static::delete($n);
			}
		}else{
			static::delete($name);
		} 
	}
	
	/**
	* 删除所有SESSION 
	*/
	static function remove_all(){
		session_destroy();
	}
	
}
 
