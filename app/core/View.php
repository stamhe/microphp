<?php  
/**
* 纯PHP 模板
* @auth Sun <68103403@qq.com>
*/  
class View{ 
	public $view; 
	public $theme;
	public $dir;
	public $block;
	public $block_id;
	function __construct($theme = 'default'){
		$this->theme = 'themes/'.$theme.'/'; 
		$this->dir = \App::root().$this->theme; 
	}
	 
	/**
	* PHP 模板
	*/
	function render($view, $params = array())
	{
		$file = $this->dir.$view.'.php'; 
		if(file_exists($file)){  
			$this->start();
			extract($params, EXTR_OVERWRITE); 
			$content = include $file;
			$this->block['default'] = $this->end(); 
		}   
		if($this->block['body'])
			$body = $this->block['body'];
		else
			$body = $this->block['default'];
		
		$body =  preg_replace(array('/ {2,}/','/<!--.*?-->|\t|(?:\r?\n[\t]*)+/s'),array(' ',''),$body);  
		echo $body; 
	}
	/**
	* 加载layout
	*/
	function extend($view , $params = array() ){
		$this->start();
		extract($params, EXTR_OVERWRITE);
		include $this->dir.$view.'.php';
		$this->block['body'] = $this->end();
	}
	/**
	* 加载layout
	*/
	function block($name , $params = array()){
		$this->block_id = $name; 
		$this->start(); 
		extract($params, EXTR_OVERWRITE);
	}
	/**
	* 加载layout
	*/
	function endblock(){   
		$this->block['__blocks'][$this->block_id] =  $this->end();
	}
	/**
	* include
	*/
	function load($view)
	{
		$file = $this->dir.$view.'.php';
		if(file_exists($file)){
			$this->start();
			include $file;
			echo $this->end(); 
		}  
	}
	function blocks($name){ 
		 echo $this->block['__blocks'][$name];
	} 
	
	function start()
	{
		ob_start();
		ob_implicit_flush(false);  
	}
	function end(){
		return ob_get_clean();
	}
  
	 
}
 
