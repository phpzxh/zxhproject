<?php

  class Controller_Admin_ArticleSort extends Controller_Abstract {
  	
  	/**
  	   * 茶与文化类别列表
  	   *
  	   */
  	function actionIndex(){
  		$form = new QForm('article',url('articlesort/delete'));
  		$sort=Articlesorts::find('name = ? AND parent_id =-1','茶与文化')->asArray()->query();

  		$sort=Articlesorts::find('parent_id =?',$sort['id'])->all()->query();

  		$this->_view['sorts']=$sort;
  		$this->_view['form']=$form;
  	}
  	function  actionCreate(){
  		
  			//设置视图
		$this->_viewname='edit';
		$form= Form_Admin_Sort::createForm('article',url('articlesort/create'));
	
		if($this->_context->isPOST() && $form->validate($_POST)){
			
			try {
				//表单的数据构造模型
				$newSorts=new Articlesorts($form->values());
			    $newSorts->save();	
			    return $this->_redirectMessage('创建文章类别成功','如果你不做出选择系统将自动跳转',url('articlesort/index'),3);
			    
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
		$form = Form_Admin_Sort::createForm('article',url('articlesort/edit'));
		$sortId =(int)$this->_context->id;
		$newsort = Articlesorts::find('id =?',$sortId)->query();
		//导入数据到表单
		$form->import($newsort);
		if($this->_context->isPOST() && $form->validate($_POST)){
			try {
				//更新模型的数据
				$newsort->changeProps($form->values());
				
			    $newsort->save();	
			    return $this->_redirectMessage('编辑文章类别名成功','如果你不做出选择系统将自动跳转',url('articlesort/index'),3);
				
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
	  	Articlesorts::meta()->destroyWhere('id IN (?)',$array_id);
	  }
	  return $this->_redirectMessage('删除文章类别成功','如果你不做出选择系统将自动跳转',url('articlesort/index'),3);
	}
  	
  	
  }