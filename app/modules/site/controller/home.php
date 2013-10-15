<?php namespace app\modules\site\controller;
class home extends \Controller{
	 
	function index(){
		 /*
		 $s = \Crypt::encode('aa');
		 echo \Crypt::decode($s);
		 \Cache::set('a','123');
		 echo \Cache::get('a');
		*/
		echo 'welcome';
	}
}