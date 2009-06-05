<?php


class 	Helper_Menu 	{
	var $_menu = array();

	var $_refs = array();
    /**
     * 构造函数
     *
     * @param array $menu
     */
	function __construct($menu = null)
	{
	    $this->_removeEmptyMenu($menu);
		if (is_array($menu)) {
			$this->_menu = $menu;
		}
	}
   /**
    * 添加菜单项
    *
    * @param array $menu
    * @param array|string $parent
    * @return unknown
    */
	function addMenu($menu, $parent = null)
	{
		static $menuid = 0;
		if (!is_array($menu)) { return false; }

		$menuid++;
		$menu['id'] = $menuid;

		if (isset($parent) && is_array($parent)) {
			if (!isset($parent['id'])) { return false; }
			$id = $parent['id'];
			if (!isset($this->_refs[$id])) { return false; }
			$parent =& $this->_refs[$id];
			if (!isset($parent['submenu']) || !is_array($parent['submenu'])) {
				$parent['submenu'] = array();
			}
			$parent['submenu'][$menuid] = $menu;
			$this->_refs[$menuid] =& $parent['submenu'][$menuid];

			return $menu;
		}

		$this->_menu[$menuid] = $menu;
		$this->_refs[$menuid] =& $this->_menu[$menuid];
		return $menu;
	}
    /**
     * 返回所有菜单
     *
     * @return unknown
     */
	function getAllMenu()
	{
		return $this->_menu;
	}
    
	/**
	 * js形式返回菜单
	 *
	 * @param bool $format 
	 * @return string
	 */
	function returnJsArray($format = false)
	{
		return "[\n" . $this->_dumpJsArray($this->_menu, 1, $format) . "\n]";
	}

	function _dumpJsArray(& $menus, $level = 1, $format = false)
	{
		$out = '';
		$prefix = ($format) ? str_repeat('    ', $level) : '';
		foreach ($menus as $menu) {
			if (isset($menu['split']) && $menu['split'] != false) {
				$out .= $prefix . '_cmSplit';
			} else {
				$out .= $prefix . '[';
				if (isset($menu['icon'])) {
					$out .= '\'' . addslashes($menu['icon']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['title'])) {
					$out .= '\'' . addslashes($menu['title']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['url'])) {
					$out .= '\'' . addslashes($menu['url']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['target'])) {
					$out .= '\'' . addslashes($menu['target']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['description'])) {
					$out .= '\'' . addslashes($menu['description']) . '\', ';
				} else {
					$out .= 'null';
				}
				//是否存在子菜单 且子菜单有元素不为零
				if (isset($menu['submenu']) && is_array($menu['submenu']) && (count($menu['submenu'])!=0)) {
					$out .= ",\n";
					$out .= $this->_dumpJsArray($menu['submenu'], $level + 1, $format);
					$out .= "\n{$prefix}";
				}
				$out .= ']';
			}
			$out .= ",\n";
		}
		return substr($out, 0, -2);
	}
    /**
     * 删除菜单中的空元素
     * 返回子元素个数
     * @param array $menus
     * @return int
     */
    function _removeEmptyMenu(& $menus)
    {
    	$count = 0;
    	$keys = array_keys($menus);
    	foreach ($keys as $offset => $key) {
    	    $cur =& $menus[$key];
    	    if (isset($keys[$offset + 1])) {
    	        $next = $menus[$keys[$offset + 1]];
    	    } else {
    	        $next = null;
    	    }
    	    if ((is_null($next) || $next['split']) && $cur['split']) {
    	        /**
    	         * 如果当前菜单项是分隔符，而下一个菜单项也是分隔符或已经没有下一个菜单项则删除当前菜单项
    	         */
    	        unset($menus[$key]);
    	        continue;
    	    }
               //存在子菜单而且自菜单有元素
    		if (isset($cur['submenu']) && is_array($cur['submenu']) && (count($cur['submenu'])!=0)) {
    		    /**
    		     * 处理子菜单
    		     */
    			if ($this->_removeEmptyMenu($cur['submenu']) == 0) {
    			    /**
    			     * 如果没有子菜单项，则删除当前菜单项
    			     */
    				unset($menus[$key]);
    			}
    		} else {
    			if ($cur['split'] == false) {
    				if (!isset($cur['url']) || $cur['title'] == '') {
    					unset($menus[$key]);
    				} else {
    					$count++;
    				}
    			}
    		}
    	}
    	return $count;
    }
}