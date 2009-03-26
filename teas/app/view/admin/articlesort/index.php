<?php $this->_extends('_layouts/default_layout');?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>文章栏目管理</h3>
 <?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'文章栏目管理' ,
    'current' => '文章栏目管理',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的所有文章的栏目。</li>
	<li>注意:删除文章栏目会删除该栏目下的所有新闻</li>
  </ul>
</div>
</div>
<?php $this->_element('sort');?>
<?php $this->_endblock();?>