<?php   
/**
* 加密解密
* 使用 phpseclib 中的函数
* 请配置config.application
* <code>
* //加密方式 AES DES  Hash Random RC2 RC4  Rijndael RSA TripleDES Twofish
* 'crypt_class'=>'AES',
* //加密key
* 'crypt_key'=>'test',
* </code>
* @link 
* @auth Sun <68103403@qq.com>
*/  
class Crypt {  
	static $crypt;
	static $key;
	static function init(){
		$key = \Config::load('application:crypt_class')?:'AES'; 
		$cls = "Crypt_".$key;
		\App::import("app.core.vendor.phpseclib.Crypt.$key"); 
		static::$crypt   = new $cls("CRYPT_".$key."_MODE_ECB"); 
	}  
	/**
	* 加密
	*/
	static function encode($value,$key=null){ 
		if(!static::$crypt) { 
			static::init();
		} 
		static::$key = $key?:\Config::load('application:crypt_key'); 
		static::$crypt->setKey($key);
		return base64_encode(static::$crypt->encrypt($value));
	}
	/**
	* 解密
	*/
	static function decode($value,$key=null){
		if(!static::$crypt) { 
			static::init();
		} 
		static::$key = $key?:\Config::load('application:crypt_key'); 
		static::$crypt->setKey($key);
		return static::$crypt->decrypt(base64_decode($value));  
	}
	
	
}
 
