<?php $this->_extends('_layouts/default_layout'); ?>
<?php $this->_block('contents');?>
<div class="tabs_title clearfix">
  <h3>业界动态</h3>
  
<?php
$this->_control('Admin_SmallTabs', 'small_tabs', array(
    'menu' =>'所有新闻' ,
    'current' => '所有新闻',
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
<div id="finds">
<?php $this->_element('find',array('findform'=>$findform));?>
</div>
<?php  $this->_element('news',array('form'=>$form));?>
<?php $this->_control('Paginator','page',array('pagination'=>$page,'show_count'=>true,'url_args'=>$agrs));?>
<script type="text/javascript" >
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
			  $.post("<?=url("news/ajaxishot");?>",
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
		  	// ajax提交把新闻改成是热点
			  $.post("<?=url("news/ajaxishot");?>",
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
			$.post("<?php echo url("news/ajaxistop"); ?>",
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
			$.post("<?php echo url("news/ajaxistop"); ?>",
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
		//得到id
		news_id = $(this).attr('new_id');
		if($(this).text() == "是"){
			$.post("<?php echo url("news/ajaxisshow"); ?>",
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
			
				$.post("<?php echo url("news/ajaxisshow"); ?>",
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
	});

</script>
<?php $this->_endblock(); ?>