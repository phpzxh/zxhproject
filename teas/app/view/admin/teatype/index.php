<?php $this->_extends('_layouts/default_layout'); ?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>茶叶类别管理</h3>
  
<?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'分类列表' ,
    'current' => '分类列表',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出本站的所有茶叶的分类。</li>
	<li>在操作菜单中,你可以"编辑"和"删除"该分类。<font color="RGB(255,11,120)">注意:删除分类时要确保该分类没有子类,否则删除会失败。</font></li>
  </ul>
</div>
</div>
<form class="adminform" name="newsform" method="post" action="<?php echo url('teatype/delete'); ?>">
  <table>
    <tr>
      <th>类别名称</th>
      <th>添加日期</th>
      <th>该栏目茶叶数</th>
      <th>操作</th>
      <th></th>
    </tr>

<?php foreach ($teatypes as $key=>$type): ?>
   
	<tr  <?php if($type['parent_id'] !='-1'):?>style="display:none;" <?php endif;?> sons="<?=$type['nodes'];?>" level="<?=$type['level']; ?>">
      <td >
	  <?php if(!empty($type['nodes'])):?>
	  <img src="<?= $_BASE_DIR; ?>/css/admin/menu_plus.gif"  style=" padding-left:<?=$type['level']?>em;cursor:pointer;" width="9" height="9" border="0" onclick="js_folding(this,<?=$type['nodes']?>)" />
	  <?php else :?>
	   <img src="<?= $_BASE_DIR; ?>/css/admin/menu_minus.gif"  style=" padding-left:<?=$type['level']?>em;cursor:pointer;" width="9" height="9" border="0" onclick="js_folding(this,<?=$type['nodes']?>)" />
	  <?php endif;?>
	  <span style="margin-left:1px;"><?php echo $type['name']; ?></span></td>
      <td ><?php echo date('Y-m-d H:i', $type['created']); ?></td>
	  <td ><?php echo $type['count_teas'];?></td>
	  <td ><a href="<?php echo url('teatype/edit', array('id' => $type['id'])); ?>">编辑</a> <a href="<?php echo url('teatype/delete', array('id' => $type['id'])); ?>" onclick="return confirm('你确定要删除该分类?');">删除</a></td>
	  <td></td>
    </tr>

<?php endforeach; ?>

	
</form>
<script language="javascript" type="text/javascript">
<!--
	function js_folding(obj,rowNum){
		//得到该行 、表格 图片 对象
		var tr = obj.parentNode.parentNode;
		var tab = tr.parentNode.parentNode;
		var img = tr.getElementsByTagName("IMG")[0];
		
		//是否有子栏目
		if(rowNum >0){
			
			  //得到该行的图片 及下一行对象
			  var src =img.src.substr(img.src.lastIndexOf('/')+1);
		      var nextRow =tr.rowIndex+1;
			  //是否显示的是+图标
			  if(src =="menu_plus.gif"){
			  	//下一行的 级别号
				subLevel = parseInt(tr.getAttribute('level'))+1;
				//张开菜单
				for(var i=0; i<rowNum; i++){
					//得到下一行行的索引
					var row = tab.rows[nextRow+i];
					//得到下一行的级别
					var level =parseInt(row.getAttribute('level'));
					//如果相等显示 下一级别的所有行
					if(level == subLevel) row.style.display="";
				}
				 //该图片改为-
       				 img.src = "<?= $_BASE_DIR; ?>/css/admin/menu_minus.gif";
				
			  }else{
			  //收缩 菜单
			  	//子菜单 图标修改及隐藏
			  	for(var i=0; i<rowNum; i++){
					
					var row = tab.rows[nextRow+i];
					var sons = parseInt(row.getAttribute('sons'));
					
					if(sons >0){
						row.getElementsByTagName("IMG")[0].src ="<?=$_BASE_DIR;?>/css/admin/menu_plus.gif";
					}
					
					row.style.display="none";
				}
			  	
			  	//改变改行自己的图片
				  img.src ="<?=$_BASE_DIR;?>/css/admin/menu_plus.gif";
				  
			  }
			
			
		}else{
			
			//设置改栏目图片为-
		 img.src ="<?= $_BASE_DIR; ?>/css/admin/menu_minus.gif";	
		}
	
	}
-->
</script>

<?php $this->_endblock(); ?>