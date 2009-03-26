<?php 
/**
 * 后台管理导航条
 *
 */
	class Control_Admin_SmallTabs extends QUI_Control_Abstract {
		/**
		 * 实现接口
		 *
		 */
		function render(){
			
			//得到子菜单的标题
			$menu_title=$this->_extract('menu');
		
			//的到子菜单的属性
			$sub_menu=Q::ini('appini/admin_sub_menus/'.$menu_title);
		
			//是否存在
			if(!is_array($sub_menu)){
				$sub_menu=array();
			}
			//得到当前的属性
			$currentmenu=$this->_extract('current');
			//输出子菜单 如果是当前的加上css
			$out="<ul>\n";
			foreach ($sub_menu as $menu){
				//是否是当前菜单
				if($menu['title']==$currentmenu){
					$out.="<li class=\"current\">";
				}else {
					$out.="<li>";
				}
				$out .= '<a href="'.url($menu['udi']).'"> <span>';
				$out .= h($menu['title']).'</span>';
				$out .="</a></li>\n";
			}
			$out.="</ul>\n";
			return $out;
		}
		
	}