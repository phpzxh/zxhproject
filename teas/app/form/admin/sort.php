<?php

 class Form_Admin_Sort  extends QForm {
 	
 	/**
   	 * 创建表单
   	 *
   	 * @param string $action 表单的url
   	 * @return objcet 表单对象
   	 */
   		static function createForm($id,$action){
   			 return self::_createFormConfig($id,$action,'form_sort.yaml');
   		}
   		/**
   		 * 从配置文件中生成新闻表单
   		 *
   		 * @param string $action 表单的url
   		 * @param string $config 配置文件的名字
   		 * @return object 表单对象
   		 */
   		static function _createFormConfig($id,$action,$config){
   			
   			$form =new Form_Admin_Sort($id,$action);
   			$fileName=dirname(__FILE__).DS."$config";
   			$form->loadFromConfig(Helper_YAML::load($fileName));
   		
   			//查询父类的id号
   			if('article'==$id){
   				
   					$form->addValidations(Articlesorts::meta());
   					$form['name']->_label='文章分类名称';
   			    	$parent=Articlesorts::find("name =?",'茶与文化')->setColumns('id')->asArray()->query();
   			     
   			}else {
   					$form->addValidations(NewSort::meta());
   					$parent=NewSort::find("name =?",'业界动态')->setColumns('id')->asArray()->query();
   			}
            $form['parent_id']->value=$parent['id'];
 			return $form;
 
   		}
 
 
 }