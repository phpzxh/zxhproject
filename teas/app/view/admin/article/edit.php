<?php $this->_extends('_layouts/default_layout');?>
<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_DIR; ?>css/admin/add_css.css"/>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
	<h3>本站文章管理</h3>
	
<?php $this->_control('admin_smalltabs','creatnews',	array(
					'menu'=>'所有文章',
					'current'=>$form['id']->value ? '编辑文章' : '添加文章'
				)
			);?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>文章正文用的是fck编辑器</li>
  </ul>
</div>
<?php $this->_element('form',array('form'=>$form));?>
<script type="text/javascript" language="javascript">
$("document").ready(function(){
	$("#color").click(function(){
		//打开一个窗口
		 var arr = showModalDialog('<?php echo $_BASE_DIR;?>img/selcolor.htm', '', 'dialogWidth:120px; dialogHeight:250px; status:0;scroll:0');
		  //是否有返回值
		  if(arr !=null) 
		  	$("#color").val(arr);
		  else
		   $("#color").focus();
		   //设置背景颜色 
	   $("#color").css('background-color',arr);
		$('#title').css('color',arr);
	});
	
});
</script>
<?php $this->_endblock();?>
