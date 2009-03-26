<?php
// $Id$

/**
 * Controller_Admin_Links 控制器
 */
class Controller_Admin_Links extends Controller_Abstract
{
	   /**
	    * 友情链接列表
	    *
	    */
		function actionIndex()
		{
		  $page =intval($this->_context->page)	;
		  if($page <1) $page=1;
		  $links = Links::find()->order('order_num');
		  //分页信息
		  $pagenation =null;
		  $links->limitPage($page,20);
		  $links->fetchPagination($pagenation);
		  
		  $this->_view['page']=$pagenation;
	      $this->_view['links'] =$links->query();
		}
		/**
		 * 创建友情链接
		 *
		 */
		function actionCreate(){
			//创建表单
			$form = Form_Admin_Links::createForm('links',url('links/create'));
   			//是否是post提交 及通过验证
   			if($this->_context->isPOST() && $form->validate($_POST)){
   				
   				try {
   					//用表单的数据创建模型
   					$links = new Links($form->values());
   					
   					$links->save();
   					
   					return $this->_redirectMessage('创建友情链接成功','如果你不做出选择系统将自动跳转',url('links/index'),3);
   					
   				}catch (QValidator_ValidateFailedException $ex){
   					
   					$form ->invalidate($ex);
   				}
   				
   			}
   			
			$this->_view['form'] =$form;
			$this->_viewname='edit';
		}
		
		/**
		 * 删除或者更新排序
		 *
		 */
		function actionUpdate(){
			
			$linkid=(array)$this->_context->link_id;
			//是否要选择了删除复选框
			if(!empty($linkid)){
				Links::meta()->destroyWhere('link_id in(?)',$linkid);
			}
			//的到要更新的列表
		    $ordernum=(array)$this->_context->order_num;
		    foreach  ($ordernum as $id=>$num){
				//是否是要删除的
				if(in_array($linkid ,$id)) continue;
				
				Links::meta()->updateWhere(array('order_num'=>$num),'link_id =?',$id);
			}
			return $this->_redirectMessage('更新友情链接成功','如果你不做出选择系统将自动跳转',url('links/index'),3);
			
		}
		/**
		 * 编辑新闻
		 *
		 */
		function actionEdit(){
			
			$link_id =intval($this->_context->link_id);
			//创建表单
			$form = Form_Admin_Links::createForm('links',url('links/edit'));
			$link =	Links::find('link_id =?',$link_id)->query();
			$form ->import($link);
   			//是否是post提交 及通过验证
   			if($this->_context->isPOST() && $form->validate($_POST)){
   				
   				try {
   					
   					$link->changeProps($form->values());
					
   					$link->save();
   					
   				 return $this->_redirectMessage('编辑友情链接成功','如果你不做出选择系统将自动跳转',url('links/index'),3);
   					
   				}catch (QValidator_ValidateFailedException $ex){
   					
   					$form ->invalidate($ex);
   				}
   				
   			}
   			
			$this->_view['form'] =$form;
			$this->_viewname='edit';
		}
		
	
	
}


