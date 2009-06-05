<?php

/**
 * 默认控制器
 */
class Controller_Default extends Controller_Abstract
{
	
	
    function actionIndex()
    {
    	
    	$roles =$this->_app->currentUserRoles();
    	if(empty($roles)){
    		//初始化用户让用户有ROOT角色
    		$user =array('user_id'=>1,'user_name'=>'admin');
    		$this->_app->changeCurrentUser($user,'ROOT');
    		
    	}
    	
    	//得到当前用户的角色
    	$currentRoles = $this->_app->currentUserRoles();
    	//所有的用户组
    	$groups = Rolesgroup::find()->order('group_id ASC')->getAll('roles');
    	$this->_view['groups'] = $groups;
    	$this->_view['requestUri'] =$this->_context->get('requestUri');
    	$this->_view['currentRoles'] =$currentRoles;
    	$this->_view['currentRolesText'] = implode(',',$currentRoles);
    }
    /**
     * 更新用户角色
     *
     */
    function actionUpdateroles(){
    	
    	//得到选择的角色id	
    	$roles_ids = (array) $this->_context->post('roles');
    	
    	//查询所有的角色名
    	$user_roles =array();
    	foreach ($roles_ids as $roles_id){
    		
    		$roles = Sysroles::find('role_id =?',$roles_id)->asArray()->getOne();
    		$user_roles[] = $roles['rolename'];
    	}
    	/**
    	 * 更新用户角色
    	 * 
    	 * 在实际应用程序中，由于角色信息是和用户关联的。
	     * 所以还要更新用户和角色的关联关系。
    	 */
    	$user =array('user_id'=>1,'user_name'=>'admin');
    	$this->_app->changeCurrentUser($user,$user_roles);
    
    	return $this->_redirect(url('default/index'));
    	
    	
    }
}

