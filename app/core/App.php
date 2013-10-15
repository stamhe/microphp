<?php   
/**
*  
* @auth Sun <68103403@qq.com>
*/  
class App{  
	static $obj;
	static $app; 
	/**
	* 加载文件
	*/
	static function import($name){
		if(!isset(static::$obj['_load'][$name])){
			$ext = substr($name,strrpos($name,'.')+1).'.php';
			$name = substr($name,0,strrpos($name,'.')); 
			static::$obj['_load'][$name] = true;
			@include static::dir($name).$ext; 
		}
	}
	/**
	* 返回代码根目录，非public目录
	*/
	static function root(){
		$dir = str_replace('\\','/',__DIR__);
		$n = 2;
		for($i = 1; $i<=$n ; $i++){
			$dir = substr($dir,0,strrpos($dir,'/'));
		} 
		return $dir.'/';
	}
 
	/**
	* 当前的域名
	*/
	static function domain($url = null){
		if($url){
			$arr = parse_url($url);
			$domain = $arr['scheme'].'://'.$arr['host']; 
		}else{
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$domain = $protocol.$_SERVER['HTTP_HOST'];
		} 
		return $domain;
	}
	static function host($url = null){
		return static::domain($url);
	}
	/**
	* 图片 js css 的URL
	*/
	static function misc(){
		return static::domain();
	}
	/**
	* 返回项目的路径
	* App::dir('public.themes.');
	*/
	static function dir($name){
		if($name) $name = $name.'.';
		$dir = str_replace('.','/',$name); 
		return static::root().$dir;
	}
	/**
	*
	* <code>
	* $opts = array('http' =>
	*    array(
	*        'method'  => 'POST',
	*        'header'  => 'Content-type: application/x-www-form-urlencoded \r\n
	*	    		User-Agent:Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0 \r\n
	*	    		Referer:https://mp.weixin.qq.com/ \r\n
	*	    		Cookie: user=3345; pass=abcd
	*	    ',
	*        'content' => \Arr::query($postdata)
	*    )
	*   );
	* \App::file_get_contents($url,$opts);
	* </code>
	);   
	*/
	static function file_get_contents($url,$opts=null,$header = false){
		if(null==$opts) return file_get_contents($url);
		$context = stream_context_create($opts); 
		$content = file_get_contents($url, false, $context);
		if(true === $header){
			return array('content'=>$content,'header'=>$http_response_header);
		}else			 
			return $content;
	}
	/** 
	* 取得 static::file_get_contents 返回的COOKIE
	* 返回数组
	* <code> 
	* 	$rt = \App::file_get_contents($url,$opts,true);
	* 	$content = json_decode($rt['content']);
	* 	$cookie = \App::parse_cookie($rt['header']); 
	* 	unset($cookie['Path']);
	* 	$cook = \Arr::query($cookie);
	* 	$cook = str_replace('&','; ',$cook); 
	*   echo $cook;
	* </code>
	*/
	static function parse_cookie($header){
		preg_match_all( "/Set-Cookie:(.*?)(.*)/" , implode( "\r\n" ,  $header ),  $cookies );
		$cook = $cookies[2];
		if(!$cook) return ; 
		$cook = implode(';',$cook);
		$cook = explode(';',$cook);
		foreach($cook as $v){
			if(strpos($v , '=') !== false){
				$a = substr($v ,0 , strpos($v , '=') );
				$b = substr($v , strpos($v , '=')+1); 
				$vo[trim($a)] = $b;
			}
		}  
		return $vo;
	} 
	/**
	* url 重定向
	*/
	static function redirect($url,$params = array()){
		if(strpos($url,'://') === false) $url = static::domain().static::url($url);
		if(substr($url,-2) == '//'){
			$url = substr($url,0,-2);
		}  
		if($params) $url .= '?'.\Arr::query($params);
		header("location:$url"); 
	}
	/**
	* url 301 永久重定向
	*/
	static function redirect_301($url){
		header('HTTP/1.1 301 Moved Permanently'); 
		static::redirect($url);
	}
	
	  
	static function set($name,$value){
		 static::$obj[$name] = $value;
	}
	static function get($name){
		 return static::$obj[$name];
	} 
  
	 
}

 
