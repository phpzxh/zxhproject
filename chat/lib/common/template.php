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

	/**
	 各个缓存的状态
	**/
	private $cacheStatus = array();

	//private $extName;
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

	function display($fileName, $cacheId = null)
	{
		$output = $this->_fetch($fileName, $cacheId);
		echo $output;
	}

	



	protected function _fetch($fileName, $cacheId = null)
	{
		if ($this->enableCache) {

		  // 文件是否被缓存
		   $file = $this->_getCacheFile($fileName, $cacheId);
		  if ($this->_isCached($fileName, $cacheId)) {
			
			  $content = file_get_contents($file);
			  return $content;
		  }

		}
	
        extract($this->vars);
		ob_start();
		include $this->path.'/'.$fileName.'.php';

		$content = ob_get_contents();
		ob_end_clean();

		//写缓存
		if ($this->enableCache) {
			$this->cacheStatus[$file] = file_put_contents($file, $content) > 0;
		}

		return $content;

	}

    /**
	  检查文件内容是否被缓存
	  @param $file 文件名
	  @param $cacheId cache的ID
	  @return bool
	 **/
	protected function _isCached($file, $cacheId = null)
	{
		//是否开启缓存
		if(!$this->enableCache) return false;

		//如果缓存标志有效返回true
		$fileName = $this->_getCacheFile($file, $cacheId);
		if(isset($this->cacheStatus[$fileName]) && $this->cacheStatus[$fileName]) {
			return true;
		}

		//检查文件是否可以读
		if(!is_readable($fileName)) return false;

		//检查文件是否过期
		$mtime = filemtime($fileName);
		if($mtime == false) return false;

		if(($mtime + $this->cacheLifeTime) < time()){
			$this->cacheStatus[$fileName] = false;
			$this->_removeCache($fileName);
			return false;
		}

		$this->cacheStatus[$fileName] = true;

		return true;


	}
	/**
	  得到缓存文件名
	**/
	protected function _getCacheFile($file, $cacheId)
	{
		return $this->cacheDir . DIRECTORY_SEPARATOR . rawurlencode( $file . '-' . $cacheId ) . '.php';
	}

	/**
	 删除缓存
	 @param $fileName
	**/
	protected function _removeCache($fileName)
	{
		@unlink($fileName);
	}

	/**
	 删除所有的缓存
	**/

	public function removeAllCache()
	{
		foreach(glob($this->cacheDir . DIRECTORY_SEPARATOR . '*.php') as $fileName) {
            @unlink($fileName);
		}
	}






}