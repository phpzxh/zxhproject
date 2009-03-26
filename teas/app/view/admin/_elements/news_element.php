<form class="adminform"
 <?php foreach ($form->attrs() as $attr=>$value ): 
 $value=h($value);
 if($attr == 'id'){
 	$id=$value;
 }
 echo "{$attr}=\"{$value}\"";
endforeach;?>>
  <table>
    <tr>
      <th></th>
      <th>标题</th>
      <th>发布人</th>
      <th>添加日期</th>
      <th>所在栏目</th>
      <th>浏览次数</th>
      <th>显示顺序</th>
      <th>是否推荐</th>
      <th>是否热点</th>
      <th>是否显示</th>
      <th>操作</th>
      <th></th>
    </tr>

<?php foreach ($news as $new): ?>

	<tr>
      <td><input class="checkbox"  type="checkbox" name="id[]" value="<?php echo $new->id; ?>" /></td>
     
	  <td><?php echo h(mb_strimwidth($new['title'],0,40,'...','utf8')); ?></td>
      <td><?php echo h($new->user['username']);?></td>
	  <td><?php echo date('Y-m-d H:i', $new->created); ?></td>
	  <td><?php echo h($new->newsort['name']);?></td>
	  <td><?php echo $new['clicks_count'];?></td>
	   <td><input class="txt" type="text" size="6" maxlength="6" name="order_num[<?php echo $new->id; ?>]" value="<?php echo intval($new->order_num); ?>" /></td>
	  <td><?php if(!$new['recommend']) echo "<a class=\"istop\" new_id=$new->id id=\"istop_$new->id\">未推荐</a>"; else { echo "<a class=\"istop\" new_id=$new->id id=\"istop_$new->id\">已推荐</a>";} ?></td>
	  <td><?php if($new['is_hot']) echo "<a class=\"ishot\"  new_id=$new->id id=\"tr_$new->id\">是</a>"; else echo "<a class=\"ishot\"   new_id=$new->id id=\"tr_$new->id\">否</a>";?></td>
	   <td><?php if($new['is_show']) echo "<a class=\"isshow\"  new_id=$new->id id=\"isshow_$new->id\">是</a>"; else echo "<a class=\"isshow\"   new_id=$new->id id=\"isshow_$new->id\">否</a>";?></td>
      <td><a href="<?php if($id =='newsform') echo url('news/edit', array('id' => $new->id)); else echo url('article/edit', array('id' => $new->id)) ; ?>">编辑</a></td>
    </tr>

<?php endforeach; ?>
    
	<tr class="nobg">
	  <td>
	    <input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="$('input[name=\'id[]\']').attr('checked', this.checked);" />
	    <label for="chkall">删除</label>
	  </td>
	  <td colspan="5">
	    <input type="submit" class="btn" name="btnsubmit" value="提交"  />
		&nbsp;&nbsp;&nbsp;
		<?php if($id =='newsform'):?>
		<a href="<?php echo url('news/create');?>">添加新闻</a>
		<?php else :?>
		<a href="<?php echo url('article/create');?>">添加文章</a>
		<?php endif;?>
	  </td>
	</tr>
  </table>
</form>