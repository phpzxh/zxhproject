<?php

/**
 * 默认控制器
 */
class Controller_Default extends Controller_Abstract
{
    function actionIndex()
    {
        // 为 $this->_view 指定的值将会传递数据到视图中
		# $this->_view['text'] = 'Hello!';
	
		
    }
    /**
     * 用户注销
     */
    function actionLogout(){
    	$this->_app->cleanCurrentUser();
    	return $this->_redirectMessage('成功注销','成功注销',url('default/index'),2);
    }
}

