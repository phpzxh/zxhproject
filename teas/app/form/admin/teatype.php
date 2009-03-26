<?php 
	/**
	 * 茶叶分类表单
	 *
	 */
	class Form_Admin_Teatype extends QForm {
		
		static function createForm($id,$action){
			//创建表单及添加元素	
			$form = new Form_Admin_Teatype($id,$action);
			$form->add(QForm::ELEMENT ,'name',array('_ui'=>'textbox','_label'=>'分类的名称','class'=>'txt','_req'=>true,'_tips'=>'请输入茶叶分类的名字不要超过40个字符'))
			->add(QForm::ELEMENT ,'id',array('_ui'=>'hidden'))->add(QForm::ELEMENT ,'parent_id',array('_ui'=>'admin_typelist','_label'=>'父级类名','class'=>'txt'))
			->addValidations(TeaType::meta());
			
			return $form;
		}
		
		
	}
