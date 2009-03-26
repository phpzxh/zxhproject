<?php $this->_extends('_layouts/default_layout');?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>本站新闻管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'所有新闻',
					'current'=>$form['id']->value ? '编辑新闻' : '添加新闻'
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>文章正文用的是fck编辑器</li>
     <li>带“*”号的为必填现</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<?php $this->_endblock('contents');?>