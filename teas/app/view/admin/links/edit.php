<?php $this->_extends('_layouts/default_layout'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>友情链接列表</h3>
	
<?php $this->_control('admin_smalltabs','links',	array(
					'menu'=>'友情链接列表',
					'current'=>$form['link_id']->value ? '编辑友情链接': '添加友情链接',
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
