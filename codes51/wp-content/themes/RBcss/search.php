<?php get_header(); ?>
	<div id="content">
		<?php if (have_posts()) : ?>
			<div class="archive-title"><h2>搜索结果</h2></div>
			<?php while (have_posts()) : the_post(); ?>
				<div class="post">
					<div class="title"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><div class="title-time"><?php the_time('Y.m.d') ?></div></div>
					<div class="entry">
						<?php the_excerpt(); ?>
					</div>
					<p class="tag"><?php the_tags('Tag :', ', ', ''); ?></p>
				</div>
			<?php endwhile; ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; 上一页') ?></div>
				<div class="alignright"><?php previous_posts_link('下一页 &raquo;') ?></div>
			</div>
		<?php else : ?>
			<div class="archive-title"><h2>没有搜到您查询的相关信息</h2></div>
			<p class="center">不好意思，您可以看一下侧栏推荐的相关文章。</p>
		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>