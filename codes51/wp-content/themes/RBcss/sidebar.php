	<div id="sidebar">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<ul id="sidebarul">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<?php //wp_list_pages('title_li=<h3>Pages</h3>' ); ?>
			<li>
				<h3>文章分类</h3>    
				<ul class="side-cat" >
					<?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'); ?>
				</ul>       
			</li>
			<li>
				<h3>存档</h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
			<li>
			<?php wp_list_bookmarks('between=<br />&show_images=0&orderby=name&category_before=<div class="widget">&category_after=</div></div>&title_li=友情链接&title_before=<h3 class="widget-header">&title_after=</h3><div class="widget-content">'); ?>
			</li>
			<li >
				<h3>标签云</h3>
				<ul><?php wp_tag_cloud('smallest=8&largest=16'); ?></ul>
			</li>
			<?php  if ( is_home() || is_page() ) { ?>
				<li>
					<h3>Meta</h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="<?php bloginfo('rss2_url'); ?>">内容RSS</a></li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>">评论RSS</a></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
			<?php } ?>
			<?php endif; ?>
		</ul>
	</div>