<?php
 
/**
* 系统配置
*/
 
return array(
	/**
	* 是否合并输出视图
	*/
	'minify'=>false,
	//加密方式 AES DES  Hash Random RC2 RC4  Rijndael RSA TripleDES Twofish
	'crypt_class'=>'AES',
	//加密key
	'crypt_key'=>'test',
	//时区
	'timezone'=>'Asia/Shanghai',
	/**
	* assets设置
	* twig模板中加载 css {{ assets_css_template|raw }}
	* 			加载 js  {{ assets_js_template|raw }}
	*/
	'assets'=>array(
		//前端
		'application'=>array(
			'jquery',
			'bootstrap'
		) 
	 
	)	
		
);