<?php 
/**
 * 菜单栏实现
 *
 */

class Control_Menu extends QUI_Control_Abstract {
	
	
	function render(){
		
		//得到属性的值
		$name = $this->_extract('name');
		$catch_id = 'Dy_menu'.$name;
		
		//读取缓存
		$rowSet  =	Q::cache($catch_id);
		//读取失败
		if(!$rowSet){
			$rowSet = Sysmenu::find()->order('parent_id ASC, order_pos ASC')->asArray()->getAll();
			//写缓存
			Q::writeCache($catch_id,$rowSet);
		}

	   
	  /**
	   * 验证不能访问的菜单
	   */
	  $app = MyApp::instance();
		
	 
	  foreach ($rowSet as $offset=>$row){
	  		
	  	  if($row['controller'] =='') continue;
	  	  $udi ="{$row['controller']}/{$row['action']}";
	  	  //权限判断
	  	  if(!$app ->authorizedUDI($app->currentUserRoles(),$udi)){
	  	  	  //删除没有权限访问的菜单
	  	  		unset($rowSet[$offset]);
	  	  		
	  	  }else {
	  	  		$args =array();
	  	  		parse_str($row['args'],$args);
				$rowSet[$offset]['url']	 = url($udi,$args);
	  	  }
	  	  
	  }
	 //数组转换成树
	 $menu = Helper_Array::toTree($rowSet,'menu_id','parent_id','submenu');
	
//	 $mainMenu = & new Helper_Menu($menu) ;
     $mainMenu =  new Helper_Menu($menu) ;
	 $output = "var {$name} = ";
	 $output.= $mainMenu->returnJsArray(true);
	 $output.=";\n";
	 
	 echo <<<EOT

<div id="mainMenuBar"></div>

<link href="js/ThemeOffice/theme.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/JSCookMenu.js"></script>
<script language="javascript" type="text/javascript" src="js/ThemeOffice/theme.js"></script>

<script language="javascript" type="text/javascript">
{{$output}}

cmDraw ('mainMenuBar', myMenu, 'hbr', cmThemeOffice);
</script>

EOT;


	}
}