<?php $this->_extends('_layouts/default_layout');?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>文章栏目管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'文章栏目管理',
					'current'=>$form['id']->value ? '修改栏目' : '增加栏目'
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里可以添加文章的栏目</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<?php $this->_endblock();?>