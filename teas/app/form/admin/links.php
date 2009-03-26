<?php 

	class Form_Admin_Links extends Form_Admin_Upload {
		
		
		static  function createForm($id,$action){
			
			$form = new Form_Admin_Links($id,$action);
			
			$form->add(QForm::ELEMENT,'name',array('_ui'=>'textbox','_label'=>'友情链接名称','_req'=>true,'_tips'=>'友情链接的网站名') )
			->add(QForm::ELEMENT ,'url',array('_ui'=>'textbox','_label'=>'网站地址','_req'=>true,'_tips'=>'友情链接网站的网址'))
			->add(QForm::ELEMENT ,'link_id',array('_ui'=>'hidden'))
			->add(QForm::ELEMENT ,'img',array('_ui'=>'admin_picpreview','_label'=>'已上传图片','attr'=>array('dir'=>'links')))
			->add(QForm::ELEMENT ,'ico',array('_ui'=>'upload','_label'=>'上传图标','_tips'=>''))
			->add(QForm::ELEMENT ,'order_num',array('_ui'=>'textbox','_label'=>'排序','value'=>0));
			$form ->addValidations(Links::meta());
			//上传图片的限制
	 	 	$types =Q::normalize(Q::ini('appini/teapics/upload_allowed_types'));
	 	 	$size = intval(Q::ini('appini/teapics/upload_allowed_size') * 1024);
	 	 	$dim = Q::ini('appini/teapics/img_pic_width') . 'x' . Q::ini('appini/teapics/img_pic_height');
	        $form['ico']->_tips = sprintf($form['ico']->_tips, implode('/', $types), $size / 1024, $dim);
			$form->selectUploadElement('ico')
				 ->uploadAllowedSize($size)
				 ->uploadAllowedTypes($types)
       		  	 ->enableSkipUpload();
       		  	 //表单验证规则
       		
			return $form;
		}
		
		
		
	}