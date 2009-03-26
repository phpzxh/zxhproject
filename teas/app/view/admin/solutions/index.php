<?php $this->_extends('_layouts/default_layout');?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
   <h3>解决方案管理</h3>
  <?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'解决方案列表' ,
    'current' =>'解决方案列表',
));
?>

</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的解决方案。</li>
    <li>你可以在这里添加继修改解决方案。</li>
  </ul>
</div>
<form class="adminform" name="newsform" method="post" action="<?php echo url('solutions/update'); ?>">
  <table>
    <tr>
      <th></th>
      <th>解决方案名</th>
      <th>创建时间</th>
      <th>内容</th>
      <th></th>
    </tr>

<?php foreach ($solution as $solu): ?>

	<tr>
      <td><input class="checkbox" type="checkbox" name="id[]" value="<?php echo $solu->id; ?>" /></td>
      <td><?php echo h($solu->name); ?></td>
      <td><?php echo date('Y-m-d h:i',$solu->created);?></td>
	  <td><?php echo mb_substr($solu->content,0,35,'utf-8'); ?></td>
	  <td><a href="<?php echo url('solutions/edit', array('id' => $solu->id)); ?>">编辑</a></td>
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
<?php $this->_endblock();?>