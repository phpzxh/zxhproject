<?php
 
   class Form_Admin_News extends QForm {
   	
   	/**
   	 * 创建表单
   	 * @param string $id 表单的id 号
   	 * @param string $action 表单的url
   	 * @return objcet 表单对象
   	 */
   		static function createForm($id,$action){
   			 return self::_createFormConfig($id,$action,'form_news.yaml');
   		}
   		/**
   		 * 从配置文件中生成新闻表单
   		 * @param string $id 表单的id 号
   		 * @param string $action 表单的url
   		 * @param string $config 配置文件的名字
   		 * @return object 表单对象
   		 */
   		static function _createFormConfig($id,$action,$config){
   			
   			$form =new Form_Admin_News($id,$action);
   			$fileName=dirname(__FILE__).DS."$config";
   			$form->loadFromConfig(Helper_YAML::load($fileName));
   			//验证的模型选择
   			if($id	=='news'){
   				$form->addValidations(News::meta());
   			}else {
   				$form ->addValidations(Articles::meta());
   			}
   			//类别表的选择
   			if('news' ==$id){
   				
				$news = new News();
   				$form['sort_id']->items=$news->sorts;
   				
   			}else {
   				
   				$article = new Articles();
   				$form['sort_id']->items=$article->sorts;
   			}
   			
 			return $form;
 
   		}
   	
   }