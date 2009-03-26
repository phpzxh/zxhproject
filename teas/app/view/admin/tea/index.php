<?php $this->_extends('_layouts/default_layout'); ?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>茶叶管理</h3>
  
<?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'茶叶列表' ,
    'current' => '茶叶列表',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的所有茶叶。</li>
	<li></li>
  </ul>
</div>
</div>
<div id="finds">
<?php $this->_element('find',array('findform'=>$findform));?>
</div>
<form class="adminform" name="newsform" method="post" action="<?php echo url('tea/update'); ?>">
  <table>
    <tr>
      <th></th>
      <th>茶叶名称</th>
      <th>分类</th>
      <th>上架日期</th>
      <th>产地</th>
      <th>等级</th>
      <th>防伪码</th>
      <th>显示顺序</th>
      <th>是否推荐</th>
      <th>是否热卖</th>
      <th>是否上架</th>
      <th></th>
      <th></th>
    </tr>

<?php foreach ($teas as $tea): ?>

	<tr>
      <td><input class="checkbox" type="checkbox" name="id[]" value="<?php echo $tea->id; ?>" /></td>
      <td><?php echo h($tea->name); ?></td>
      <td><?php echo  $tea->teatype->name;?></td>
	  <td><?php echo date('Y-m-d H:i', $tea->created); ?></td>
	  <td><?php echo h($tea->tea_locality);?></td>
	  <td><?php echo $tea['rate'];?></td>
	  <td><?php echo h($tea->fake_code);?></td>
	  <td><input class="txt" type="text" size="6" maxlength="6" name="order_num[<?php echo $tea->id; ?>]" value="<?php echo intval($tea->order_num); ?>" /></td>
	  <td><a class="istop"  id="istop_<?=$tea->id;?>"><?php if(!$tea['recommend']) echo'未推荐'; else { echo '已推荐';} ?></a></td>
	  <td><a class="ishot" id="hot_<?=$tea->id;?>"><?php if($tea['is_hot']) echo '是'; else echo '否';?></a></td>
	  <td><a class="isshow" id="show_<?=$tea->id;?>"><?php if($tea['is_show']) echo '是'; else echo '否';?></a></td>
      <td><a href="<?php echo url('tea/edit', array('id' => $tea->id)); ?>">编辑</a></td>
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
<?php $this->_control('paginator','page',array('pagination'=>$pagination,'show_count'=>true,'url_args'=>$agrs));?>
<script type="text/javascript" >

	$(document).ready(function(){
		//改变字体颜色
		$(".istop").each(function(){
		if($(this).text() =="未推荐"){
				$(this).toggleClass("red");
		}else{
			$(this).toggleClass("green");
		}
		});
		
		$(".ishot").each(function(){
			if($(this).text() == "是"){
				$(this).toggleClass("green");
			}else{
				$(this).toggleClass("red");
			}
			
		});
		
		$(".isshow").each(function(){
			if($(this).text() == "是"){
				$(this).toggleClass("green");
			}else{
				$(this).toggleClass("red");
			}
		});
		
		
	});
	//为是否推荐绑定事件
	$(".ishot").click(function(){
		//得到表单元素的id 及茶叶的id
		html_id = $(this).attr('id');
		tea_id = html_id.substr(4,html_id.length);
		
		if($(this).text() =="是"){
			// ajax提交把新闻改成不是热点
			  $.post("<?=url("tea/ajaxishot");?>",
			       	{tea_id :tea_id,is_hot:0},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("否");
							$("#"+html_id).removeClass("green");
							$("#"+html_id).addClass("red");
					  }
			  );
		}else{
		
			// ajax提交把新闻改成不是热点
			  $.post("<?=url("tea/ajaxishot");?>",
			       	{tea_id :tea_id,is_hot:1},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("是");
							$("#"+html_id).removeClass("red");
							$("#"+html_id).addClass("green");
					  }
			  );
		
			
		}
		
	});
	
	//为是否上架绑定事件
	$(".isshow").click(function(){
		//得到表单元素的id 及茶叶的id
		html_id = $(this).attr('id');
		tea_id = html_id.substr(5,html_id.length);
		
		if($(this).text() =="是"){
			// 茶叶不上架
			  $.post("<?=url("tea/ajaxisshow");?>",
			       	{tea_id :tea_id,is_show:0},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("否");
							$("#"+html_id).removeClass("green");
							$("#"+html_id).addClass("red");
					  }
			  );
		}else{
		
			// 茶叶上架
			  $.post("<?=url("tea/ajaxisshow");?>",
			       	{tea_id :tea_id,is_show:1},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("是");
							$("#"+html_id).removeClass("red");
							$("#"+html_id).addClass("green");
					  }
			  );
		
			
		}
		
	});
	
	/**
	 是否推荐的新闻绑定事件
	 **/
	$(".istop").click(function(){
		
		//得到表单元素的id 及茶叶的id
		html_id = $(this).attr('id');
		tea_id = html_id.substr(6,html_id.length);
		
		if($(this).text() =="已推荐"){
			// ajax提交把新闻改成不是热点
			  $.post("<?=url("tea/ajaxistop");?>",
			       	{tea_id :tea_id,is_top:0},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("未推荐");
							$("#"+html_id).removeClass("green");
							$("#"+html_id).addClass("red");
					  }
			  );
		}else{
		
			// ajax提交把新闻改成不是热点
			  $.post("<?=url("tea/ajaxistop");?>",
			       	{tea_id :tea_id,is_top:1},
				  function(response){
						 //把标签的值改成否	
						 if(response)
							$("#"+html_id).text("已推荐");
							$("#"+html_id).removeClass("red");
							$("#"+html_id).addClass("green");
					  }
			  );
		
			
		}
	});
	
	
</script>
<?php $this->_endblock(); ?>