<?php $this->_extends('_layouts/default_layout');?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>茶叶类别管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'分类列表',
					'current'=>$form['id']->value ? '修改分类' : '增加分类'
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里可以添加茶叶的分类</li>
    <li>如果不选择父类，则新建的分类为根父类</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<?php $this->_endblock();?>