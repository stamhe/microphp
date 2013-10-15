<?php
/**
* 启动MVC
* @auth sun <68103403@qq.com>
*/
//加载数据库
include  __DIR__.'/vendor/medoo.php';
//加载路由
include  __DIR__.'/vendor/AltoRouter.php'; 
//自动加载
include  __DIR__.'/vendor/SplClassLoader.php';


/**
* 自动注册namespace
*/ 
$classLoader = new SplClassLoader();
$classLoader->register(); 

set_include_path(__DIR__);
 

/**
* 路由设置
*/
global $app;
$app['router'] = $router;
$router = new AltoRouter();
$baseUrl = "";
$router->setBasePath($baseUrl);
include __DIR__.'/../../config/router.php';	
$match = $router->match();
$r = $match['target']; 
if(is_array($r)){ 
	$controller = $r['c'];
	$action = $r['a'];
	$get = $_GET;
	$params = $match['params'];
	if($params){
		foreach($params as $k=>$v ){
			$get[$k] = $v;
		}
	}
	
	$obj = new $controller;
	return $obj->$action(); 
}
//使用默认路由所有的控制器 
$route = init_router();
if($route){
	$module = $route['module'];
	$controller = "\app\modules\\".$module.'\controller\\'.strtolower($route['controller']);
	$action = $route['action'];
	if(!class_exists($controller) || !method_exists($controller,$action)){
		$view = new View; 
		return $view->render('404'); 
	}
	$obj = new $controller;
	return $obj->$action(); 
} 

/**
* 如果没有定义路由
* 返回路由信息
*/
function init_router(){
	$php = $_SERVER['PHP_SELF']; 
	$s = substr($php,strpos($php,'/index.php')+11);
	if($s){
		$arr = explode('/',$s);
		$num = count($arr);//最大为2
		$rt['module'] = 'site';
		$rt['controller'] = $arr[0];
		switch($num){
			case 1: 
				$rt['action'] = 'index';
				break;
			case 2:
				$rt['action'] = $arr[1];
				break;
			case 3:
				$rt['module'] = $arr[0];
				$rt['controller'] = $arr[1];
				$rt['action'] = $arr[2];
				break;
		} 
		if(!$rt['action'])
			return ;
		return $rt; 
	}
	 
}
function url($name,$params=null){
	global $app; 
	return $app['router']->generate($name, $params); 	
}
function dump($str){
	print_r('<pre>');
	print_r($str);
	print_r('</pre>');
}
function pr($str){
	dump($str);
}

