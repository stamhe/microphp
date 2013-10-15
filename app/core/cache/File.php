<?php namespace app\core\cache;
/**
* 文件缓存 
* 暂只支持 永久缓存
* @auth Sun Kang <68103403@qq.com>
*/  
class File implements InterFaceCache{ 
	public $path; 
	public function __construct()
	{
		$this->path = \App::root().'temp/cache/';
		if(!is_dir( $this->path ))mkdir($this->path,0777,true); 
	} 
	public function cache_file($key){
		return $this->path.md5($key).'.php';
	}
	public function get($key){
		$file = $this->cache_file($key);
		$data = @file_get_contents($file);
		if( is_array( unserialize ($data) ) ){ 
			return unserialize($data);
		}
		return $data;
	}

	public function set($key, $value, $minutes = 0){ 
		if(false === $minutes) return ;
		$file = $this->cache_file($key);
		if(is_array($value)) $value = serialize ($value);
		return file_put_contents($file , $value);  
	} 
 	public function increment($key, $value = 1 ,$minutes = 0){
 		$v = $this->get($key);
 		if($v)
 			$value = $v+$value;
 		$this->set( $key ,$value ,$minutes);
 	}
 	public function decrement($key, $value = 1 ,$minutes = 0){
 		$v = $this->get($key);
 		if($v)
 			$value = $v - $value;
 		$this->set( $key ,$value ,$minutes);
 	}
	public function forever($key, $value){
		return $this->set($key, $value, 0);
	}
	public function delete($key){
		$file = $this->cache_file($key);
		@unlink($file);
	}
	public function remove($key){
		$this->delete($key);
	}
	 
	
	 
}
