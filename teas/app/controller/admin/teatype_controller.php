<?php
// $Id$

/**
 * Controller_Admin_Teatype 控制器
 */
class Controller_Admin_Teatype extends Controller_Abstract
{
    /**
     *  茶叶栏目列表
     *
     */
	function actionIndex()
	{
        // 为 $this->_view 指定的值将会传递数据到视图中
		# $this->_view['text'] = 'Hello!';
		$tea_type=TeaType::find()->asArray()->getAll();
		//转换成分类的树
		$tea_tree =Helper_Array::toTree($tea_type,'id','parent_id','nodes');
		
		$tea_tree =TeaType::treeToArray($tea_tree,'nodes');
	
		$this->_view['teatypes']=$tea_tree;
	}
	/**
	 *  删除茶叶栏目
	 */
	function actionDelete(){
		//得到茶叶的id列表
		$typeIds=(int)$this->_context->id;
		if(!empty($typeIds)){
			$teaType =TeaType::find('parent_id =?',$typeIds)->asArray()->getAll();
			if(!count($teaType)){
				TeaType::meta()->destroyWhere('id = ?',$typeIds);
				return $this->_redirectMessage('删除茶叶类别成功','如果你不做出选择系统将自动跳转',url('teatype/index'),3);
			}else {
				return $this->_redirectMessage('删除茶叶类别失败,请先确定该类别没有子类!','如果你不做出选择系统将自动跳转',url('teatype/index'),3);
			}
		}
		
	}
	/**
	 * 添加茶叶栏目
	 */
	function actionCreate(){
		$this->_viewname='edit';

		$form = Form_Admin_Teatype::createForm('teatype',url('teatype/create'));

		//是否是post提交 数据是否通过验证
		if($this->_context->isPOST() && $form->validate($_POST)){
			try {
				
				$teatype = new TeaType($form->values());
				$teatype->sonsCount($teatype->parent_id);
				$teatype->save();
				return $this->_redirectMessage('添加茶叶类别成功','如果你不做出选择系统将自动跳转',url('teatype/index'),3);
				
			}catch (QDB_ActiveRecord_ValidateFailedException $ex){
				$form->invalidate($ex);
			}
			
		}
		$this->_view['form']=$form;
	}
	/**
	 * 修改茶叶类别的信息
	 */
	function actionEdit(){
		
		$form = Form_Admin_Teatype::createForm('teatype',url('teatype/edit'));
		
		//的到栏目的id号
		$typeId= $this->_context->id;
		$data = TeaType::find('id =?',$typeId)->query();
		//导入数据到表单
		$form->import($data);
			//是否是post提交 数据是否通过验证
		if($this->_context->isPOST() && $form->validate($_POST)){
			try {
				//更新茶叶类别的 子类数目
				$data->sonsCount($form['parent_id']->value);
				
				$data->changeProps($form->values());
				
				$data->save();
			return $this->_redirectMessage('更新茶叶类别名成功','如果你不做出选择系统将自动跳转',url('teatype/index'),3);
				
			}catch (QDB_ActiveRecord_ValidateFailedException $ex){
				$form->invalidate($ex);
			}
			
		}
		$this->_view['form']=$form;
	}
	
}


