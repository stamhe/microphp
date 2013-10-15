<?php namespace app\core\cache;
/**
* »º´æ½Ó¿Ú
* @auth Sun Kang <68103403@qq.com>
*/  
interface  InterFaceCache {  
 	public function get($key); 
	public function set($key, $value, $minutes);
 	public function increment($key, $value = 1);
 	public function decrement($key, $value = 1);
	public function forever($key, $value);
	public function delete($key);
	public function remove($key); 
} 