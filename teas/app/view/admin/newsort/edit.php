<?php $this->_extends('_layouts/default_layout');?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>新闻栏目管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'新闻栏目管理',
					'current'=>$form['id']->value ? '修改栏目' : '添加栏目'
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里可以添加新闻的栏目</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<?php $this->_endblock();?>