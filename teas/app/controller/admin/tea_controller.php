<?php
// $Id$

/**
 * Controller_Admin_Tea 控制器
 */
class Controller_Admin_Tea extends Controller_Abstract
{
	/**
	 * 茶叶的列表
	 *
	 */
	function actionIndex()
	{
   
		//得到页码
		$page = intval($this->_context->page);
		if($page <1) $page =1;
		$agrs =null;
		if(!empty($this->_context->find)){
			
			//查询新闻
			$condition =null;
			$type =isset($this->_context->type) ? intval($this->_context->type) :null;
			$name =isset($this->_context->name) ? trim($this->_context->name) :null;
//			$QCon = new QDB_Cond();
//			if($sortId !=0){
//				$QCon ->andCond('sort_id =?',$sortId);
//			}
//			
//			if(isset($title)){
//				$QCon ->andCond('title like ?','%'.$title.'%');
//			}
			
			if($type !=-1){
				$condition .="1 AND type_id =$type";
			}
			
			if(!empty($name)){
				$condition .='1 AND name like '.'\'%'.$name.'%\'';
			}
			
			$tea =Tea::find($condition)->order('order_num DESC');
			$agrs =array('type'=>$type,'name'=>$name,'find'=>1);
			
			
		}else {
			
			$tea =Tea::find()->order('order_num DESC');
		}
		$tea ->limitPage($page,20);
		
		//分页信息
		$pagination=$tea->getPagination();
		$teas =$tea->query('teatype');
		
		
		
		
		//构建查询表单
	  	$findForm= new QForm('tea_find',url('tea/index'));
	  	$findForm->add(QForm::ELEMENT ,'name',array('_ui'=>'textbox','_label'=>'茶叶名'))
	  	->add(QForm::ELEMENT ,'type',array('_ui'=>'admin_typelist'))
	  	->add(QForm::ELEMENT ,'find',array('_ui'=>'hidden','value'=>'1'));
	  	
	  	//添加茶叶类别的列表信息
 		$teaType =new TeaType();
	  	$findForm['type']->items=$teaType->list;
	  	unset($teaType);
	  	
	  	$this->_view['findform']=$findForm;
	  	$this->_view['agrs'] =$agrs;
		$this->_view['pagination']=$pagination;
		$this->_view['teas']=$teas;
		
	}
	/**
	 * 编辑茶叶属性
	 */
	function actionEdit(){
		
		$form = Form_Admin_Tea::createForm(url('tea/edit'));
		$teaId =intval($this->_context->id);
		//查询改记录
		$tea = Tea::find('id =?',$teaId)->query();
		// 导入数据到表单
		$form->import($tea);
		//是否是post提交 及验证通过
		if($this->_context->isPOST() && $form->validate($_POST)){
			
			try {
				//改变表单属性值
				
				$tea->changeProps($form->values());
				
				$tea->save();
				
				return $this->_redirectMessage('恭喜你更新茶叶信息成功','如果你不做出选择系统将自动跳转',url('tea/index'),3);
				
			}catch (QValidator_ValidateFailedException $ex){
				$form->invalidate($ex);
			}
					
		}
		
		$this->_view['tea']=$tea;
		$this->_view['form']=$form;
		
	}
	/**
	 * 茶叶内容更新及删除
	 *
	 * @return unknown
	 */
	function actionUpdate(){
		//得到更新的id数组
		$teaIds =(array)$this->_context->id;
		//有要删除的项
		if(!empty($teaIds)){
			//删除那些记录
//			Tea::meta()->deleteWhere();
			Tea::meta()->destroyWhere('id in(?)',$teaIds);
		}
		//的到排序数子
		$order_num =(array)$this->_context->order_num;
	
		foreach ($order_num as $key=>$value){
				//要更新排序的茶也删除
			if(in_array($key,$teaIds)) continue;
			//更新排序的数子
			Tea::meta()->updateWhere(array('order_num'=>$value),'id =?',$key);
			
		}
		return $this->_redirectMessage('更新茶叶信息成功','如果你不做出选择系统将自动跳转',url('tea/index'),3);
	}
	/**
	 * ajax 改变茶叶的是否热卖
	 *
	 */
	function actionAjaxishot(){
				//是否是ajax提交
		  if($this->_context->isAJAX()){
		 	$is_hot =$this->_context->is_hot;
		 	$tea_id =$this->_context->tea_id;
		  	//更新用户的数据
		    Tea::meta()->updateDbWhere(array('is_hot'=>$is_hot),"id =?",$tea_id);
		 	echo 1;
		  }else {
		  		   echo  false;
		  }
	}
	/**
	 * ajax改变茶叶 状态是否推荐
	 *
	 */
	function actionAjaxistop(){
		
		//是否是ajax提交
		  if($this->_context->isAJAX()){
		 	$is_top =$this->_context->is_top;
		 	$tea_id =$this->_context->tea_id;
		  	//更新用户的数据
		  	try {
		  		
		   		 Tea::meta()->updateDbWhere(array('recommend'=>$is_top),"id =?",$tea_id);
		   		 echo 1;
		   		 
		  	}catch (QDB_Exception $ex){
		  		if($ex->getCode()){
		  			echo false;
		  		}
		  	}
		 	
		  }else {
		  		   echo  false;
		  }
		
	}
	/**
	 * ajax 实现茶叶是否上架
	 *
	 */
	function actionAjaxIsShow(){
		
		if($this->_context->isAJAX()){
			//得到茶叶的信息
			$is_show = $this->_context->post('is_show');
			$tea_id  = $this->_context->post('tea_id');
			try {
				 //更新上架状态
				 if(in_array($is_show,array(0,1))){
					Tea::meta()->updateDbWhere(array('is_show'=>$is_show),'id =?',$tea_id);
					echo true;
				 }
				
			}catch (QDB_Exception $ex){
				
				if($ex->getCode()){
		  			echo false;
		  		}
			}
				
		}else {
			
			echo false;
		}
		
	}
	
	
}


