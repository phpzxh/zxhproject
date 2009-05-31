<?php get_header(); ?>
	<div id="content">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="title"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><div class="title-time"><?php the_time('Y.m.d') ?></div></div>
				<div class="postmetadata"><?php the_author() ?> 发表于 <?php the_time('H:i') ?> | 分类：<?php the_category(', ') ?> | <a href="#respond"><?php comments_number('暂无评论', '1 条评论', '% 条评论'); ?></a> | <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">阅读全文</a>  <?php edit_post_link('编辑',''); ?></div>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<p class="tag"><?php the_tags('TAG :', ', ', ''); ?></p>
			</div>
		<?php endwhile; ?>
		<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; 上一页') ?></div>
				<div class="alignright"><?php previous_posts_link('下一页 &raquo;') ?></div>
		</div>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">不好意思，您所查看的内容不再这里，您可以通过侧栏搜索工具查一下。</p>
	<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>