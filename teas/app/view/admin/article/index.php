<?php $this->_extends('_layouts/default_layout'); ?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>茶与文化</h3>
  
<?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'所有文章' ,
    'current' => '所有文章',
));
?>
</div>
<div class="block tips">
  <h3>操作提示</h3>
  <ul>
    <li>这里会列出茶与文化的所有文章。</li>
	<li>单击下面的推荐可以把该条新闻，设成推荐的。点击“热点”该条资讯会在成为热点新闻并在首页显示。</li>
  </ul>
</div>
<div id="finds">
<?php $this->_element('find',array('findform'=>$findform));?>
</div>
<?php $this->_element('news',array('form',$form));?>
<?php $this->_control('Paginator','page',array('pagination'=>$pagination,'show_count'=>true,'url_args'=>$agrs));?>
<script type="text/javascript">
//新闻ajax管理

	$(document).ready(function(){
		
			// 改变是否热点的字体颜色
	$(".ishot").each(function() {
	
		if( $(this).text() == "是" ) {
			$(this).addClass("green");
		}else{
			$(this).addClass("red");
		}
		
	});
	//改变是否推荐的字体颜色
	$(".istop").each(function(){
		if($(this).text() =="未推荐"){
			$(this).addClass("red");
		}else{
			$(this).addClass("green");
		}
	});
	
	//是否显示
	$(".isshow").each(function(){
		if($(this).text()=="是"){
			$(this).addClass("green");		
		}else{
			$(this).addClass("red");
		}
	});
		
	});
	/**
	  为是否热点新闻绑定事件
	 **/
	$(".ishot").click(function(){
		//的到新闻的id
		news_id=$(this).attr("new_id");
		
		//如果是热点
		  if($(this).text()=="是"){
		  // ajax提交把新闻改成不是热点
			  $.post("<?=url("article/ajaxishot");?>",
			       {news_id :news_id,is_hot:0},
				  function(response){
				  	 //把标签的值改成否	
				  	 if(response)
				  	 	$("#tr_"+news_id).text("否");
				  	 	$("#tr_"+news_id).removeClass("green");
				  	    $("#tr_"+news_id).addClass("red");
				  }
			  );
		 
		  }else{
		  	// ajax提交把新闻改成不是热点
			  $.post("<?=url("article/ajaxishot");?>",
			       {news_id :news_id,is_hot:1},
				  function(response){
				  	 //把标签的值改成否
				  	 if(response){	
				  		 $("#tr_"+news_id).text("是");
				  		 $("#tr_"+news_id).removeClass("red");
				  		 $("#tr_"+news_id).addClass("green");
				  	 }
				  }
			  );
		  	
		  }
	});
	/**
	 是否推荐的新闻绑定事件
	 **/
	$(".istop").click(function(){
		//的到新闻的id
		news_id=$(this).attr("new_id");
		//该新闻如果是已推荐推荐
		if($(this).text() =="已推荐"){
			//post方式提交新闻的信息 更改新闻为未推荐
			$.post("<?php echo url("article/ajaxistop"); ?>",
				{news_id:news_id, isTop:0},
			    function(data){
					//返回成功
					if(data){
						$("#istop_"+news_id).text("未推荐");
						$("#istop_"+news_id).removeClass("green");
						$("#istop_"+news_id).addClass("red");
					}
				}
			);
		}else{
				//post方式提交新闻的信息 更改新闻为已推荐
			$.post("<?php echo url("article/ajaxistop"); ?>",
				{news_id:news_id, isTop:1},
			    function(data){
					//返回成功
					if(data){
						$("#istop_"+news_id).text("已推荐");
						$("#istop_"+news_id).removeClass("red");
						$("#istop_"+news_id).addClass("green");
					}
				}
			);
		}
		
	});
	
	//ajax改变新闻是否显示
	$(".isshow").click(function(){
		  //得到id的值
		news_id = $(this).attr('new_id');
		if($(this).text() == "是"){
			$.post("<?php echo url("article/ajaxisshow"); ?>",
			{ news_id:news_id, isShow:0 },
			function(data){
					if(data){
						$("#isshow_"+news_id).text("否");
						$("#isshow_"+news_id).removeClass("green");
						$("#isshow_"+news_id).addClass("red");
					}
			}
			);
			
		}else{
			
				$.post("<?php echo url("article/ajaxisshow"); ?>",
						{news_id:news_id, isShow:1},
								function(data){
										if(data){
											$("#isshow_"+news_id).text("是");
											$("#isshow_"+news_id).removeClass("red");
											$("#isshow_"+news_id).addClass("green");
										}
								}
			);
		}
	}
	);

</script>
<?php $this->_endblock();?>