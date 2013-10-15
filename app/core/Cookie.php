<?php  
/**
* Cookie
* @auth Sun <68103403@qq.com>
*/  
class Cookie{  
	
	/**
	* 设置COOKIE
	*/
	static function set($name,$value,$expire=0,$path='/',$secure=null){ 
		$value = \Crypt::encode($value);
		setcookie($name,$value,$expire,$path,$domain,$secure);
	}
	/**
	* 取回COOKIE
	*/
	static function get($name){
		$value = $_COOKIE[$name];
		if($value)
			return \Crypt::decode($value);		 
	}
	/**
	* 删除COOKIE，只能删除一个COOKIE
	*/
	static function delete($name){
		setcookie($name,false,time()-20); 
	}
	/**
	* 删除COOKIE，可删除多个
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
	* 删除所有COOKIE 
	*/
	static function remove_all(){
		if(is_array($_COOKIE)){
			foreach($_COOKIE as $n){
				static::delete($n);
			}
		} 
	}
	
}
 
