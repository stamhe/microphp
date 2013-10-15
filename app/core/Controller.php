<?php  
/**
* 控制器
* @auth Sun <68103403@qq.com>
*/  
class Controller{ 
	public $theme = 'default';
	public $view;
	/**
	* 视图模板
	*/
	protected $_view_template;
	/**
	* 是否加载数据库
	*/
	public $db = true;
	/**
	* 是否合并 View 视图代码
	*/
	public $minify = false;
	/**
 	* 选择要加载的asset
 	* 请至config/application中修改的assets配置
 	*/
	public $switch_asset = 'application'; 
	function __construct(){
		if(!$this->view) { 
			$this->view = new View($this->theme);
		}
		if($this->db !== false) {
			/**
			* 数据库使用 
			* 官方 http://medoo.in/
			* https://github.com/catfan/Medoo
			*/
			$master = \Config::load('database:master'); 
			$this->db = new medoo($master);
		}			 
		if(method_exists($this,'init'))
			$this->init();
		if(true === $this->minify || 
			true === \Config::load('application:minify') ||
			true !== DEBUG
		)
		\App::set('minify' , true);
	}
	function init(){}
	/**
	* url 重定向
	*/
	function redirect($url){
		\App::redirect($url);
	}
	/**
	* url 301 永久重定向
	*/
	static function redirect_301($url){
		\App::redirect_301($url);
	}
	/**
	* 渲染模板
	*/
	function render($file_name,$data = array()){
		$this->view->render($file_name, $data);
	} 
 
  	
	 
}
 
