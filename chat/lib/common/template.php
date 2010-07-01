<?php


class CTemplate
{
    /**
	 模板路径
	**/
	private $path;
	/**
	 是否启用缓存
	**/
	private $enableCache = false;
	/**
	 缓存的时间
	**/
	private $cacheLifeTime = 3600;

	private $vars =array();
	private $extName;
	/**
	 缓存的路径
	**/
	private $cacheDir;


	function __construct($conifg)
	{
		if(!is_array($conifg)) return ;

		$keys =  array('path','enableCache','cacheLiftTime','cacheDir');

		foreach ($keys as $key) {
			if (!empty($conifg[$key])) {
				$this->{$key} = $conifg[$key];
			}
		}

	}
    /**
	 为模板变量赋值
	**/
	function assign($name, $value=null)
	{
		if (is_array($name) && is_null($value)) {
			$this->vars = array_merge($this->vars, $name);
		}

		if (!is_array($name) && !is_null($value)) {
			$this->vars[$name] = $value;
		}
		return false;

	}

	function display($fileName)
	{
		$output = $this->_fetch($fileName);
		echo $output;
	}

	private function _fetch($fileName)
	{
		// 生成输出内容并缓存
        extract($this->vars);
		ob_start();
		include $this->path.'/'.$fileName.'.php';

		$content = ob_get_contents();
		ob_end_clean();
		return $content;

	}




}