<!-- comments  -->

<div id="comments">

<?php 
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
        if (!empty($post->post_password)) { 
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
				?>
				<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments."); ?><p>
				<?php
				return;
            }
        }
		$commentalt = '';
 		$commentcount = 1;
?>

	<h2><?php comments_number('暂无留言', '1条留言', '% 条留言' ); if($post->comment_status == "open") { ?><a href="#commentform" class="comment-go">我要留言 &raquo;</a><?php } ?></h2>
	<?php if ($comments) : ?>
		<ul>
		<?php foreach ($comments as $comment) : ?>
		<?php $comment_type = get_comment_type(); ?> <!--trackbacks / pingbacks-->
		<?php if($comment_type == 'comment') { ?><!--trackbacks / pingbacks-->
		<li id="comment-<?php echo $comment->comment_ID; ?>" class="<?php comment_type('comment','trackback','pingback'); ?>">
		
		<p class="header<?php echo $commentalt; ?>" > 	
		&nbsp; <?php echo $commentcount ?> - 
			<?php if ($comment->comment_type == "comment") comment_author_link();
				  else {
						strlen($comment->comment_author)?$author=substr($comment->comment_author,0,25)."&hellip":$author=substr($comment->comment_author,0,25);
						echo '<a href="'.$comment->comment_author_url.'">'.$author.'</a>';
				  }
			?> &nbsp;|&nbsp; <?php comment_date('Y-m-d') ?> at <?php comment_time() ?> &nbsp; <?php edit_comment_link('编辑','<span class="editlink">','</span>'); ?>
		
		</p>
		<?php if ($comment->comment_approved == '0') : ?><p class="waiting"><em>您的留言正等待审核</em></p><?php endif; ?>
		<?php if ($comment->comment_type == "comment") {?>
			<div id="gravatarbox">
				<div id="gravatar"><?php if (function_exists('get_avatar')) { echo get_avatar(get_comment_author_email(),'36'); } ?></div>
				<?php comment_text() ?>	
			</div>
		<?php } else {?>
			<?php comment_text() ?>
		<?php } ?>	
		</li>
		<?php
		($commentalt == " alt")?$commentalt="":$commentalt=" alt";
		$commentcount++;
		?>
		<?php } else { $trackback = true; } ?><!--trackbacks / pingbacks-->
		<?php endforeach; ?>
		</ul>
		
	<?php if ($trackback == true) { ?> 
		<h2>Trackbacks</h2> 
		<ol> 
			<?php foreach ($comments as $comment) : ?> 
			<?php $comment_type = get_comment_type(); ?> 
			<?php if($comment_type != 'comment') { ?> 
				<li><?php comment_author_link() ?></li> 
			<?php } ?> 
			<?php endforeach; ?> 
		</ol> 
		<?php } ?>
		<?php endif; ?>
		<?php if ($post->comment_status == "open") : ?>
			<?php if (get_option('comment_registration') && !$user_ID) : ?>
			<p>请 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">登陆</a> 评论</p>
			<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<fieldset>
				<?php if ($user_ID) : ?>
					<p class="info"><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">你好，<?php echo $user_identity; ?></a> | <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">注销</a></p>
					<?php else : ?>
						<p><label for="author">姓名</label> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /> <?php if ($req) echo "<em>必填</em>"; ?></p>
						<p><label for="email">Email</label> <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /> <em><?php if ($req) echo "必填，绝不公开"; ?></em></p>
						<p><label for="url">网站</label> <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></p>
				<?php endif; ?>
				<p><label for="comment">留言</label> <textarea name="comment" id="comment" cols="45" rows="10" tabindex="4"></textarea></p>
				<p><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				<input type="submit" name="submit" value="提交留言" class="button" tabindex="5" /></p>
			</fieldset>
			<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; ?>
	
	<?php endif;  ?>

</div> 
<!-- /comments -->