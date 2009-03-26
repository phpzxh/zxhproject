<?php $this->_extends('_layouts/default_layout');?>
<?php $this->_block('contents');?>

<div class="tabs_title clearfix">
  <h3>友情链接列表</h3>
  
<?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'友情链接列表' ,
    'current' => '友情链接列表',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的所有新闻。</li>
	<li>红色字样代表该新闻不是热点新闻或者是未推荐的新闻，绿色字体代表的是热点新闻或者是推荐的新闻。单击该字样，你可以切换它们的状态。</li>
	<li>显示排序值越大，该条新闻就会排在越前面。你可以单击“提交”来改变或者删除该条新闻。</li>
  </ul>
</div>
</div>

<form class="adminform" name="newsform" method="post" action="<?php echo url('links/update'); ?>">
  <table>
    <tr>
      <th></th>
      <th>友情链接名称</th>
      <th>网站地址</th>
      <th>图标</th>
      <th>排序</th>
      
      <th></th>
      <th></th>
    </tr>

<?php foreach ($links as $link): ?>

	<tr>
      <td><input class="checkbox" type="checkbox" name="link_id[]" value="<?php echo $link->link_id; ?>" /></td>
      <td><?php echo h($link->name); ?></td>
      <td><?php echo  $link->url;?></td>
	  <td><?php if(is_null($link->ico)):?>NULL<?php else: ?><img border="0" src="<?php echo $_BASE_DIR.Q::ini('appini/teapics/img_dir').DS.$link->ico;?>" height="30"> <?php endif; ?></td>
	  <td><input name="order_num[<?=$link->link_id;?>]"  class="txt" type="text" size="6" maxlength="6" value="<?php echo $link->order_num;?>"/></td>
	
      <td><a href="<?php echo url('links/edit', array('link_id' => $link->link_id)); ?>">编辑</a></td>
    </tr>

<?php endforeach; ?>

	<tr class="nobg">
	  <td>
	    <input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="$('input[name=\'id[]\']').attr('checked', this.checked);" />
	    <label for="chkall">删除</label>
	  </td>
	  <td colspan="5">
	    <input type="submit" class="btn" name="btnsubmit" value="提交"  />
		
	  </td>
	</tr>
  </table>
</form>
<?php $this->_control('Paginator','page',array('pagination'=>$page,'show_count'=>true));?>



<?php $this->_endblock('contents');?>