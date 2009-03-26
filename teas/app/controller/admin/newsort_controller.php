<?php
// $Id$

/**
 * Controller_Admin_Newsort 控制器
 */
class Controller_Admin_Newsort extends Controller_Abstract
{

	function actionIndex()
	{
        // 为 $this->_view 指定的值将会传递数据到视图中
		# $this->_view['text'] = 'Hello!';
		$form = new QForm('news_sort',url('newsort/delete'));
		$sort=NewSort::find('name = ? AND parent_id =-1','业界动态')->asArray()->query();
		
		$sort = NewSort::find('parent_id =?',$sort['id'])->all()->query();
			
		$this->_view['sorts'] =$sort;
		$this->_view['form'] =$form;
		$this->_view['sum'] =count($sort);
	}
	/**
	 * 添加新闻栏目
	 */
	function actionCreate(){
		//设置视图
		$this->_viewname='edit';
		$form= Form_Admin_Sort::createForm('newsort',url('newsort/create'));
	
		if($this->_context->isPOST() && $form->validate($_POST)){
			
			try {
				//表单的数据构造模型
				$newSorts=new NewSort($form->values());
			    $newSorts->save();	
			    return $this->_redirectMessage('创建新闻类别成功','如果你不做出选择系统将自动跳转',url('newsort/index'),3);
			}catch (QValidator_ValidateFailedException $ex){
				
				$form->invalidate($ex);
				
			}
		}
         	
		$this->_view['form']=$form;
	}
	/**
	 * 编辑新闻栏目
	 */
	function actionEdit(){
		//创建表单
		$form = Form_Admin_Sort::createForm('newsort',url('newsort/edit'));
		$sortId =(int)$this->_context->id;
		$newsort = NewSort::find('id =?',$sortId)->query();
		//导入数据到表单
		$form->import($newsort);
		if($this->_context->isPOST() && $form->validate($_POST)){
			try {
				//更新模型的数据
				$newsort->changeProps($form->values());
				
			    $newsort->save();	
			   return $this->_redirectMessage('修改新闻类别名成功','如果你不做出选择系统将自动跳转',url('newsort/index'),3);
				
			}catch (QValidator_ValidateFailedException $ex){
				
				 $form->invalidate($ex);
			}
		}
		
		$this->_view['form']=$form;
	}
	/**
	 * 删除新闻类别
	 *
	 */
	function actionDelete(){
		//得到要删除的id 号
	  $array_id = (array)$this->_context->id;
	 
	  //是否选择了一条记录
	  if(!empty($array_id)){
	  	NewSort::meta()->destroyWhere('id IN (?)',$array_id);
	  }
	   return $this->_redirectMessage('删除新闻类别成功','如果你不做出选择系统将自动跳转',url('newsort/index'),3);
	}
	
	
	
}


