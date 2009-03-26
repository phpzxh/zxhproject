<?php
/**
 * 茶叶表单
 *
 */
 class Form_Admin_Tea extends Form_Admin_Upload {
 	
 	/**
 	 * 创建表单
 	 *@param string $action 表单的url
 	 *@param string $status 表单的状态是编辑还是新建
 	 */
 	 static  function createForm($action,$status='create'){
 	 	
 	 	$form =self::_createFormConfig($action,'form_teas.yaml');
 	 	if($status ='edit'){
 	 		
 	 	}
 	 	return $form;
 	 }
 	 /**
 	  * 从配置文件中创建表单
 	  * @param string $action     表单的url	
 	  * @param string $configName  配置文件的名字
 	  * @return Form_Tea $form
 	  */
 	 static protected function _createFormConfig($action,$configName){
 	 	
 	 	$form= new Form_Admin_Tea('tea_form',$action);
 	 	$filename = rtrim(dirname(__FILE__), '/\\') . DS . $configName;
 	 	$form->loadFromConfig(Helper_YAML::load($filename));
 	 	$form->addValidations(Tea::meta());
 	 	//图片的路径
 	 	$form['thumb_filename']->dir =Q::ini('appini/teapics/img_dir');
 	 	//上传图片的限制
 	 	$types =Q::normalize(Q::ini('appini/teapics/upload_allowed_types'));
 	 	$size = intval(Q::ini('appini/teapics/upload_allowed_size') * 1024);
 	 	$dim = Q::ini('appini/teapics/img_pic_width') . 'x' . Q::ini('appini/teapics/img_pic_height');
        $form['postfile']->_tips = sprintf($form['postfile']->_tips, implode('/', $types), $size / 1024, $dim);
//        茶叶类别
//       $teatype = new TeaType();
//       $form['type_id']->items=$teatype->list;
        $form ->selectUploadElement('postfile')
     		  ->uploadAllowedSize($size)
       		  ->uploadAllowedTypes($types)
       		  ->enableSkipUpload();
 	 	return $form;
 	 }
 	
 	
 }

 