<form class="adminform" <?php foreach ($form->attrs() as $attr=>$value ): 
 $value=h($value);
 if($attr == 'id'){
 	$id=$value;
 }
 echo "{$attr}=\"{$value}\"";
endforeach;?>>
  <table>
    <tr>
      <th></th>
      <th>ID号</th>
      <th>类别名称</th>
      <th>添加日期</th>
      <th>该栏目新闻数</th>
      <th>操作</th>
      <th></th>
    </tr>

<?php foreach ($sorts as $sort): ?>

	<tr>
      <td width="5%"></td>
      <td><?php echo $sort->id;?></td>
	  <td><?php echo h($sort->name); ?></td>
      <td><?php echo date('Y-m-d H:i', $sort->created); ?></td>
	  <td><?php echo $sort->news_count;?></td>
	 <td>
	 <?php if($id == 'article'): ?>
	 <a href="<?php echo url('articlesort/edit', array('id' => $sort->id)); ?>">编辑</a>
	 <a href="<?php echo url('articlesort/delete',array('id' => $sort->id));?>">删除</a>
	 <?php else :?>
	 <a href="<?php echo url('newsort/edit',array('id' => $sort->id)); ?>">编辑</a>
	  <a href="<?php echo url('newsort/delete',array('id' => $sort->id));?>" onclick="return confirm('你确定要删除该栏目?');">删除</a>
	 <?php endif;?>
	 </td>
    </tr>

<?php endforeach; ?>

	</table>
  
</form>