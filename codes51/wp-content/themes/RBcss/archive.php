<?php get_header(); ?>
	<div id="content" class="narrowcolumn">
		<?php if (have_posts()) : ?>
			<div class="archive-title">
				  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				  <?php /* If this is a category archive */ if (is_category()) { ?>
					<h2 class="pagetitle"> 相关分类： <?php single_cat_title(); ?></h2>
				  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2 class="pagetitle"> Tag标签: <?php single_tag_title(); ?></h2>
				  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2 class="pagetitle">日存档: <?php the_time('Y.m.d'); ?></h2>
				  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2 class="pagetitle">月存档: <?php the_time('Y.m'); ?></h2>
				  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2 class="pagetitle">年存档: <?php the_time('Y'); ?></h2>
				  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2 class="pagetitle">作者存档</h2>
				  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2 class="pagetitle">博客存档</h2>
				  <?php } ?>
			</div>
			<?php while (have_posts()) : the_post(); ?>
			<div class="post">
				<div class="title"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><div class="title-time"><?php the_time('Y.m.d') ?></div></div>
					<div class="postmetadata"><?php the_author() ?> 发表于 <?php the_time('H:i') ?> | 分类：<?php the_category(', ') ?> | <a href="#respond"><?php comments_number('暂无评论', '1 条评论', '% 条评论'); ?></a> | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">阅读全文</a> <?php edit_post_link('编辑',''); ?></div>
					<div class="entry">
						<?php the_excerpt(); ?>
					</div>
					<p class="tag"><?php the_tags('TAG :', ', ', ''); ?></p>
				</div>
			<?php endwhile; ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; 上一页') ?></div>
				<div class="alignright"><?php previous_posts_link('下一页 &raquo;') ?></div>
			</div>
		<?php else : ?>
			<h2 class="center">没有相关存档</h2>
			<p class="center">不好意思，您所查看的内容不再这里，您可以通过侧栏搜索工具查一下。</p>
		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>