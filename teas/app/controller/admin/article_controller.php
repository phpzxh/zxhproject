<?php
// $Id$

/**
 * Controller_Admin_Article 控制器
 */
class Controller_Admin_Article extends Controller_Abstract
{
 
	function actionIndex()
	{
        $page = intval($this->_context->page) ;
        if($page <1) $page=1;
		$form =new QForm('article',url('article/update'));
		//查询参数
		$agrs=null;
		//条件查询
		if(!empty($this->_context->find)){
		
			$condition=null;
			$sortId=isset($this->_context->sorts) ? intval($this->_context->sorts) :null;
			$title =isset($this->_context->keywords) ? trim($this->_context->keywords) :null;
//			$QCon = new QDB_Cond();
//			if($sortId !=0){
//				$QCon ->andCond('sort_id =?',$sortId);
//			}
//			
//			if(isset($title)){
//				$QCon ->andCond('title like ?','%'.$title.'%');
//			}
			
			if($sortId !=0){
				$condition .="1 AND sort_id =$sortId";
			}
			
			if(!empty($title)){
				$condition .='1 AND title like '.'\'%'.$title.'%\'';
			}
			
			$select =Articles::find($condition)->order('order_num DESC');
			$agrs =array('sorts'=>$sortId,'keywords'=>$title,'find'=>1);
			
		}else {
			//查询所有
			$select =Articles::find()->order('order_num DESC');
			
		}
		$select->limitPage($page,20);
		$pagenation=$select->getPagination();
		$news =$select->query('newsort,user');
		
		//构建查询表单
	  	$findForm= new QForm('new_find',url('article/index'));
	  	$findForm->add(QForm::ELEMENT ,'keywords',array('_ui'=>'textbox','_label'=>'文章的标题'))
	  	->add(QForm::ELEMENT ,'sorts',array('_ui'=>'dropdownlist'))
	  	->add(QForm::ELEMENT ,'find',array('_ui'=>'hidden','value'=>'1'));
	  	
	  	//查询新闻类别的子类信息
 		$new =new Articles();
	  	$findForm['sorts']->items=$new->sorts;
	  	unset($new);
	  	
		$this->_view['form']=$form;
		$this->_view['news']=$news;
		$this->_view['pagination'] =$pagenation;
		$this->_view['findform']=$findForm;
		$this->_view['agrs'] =$agrs;
	}
	/**
	 * 更新文章
	 * 
	 */
	
	function actionEdit(){
		
		$form=Form_Admin_News::createForm('article',url('article/edit'));
		$newId=$this->_context->id;
		$news= Articles::find('id =?',$newId)->query();
		$form->import($news);

		if($this->_context->isPOST() && $form->validate($_POST)){
			try {
				$news->changeProps($form->values());
				$news->save();
				
			return $this->_redirectMessage('更新文章信息成功','如果你不做出选择系统将自动跳转',url('article/index'),3)	;
			
			}catch (QValidator_ValidateFailedException $ex){
				$form->invalidate($ex);
			}
		}
		$this->_view['form']=$form;
	}
	
	/**
	 * 发布新闻
	 *
	 */
	function actionCreate(){
		
		$this->_viewname='edit';
		$form= Form_Admin_News::createForm('article',url('article/create'));
		
		if($this->_context->isPOST()&& $form->validate($_POST)){
		
			//是否post提交及通过验证
			try {
				
				$news = new Articles($form->values());
				$user=$this->_app->currentUser();
				$news['user_id']=$user['id'];

			    //更新该栏目下的新闻条数
			    
			     $newSort = Articlesorts::meta()->find('id =?',$form['sort_id']->value)->query();	
                 $newSort->news_count++;
               		$newSort->save();	
               		//保存更新		    
			    $news->save();
				return $this->_redirectMessage('发表文章成功','如果你不做出选择系统将自动跳转',url('article/index'),3)	;
				
			}catch (QValidator_ValidateFailedException $ex){
				
				$form->invalidate($ex);
			}
		}
	
		$this->_view['form']=$form;
		
	}
		/**
		 * 更新新闻
		 *
		 */
		function actionUpdate(){
			$newsid=(array)$this->_context->id;
			//是否要选择了删除复选框
			if(!empty($newsid)){
				Articles::meta()->deleteWhere('id in(?)',$newsid);
			}
			//得到要更新的列表
		    $ordernum=(array)$this->_context->order_num;
		    foreach  ($ordernum as $id=>$ordernum){
				//是否是要删除的
				if(in_array($id,$newsid)) continue;
				
				Articles::meta()->updateWhere(array('order_num'=>$ordernum),'id =?',$id);
			}
			return $this->_redirectMessage('更新文章成功','如果你不做出选择系统将自动跳转',url('article/index'),3)	;
		}
		/**
		 * ajax方式改变新闻是否热点
		 *
		 */
	 function actionAjaxIsHot(){
	 	//是否是ajax提交
	  if($this->_context->isAJAX()){
	 	$is_hot =$this->_context->is_hot;
	 	$news_id =$this->_context->news_id;
	  	//更新用户的数据
	    Articles::meta()->updateDbWhere(array('is_hot'=>$is_hot),"id =?",$news_id);
	 	echo 1;
	  }else {
	  	
	  	   echo  false;
	  }
	  
	 }
	 /**
	  * ajax方式改变新闻是否推荐
	  */
	 function actionAjaxIsTop(){
	 	//是否是ajax提交
	 	if($this->_context->isAJAX()){
	 		
	 		$news_id=$this->_context->news_id;
	 		$is_top=$this->_context->isTop;
	 		
	 		//更新新闻是否推荐
	 		try {
	 			Articles::meta()->updateWhere(array('recommend'=>$is_top),'id =?',$news_id);
	 			echo true;
	 			
	 		}catch(QDB_Exception $ex){
	 			echo false;
	 		}
	 	}else {
	 		echo false;
	 	}
	 	
	 }
	 
	 /**
	  * 是否显示新闻
	  *
	  */
	 function actionAjaxIsShow(){
	 	
	 	if($this->_context->isAJAX()){
	 		$new_id  = $this->_context->news_id;
	 		$is_show = $this->_context->isShow;
	 		try {
	 			Articles::meta()->updateWhere(array('is_show'=>$is_show),'id =?',$new_id);
	 			echo true;
	 		}catch (QDB_Exception $ex){
	 			echo false;
	 		}
	 	}else {
	 		echo false;
	 	}
	 	
	 }
	
}


