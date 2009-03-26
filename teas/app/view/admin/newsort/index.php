<?php $this->_extends('_layouts/default_layout');?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>新闻栏目管理</h3>
 <?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'新闻栏目管理' ,
    'current' => '新闻栏目管理',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的所有新闻的栏目。</li>
	<li>注意:删除新闻栏目会删除该栏目下的所有新闻</li>
  </ul>
</div>
</div>
<?php $this->_element('sort');?>
<div class="paginator"><p>共 <?php echo $sum; ?> 个栏目</p></div>
<?php $this->_endblock();?>