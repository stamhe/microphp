<?php
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
//加载数据库
include  __DIR__.'/libs/medoo.php';
//加载路由
include  __DIR__.'/libs/router.php'; 
//自动加载
include  __DIR__.'/libs/SplClassLoader.php';
/**
* 自动注册namespace
*/ 
$classLoader = new SplClassLoader();
$classLoader->register(); 
/**
* 路由设置
*/
$r = new Router();   
include __DIR__.'/router.php';	
$r->map(":controller/:action"); 
$r->run();
 