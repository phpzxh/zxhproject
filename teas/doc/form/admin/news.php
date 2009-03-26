<?php
 
   class Form_Admin_News extends QForm {
   	
   	/**
   	 * 创建表单
   	 *
   	 * @param string $action 表单的url
   	 * @return objcet 表单对象
   	 */
   		static function createForm($action){
   			 return self::_createFormConfig($action,'form_news.yaml');
   		}
   		/**
   		 * 从配置文件中生成新闻表单
   		 *
   		 * @param string $action 表单的url
   		 * @param string $config 配置文件的名字
   		 * @return object 表单对象
   		 */
   		static function _createFormConfig($action,$config){
   			
   			$form =new Form_Admin_News('create_news',$action);
   			$fileName=dirname(__FILE__).DS."$config";
   			$form->loadFromConfig(Helper_YAML::load($fileName));
   			$form->addValidations(News::meta());
   			//查询类别
   			$sort=NewSort::find()->order('name ASC')->getAll();
   			$sort=Helper_Array::toHashmap($sort,'id','name');
   			$form['newbody']['sort_id']->items=$sort;
   			
 			return $form;
 
   		}
   	
   }