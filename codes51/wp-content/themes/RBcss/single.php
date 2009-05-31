<?php get_header(); ?>
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="title"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><div class="title-time"><?php the_time('Y.m.d') ?></div></div>
				<div class="entry">
					<?php the_content(); ?>
					<p>本文地址：<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
				</div>
				<p class="tag"><?php the_tags('TAG :', ', ', ''); ?></p>
				<div class="postmetadata"><?php the_author() ?> 发表于 <?php the_time('H:i') ?> | 分类：<?php the_category(', ') ?> | <a href="#respond"><?php comments_number('暂无评论', '1 条评论', '% 条评论'); ?></a>  <?php edit_post_link('编辑',''); ?></div>
			</div>
			<div id="line"></div>
			<div class="navigation">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
			</div>
			<div class="clearboth"></div>

		<?php comments_template(); ?>
		<?php endwhile; else: ?>
			<p>对不起,没有找到符合的文章.<br />
			</p>
		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>