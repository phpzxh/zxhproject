<?php
// $Id$

/**
 * Controller_Admin_Solutions 控制器
 */
class Controller_Admin_Solutions extends Controller_Abstract
{
	
	/**
	 * 解决方案列表
	 *
	 */
	function actionIndex()
	{
        
		$solution = Solution::find()->getAll();
		$this->_view['solution'] =$solution;
	}
	/**
	 * 编辑解决方案
	 *
	 */
	function actionEdit(){
		//创建表单
		$form = new QForm('solution',url('solutions/edit'));
		$form->add(QForm::ELEMENT ,'id',array('_ui'=>'hidden'))
		     ->add(QForm::ELEMENT ,'name',array('_ui'=>'textbox','_label'=>'解决方案名'))
		     ->add(QForm::ELEMENT ,'content',array('_ui'=>'fckeditor','_label'=>'内容','class'=>"txt",'height'=>'500px','width'=>'60%'));
		 $form ->addValidations(Solution::meta());
		 
		 $solu_id =(int) $this->_context->id;
		 $data = Solution::find($solu_id)->query();
		  //导入数据
		$form->import($data);
	   	if($this->_context->isPOST() && $form->invalidate($_POST)){
	   		
			try {
				
	   			$data->changeProps($form->values());
	   			$data->save();
	   			
	   			return $this->_redirectMessage('修改成功','修改改页面成功',url('solutions/index'));
			}catch (QValidator_ValidateFailedException $ex){
				
				$form->invalidate($ex);
				
			}
	   	
		}
		
		$this->_view['form'] =$form;   
		     
		     
	}
	
}


