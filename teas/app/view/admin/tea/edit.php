<?php $this->_extends('_layouts/default_layout'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>茶叶管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'茶叶列表',
					'current'=>$form['id']->value ? '编辑茶叶':'',
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>“*”号代表的是必需填写的项</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<?php $this->_endblock();?>
