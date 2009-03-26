<?php
// $Id$

/**
 * Controller_Admin_Default 控制器
 */
class Controller_Admin_Default extends Controller_Abstract
{

	function actionIndex()
	{
        // 为 $this->_view 指定的值将会传递数据到视图中
		# $this->_view['text'] = 'Hello!';
		$this->_view['error']='';
	}
	function actionHome(){
		$this->_view['admin_tabs']=Q::ini('appini/admin_tabs');
		$admin=$this->_app->currentUser();
		
		$this->_view['admin']=$admin;
	}
	/**
	 * 生成验证码
	 *
	 */
	function actionImgcode(){
		
		return Helper_ImgCode::create();
	}
	/**
	 * 管理员登录
	 */
	function actionLogin(){
		$error='';
		if($this->_context->isPOST()){
			//得到表单提交的数据
			$username=trim($this->_context->username);
			$password=trim($this->_context->password);
			$imgcode=trim($this->_context->imgcode);
			
			//判断验证码是否正确
			if(!Helper_ImgCode::isValid($imgcode)){
				$error="验证码错误！";
			}else{
				try {
				
					$user=User::meta()->validateLogin($username,$password);
					//得到用户的角色
					$roles=$user->aclRoles();	
				
				   	//查看用户的roles并存入session
				   	if(in_array('ADMIN',$roles) && $user->id()){
				   		$this->_app->changeCurrentUser($user->aclData(),$roles);
				   	//重定向浏览器
//					 return $this->_redirectMessage(
//		                    '登录成功', 
//		                    '您已经成功登录。登录后可以创建和修改任务列表。',
//		                   	 url('default/home')
//                   	 );
					 return $this->_redirect(url('default/home'));
				   	}
					
				}
				catch (AclUser_Exception $ex){
					
					$error=$ex->getMessage();
					if($error){
						$error="用户名或密码错误！";
					}
				}
			}
		}
		
		$this->_viewname='index';
		$this->_view['error']=$error;
	}
	
}


