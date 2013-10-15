<?php namespace app\core\cache;
/**
* Memcached »º´æ
* @auth Sun Kang <68103403@qq.com>
*/  
class Memcache implements InterFaceCache{ 
	public $cache;
	public function __construct()
	{
		if (class_exists('Memcached')){
			$this->cache = new \Memcached; 
		}else
			$this->cache = new \Memcache; 
		$servers = \Config::load('cache:service'); 
		foreach ($servers as $server)
		{
			$this->cache->addServer($server['host'], $server['port'], $server['weight']);
		}  
		 
	} 
	public function get($key){
		$data = $this->cache->get( $key );  
		return $data;
	}
	
	public function set($key, $value, $minutes = 0){
		if(false === $minutes) return ; 
		if( $minutes > 0) {
			$minutes = time() + $minutes;
		}
		$this->cache->set( $key, $value, $minutes ); 
	}
 	public function increment($key, $value = 1 ,$minutes = 0){  
 		return $this->cache->increment( $key );
 	}
 	public function decrement($key, $value = 1 ,$minutes = 0){
 		return $this->cache->decrement( $key );
 	}
	public function forever($key, $value){
		return $this->set($key, $value, 0);
	}
	public function delete($key = null){
		if(!$key) $this->cache->flush( );
		$this->cache->delete( $key );
	}
	public function remove($key){
		$this->delete($key);
	} 
	 
}
